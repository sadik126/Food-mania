//Blynk Fire Alarm Notification
#define BLYNK_PRINT Serial
#include <ESP8266WiFi.h>
#include <BlynkSimpleEsp8266.h>
BlynkTimer timer;
char auth[] = "NrC7he4qXkQHLvVA2Pfl114GtzQg0_2j"; //Auth code sent via Email
char ssid[] = "4G MIFI-E462"; //Wifi name
char pass[] = "17349402";  //Wifi Password
int flag=0;
void notifyOnFire()
{
  int isButtonPressed = digitalRead(D1);
  if (isButtonPressed==1 && flag==0) {
    Serial.println("Fire in the House");
    Blynk.notify("Alert : Hello Jobair! Fire in your House");
    flag=1;
  }
  else if (isButtonPressed==0)
  {
    flag=0;
  }
}
void setup()
{
Serial.begin(9600);
Blynk.begin(auth, ssid, pass);
pinMode(D1,INPUT_PULLUP);
timer.setInterval(1000L,notifyOnFire); 
}
void loop()
{
  Blynk.run();
  timer.run();
}
