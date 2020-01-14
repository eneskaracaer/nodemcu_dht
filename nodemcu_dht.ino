#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>
#include <virtuabotixRTC.h>

const char* ssid = "";
const char* password = "";

#define D1 5
#define D2 4
#define D4 2

#define DHTTYPE DHT11
#define dht_dpin 0
DHT dht(dht_dpin, DHTTYPE); ;

float Temperature;
float Humidity;
//(CLK, DAT, RST)
virtuabotixRTC myRTC(D1,D2,D4);
void setup() {

  Serial.begin(9600);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Waiting for connection");
  }
}
void loop() {

   myRTC.updateTime();
 if(WiFi.status()== WL_CONNECTED){

      if(myRTC.minutes % 10 == 0){
        HTTPClient http;
        Temperature = dht.readTemperature();
        Humidity = dht.readHumidity();
        delay(1000);
        String url = "http://esp8266.buyabilisim.com/?";
        url += "temp="+String(Temperature)+"&hum="+String(Humidity);
        http.begin(url);
        int httpCode = http.GET();
        if (httpCode > 0) {

          String payload = http.getString();
          Serial.println(payload);
        }
       http.end();
       delay(60000);
      }


 }else{

    Serial.println("Error in WiFi connection");

 }
}
