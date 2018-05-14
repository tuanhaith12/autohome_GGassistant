#include <ESP8266WiFi.h>
#include "Adafruit_MQTT.h"
#include "Adafruit_MQTT_Client.h"
#include <WiFiClient.h> 
//#include <ESP8266WebServer.h>
//#include <ESP8266mDNS.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>
#include "DHT.h"        // including the library of DHT11 temperature and humidity sensor
#define DHTTYPE DHT11   // DHT 11

/* #include <FirebaseArduino.h>
#define FIREBASE_HOST "rpi-home-54fef.firebaseio.com" //Thay bằng địa chỉ firebase của bạn
#define FIREBASE_AUTH ""   //Không dùng xác thực nên không đổi

MDNSResponder mdns;
*/

const char* WIFI_SSID = "AnhThuy";
const char* WIFI_PASS = "conheocon";
#define MQTT_SERV "io.adafruit.com"
#define MQTT_PORT 1883
#define MQTT_NAME "tuanhaith12"
#define MQTT_PASS "7f0f3552de314068a7f32dab73fd8292"

// Set the LCD address to 0x27 for a 16 chars and 2 line display
LiquidCrystal_I2C lcd(0x3f, 16, 2);
#define dht_dpin 13
DHT dht(dht_dpin, DHTTYPE); 

// ESP8266WebServer server(80);

//Set up MQTT and WiFi clients
WiFiClient client;
Adafruit_MQTT_Client mqtt(&client, MQTT_SERV, MQTT_PORT, MQTT_NAME, MQTT_PASS);

//Set up the feed you're subscribing to
Adafruit_MQTT_Subscribe onoff = Adafruit_MQTT_Subscribe(&mqtt, MQTT_NAME "/feeds/onoff");
Adafruit_MQTT_Subscribe r1onoff = Adafruit_MQTT_Subscribe(&mqtt, MQTT_NAME "/feeds/r1onoff");
Adafruit_MQTT_Subscribe r2onoff = Adafruit_MQTT_Subscribe(&mqtt, MQTT_NAME "/feeds/r2onoff");

Adafruit_MQTT_Publish temperature = Adafruit_MQTT_Publish(&mqtt, MQTT_NAME "/feeds/Temperature");
Adafruit_MQTT_Publish humidity = Adafruit_MQTT_Publish(&mqtt, MQTT_NAME "/feeds/Humidity");
Adafruit_MQTT_Publish brightness = Adafruit_MQTT_Publish(&mqtt, MQTT_NAME "/feeds/Brightness");

int relay1 = 2;
int relay2 = 0;
int relay3 = 4;
int relay4 = 5;
//int motion_sensor = 12;  // Digital pin D6
//int soundSensor = 12; //D6
//int pause = 100;
//int note = 440; // music note A4

void setup()
{
  
  Serial.begin(115200);
  
  //Connect to WiFi
  Serial.print("\n\nConnecting Wifi... ");
  WiFi.begin(WIFI_SSID, WIFI_PASS);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print("..");
  }
  Serial.println("OK! ");
  Serial.println(WiFi.localIP());
  //Subscribe to the onoff feed
  mqtt.subscribe(&onoff);
  mqtt.subscribe(&r1onoff);
  mqtt.subscribe(&r2onoff);

//  pinMode(motion_sensor, INPUT);   // declare sensor as input
    
//  pinMode (soundSensor, INPUT);
  
  pinMode(relay1, OUTPUT);
  digitalWrite(relay1, LOW);
  pinMode(relay2, OUTPUT);
  digitalWrite(relay2, LOW);
  pinMode(relay3, OUTPUT);
  digitalWrite(relay3, LOW);
  pinMode(relay4, OUTPUT);
  digitalWrite(relay4, LOW);

 /*int statusSensor = digitalRead (soundSensor);
  
  if (statusSensor == 1)
  {
    for (int i=0; i<2; i++){
      threeDots();
      threeDashes();
      threeDots();
      delay(3000);
    }
  }
  
  else
  {
    digitalWrite(relay4, HIGH);
  }
 */

  // Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
  dht.begin();
}


void loop()
{ 
 /* Firebase.setFloat("led", 0);

  int i = 0;
  for (i = 0; i < 10; i++) {
    Firebase.setFloat("led", i);
    // handle error
    if (Firebase.failed()) {
      Serial.print("setting /number failed:");
      Serial.println(Firebase.error());
      return;
    }
    Serial.println(i);
    delay(200);
  }
  */
  MQTT_connect();
  
  //Read from our subscription queue until we run out, or
  //wait up to 5 seconds for subscription to update
  Adafruit_MQTT_Subscribe * subscription;
  while ((subscription = mqtt.readSubscription(5000)))
  {
    //If we're in here, a subscription updated...
    if (subscription == &onoff)
    {
      //Print the new value to the serial monitor
      Serial.print("onoff: ");
      Serial.println((char *) onoff.lastread);
 
      //If the new value is  "ON", turn the light on.
      //Otherwise, turn it off.
      if (!strcmp((char *) onoff.lastread, "OFF"))
      {
        //Active low logic
        digitalWrite(relay1, HIGH);
        digitalWrite(relay2, HIGH);
        digitalWrite(relay3, HIGH);
        digitalWrite(relay4, HIGH);
      }
      else if (!strcmp((char *) onoff.lastread, "ON"))
      {
        digitalWrite(relay1, LOW);
        digitalWrite(relay2, LOW);
        digitalWrite(relay3, LOW);
        digitalWrite(relay4, LOW);
      }
    }
    else if(subscription == &r1onoff){
       //Print the new value to the serial monitor
      Serial.print("r1onoff: ");
      Serial.println((char *) r1onoff.lastread);
   
      //If the new value is  "ON", turn the light on.
      //Otherwise, turn it off.
      if (!strcmp((char *) r1onoff.lastread, "r1OFF"))
      {
        //Active low logic
        digitalWrite(relay1, HIGH);
      }
      else if (!strcmp((char *) r1onoff.lastread, "r1ON"))
      {
        digitalWrite(relay1, LOW);
      }
    }
    else if(subscription == &r2onoff){
       //Print the new value to the serial monitor
      Serial.print("r2onoff: ");
      Serial.println((char *) r2onoff.lastread);
   
      //If the new value is  "ON", turn the light on.
      //Otherwise, turn it off.
      if (!strcmp((char *) r2onoff.lastread, "r2OFF"))
      {
        //Active low logic
        digitalWrite(relay2, HIGH);
      }
      else if (!strcmp((char *) r2onoff.lastread, "r2ON"))
      {
        digitalWrite(relay2, LOW);
      }
    }
    
  }
  int humidity_data = (int)dht.readHumidity();
  int temperature_data = (int)dht.readTemperature();
  if (! temperature.publish(temperature_data))
    Serial.println(F("Failed to publish temperature"));
  else
    Serial.print("Temperature: ");
    Serial.println(temperature_data);
    
   
  if (! humidity.publish(humidity_data))
    Serial.println(F("Failed to publish humidity"));
  else
    Serial.print("Humidity: ");
    Serial.println(humidity_data);
    
    // read the input on analog pin 0:
  int sensorValue = analogRead(A0);
  // Convert the analog reading (which goes from 0 - 1023) to a voltage (0 - 5V):
  float brightness_data  = (int)(sensorValue + 5) / 10;
  

  if (! brightness.publish(brightness_data))
    Serial.println(F("Failed to publish humidity"));
  else
    if(brightness_data <=40.00){
          digitalWrite(relay3, LOW);
    }
    else {
          digitalWrite(relay3, HIGH);
    }
    Serial.print("brightness: ");
    Serial.println(brightness_data);

 
  // ping the server to keep the mqtt connection alive
  if (!mqtt.ping())
  {
    mqtt.disconnect();
  }

  delay(1000);
}

/*three short signals
void threeDots()
{
  for (int i=0; i<3; i++){
    tone(relay4, note, 100);
    delay(200);
    noTone(relay4);
  }
  delay(200);
}

// three long signals8
void threeDashes()
{
  for (int i=0; i<3; i++){
    tone(relay4, note, 300);
    delay(400);
    noTone(relay4);
  }
  delay(200);
}
*/
/****************************************************/


void MQTT_connect() 
{
  int8_t ret;

  // Stop if already connected.
  if (mqtt.connected()) 
  {
    return;
  }

  Serial.print("Connecting to MQTT... ");

  uint8_t retries = 3;
  while ((ret = mqtt.connect()) != 0) // connect will return 0 for connected
  { 
       Serial.println(mqtt.connectErrorString(ret));
       Serial.println("Retrying MQTT connection in 5 seconds...");
       mqtt.disconnect();
       delay(5000);  // wait 5 seconds
       retries--;
       if (retries == 0) 
       {
         // basically die and wait for WDT to reset me
         while (1);
       }
  }
  Serial.println("MQTT Connected!");
}


