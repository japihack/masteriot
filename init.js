const mysql = require('mysql'); // or use import if you use TS
const util = require('util');
const mqtt = require('mqtt');

const conn = mysql.createPool({
        connectionLimit: 10,
        host: "iothogar.xyz",
        user: "admin_masteriot",
        password: "j65966298",
        database: "admin_masteriot"
});

const options = {
        port: 1883,
        host: "iothogar.xyz",
        clientId: "habitacion_" + Math.round(Math.random() * (0-10000) * -1),
        username: "",
        password: "",
        keepalive: 60,
        reconnectPeriod: 1000,
        protocolId: "MQIsdp",
        protocolVersion: 3,
        clean: true,
        encoding: "utf8"
}

const client = mqtt.connect("mqtt://iothogar.xyz", options);

client.on('connect', function(){
        console.log("Conexión MQTT Exitosa");
        client.subscribe('+/#', function(err){
                console.log("SubscripciónExitosa!");
        });
});

client.on('message', function(topic, message){
        // node native promisify
        const query = util.promisify(conn.query).bind(conn);
        let resultado;

        (async () => {
                try {
                        const rows = await query("SELECT * FROM `estaciones`");
                        console.log(rows[0].estaciones_serie);
                        this.resultado = rows[0].estaciones_id;
                        console.log("resultado -> " + this.resultado);
                        let insertar = "INSERT INTO `mediciones` (`mediciones_valor`, `mediciones_estaciones_id`) VALUES ('10', '" + this.resultado + "');";
                        conn.query(insertar,function(err,result,fields){
                                if(err) throw err;

                        });

                } finally {
                        //conn.end();
                }
        })()

});

