#include <Arduino.h>
#include <WiFi.h>
#include <PubSubClient.h>

const char* ssid = "alhambra";
const char* password = "|O5H3#O35?3|5I|3n(IO";

const char *mqtt_server = "iothogar.xyz";
const int mqtt_port = 1883;
const char *mqtt_user = "web_client";
const char *mqtt_pass = "j65966298";

WiFiClient espClient;
PubSubClient client(espClient);

long lastMsg = 0;
char msg[25];

int temperatura = 0;
int humedad = 1;
int bateria = 2;

void setup_wifi();
void callback(char* topic, byte* payload, unsigned int length);
void reconnect();

void setup() {
  // put your setup code here, to run once:
  pinMode(BUILTIN_LED, OUTPUT);
  Serial.begin(115200);
  randomSeed(micros());
  setup_wifi();
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
  
}

void loop() {
  // put your main code here, to run repeatedly:
  if (!client.connected()){
    reconnect();
  }

  client.loop();
  long now = millis();
  if (now - lastMsg > 500){
    lastMsg = now;
    temperatura++;
    humedad++;
    bateria++;

    String to_send = String(temperatura) + "," + String(humedad) + "," + String(bateria);
    to_send.toCharArray(msg, 25);

    Serial.print("Publicamos mensaje -> ");
    Serial.println(msg);
    client.publish("values", msg);
    
    
  }
}


void setup_wifi(){
  delay(10);

  Serial.println();
  Serial.print("Conectando a ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("Conectado a red WiFi!");
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());

}

void callback(char* topic, byte* payload, unsigned int length){
  String incoming = "";
  Serial.println("Mensaje reicibido desde -> ");
  Serial.print(topic);
  Serial.println("");

  for (int i=0; i<length; i++){
    incoming += (char)payload[i];
  }

  incoming.trim();
  Serial.println("Mensaje -> " + incoming);

  if(incoming == "on") {
    digitalWrite(BUILTIN_LED, HIGH);
  }else{
    digitalWrite(BUILTIN_LED, LOW);
  }
}

void reconnect(){
  while(!client.connected()){
    Serial.print("Intentando conexión Mqtt...");
    String clientId = "esp8266_";
    clientId += String(random(0xffff), HEX);
    
    if(client.connect(clientId.c_str(), mqtt_user, mqtt_pass)){
      Serial.println("Conectado!");

      client.subscribe("led1");
      client.subscribe("led2");
    }else{
      Serial.println("falló: (con error -> ");
      Serial.print(client.state());
      Serial.println(" Intentamos de nuevo en 5 segundos");

      delay(5000);
    }
  }
}