from paho.mqtt import client as mqtt_client
import random,time

broker = 'iothogar.xyz'
port = 1883
topic = 'values'
client_id = f'python-mqtt-{random.randint(0,1000)}'
username = 'web_client'
password = '1234'

def connect_mqtt() -> mqtt_client:
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
            print('Connected to MQTT Broker!')
        else:
            print('Failed to connect, return code %d\n', rc)
    
    client = mqtt_client.Client(client_id)
    client.username_pw_set(username,password)
    client.on_connect = on_connect
    client.connect(broker,port)
    return client


def subscribe(client: mqtt_client):
    def on_message(client, userdata, msg):
        print(f"Received `{msg.payload.decode()}` from `{msg.topic}` topic")
    
    client.subscribe(topic)
    client.on_message = on_message

def publish(client):
    msg_count = 0
    while True:
        time.sleep(1)
        msg = "%s,%s,%s" %(msg_count, msg_count+1, msg_count+2)
        result = client.publish(topic, msg)
        # result: [0,1]
        status = result[0]
        if status == 0:
            print(f"Send `{msg} to topic `{topic}`")
        else:
            print(f"Failed to send message to topic {topic}")
        msg_count += 1

def run():
    client = connect_mqtt()
    client.loop_start()
    publish(client)

if __name__ == '__main__':
    run()


