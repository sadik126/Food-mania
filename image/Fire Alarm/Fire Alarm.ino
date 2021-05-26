 //Rudra DIY Crafts 
//Blynk Fire Alert system
#define BLYNK_PRINT Serial
#include <ESP8266WiFi.h>
#include <BlynkSimpleEsp8266.h>
BlynkTimer timer;
char auth[] = "efTDWvYh_8BmsXYY7yngMFwbVMHStw8c"; //Auth code sent via Email
char ssid[] = "RDC A3"; //Wifi name
char pass[] = "Rudraiot";  //Wifi Password
int flag=0;
void notifyOnFire()
{
  int isButtonPressed = digitalRead(D1); int buzz = D4;
  if (isButtonPressed==1 && flag==0)
  {
    Serial.println("Rudra Fire in the House");
    Blynk.notify("Alert : Rudra Fire in the House");
    flag=1;  digitalWrite(buzz, HIGH);  delay(5000); digitalWrite(buzz, LOW); 
  }
  else if (isButtonPressed==0)
  {
    flag=0; digitalWrite(buzz, LOW);
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
