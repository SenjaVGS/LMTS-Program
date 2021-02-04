#!/usr/bin/python3
import sys
import Adafruit_DHT
import time
import requests
sensor = Adafruit_DHT.DHT22
pin = 4
tidUnix = time.time()
humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
if temperature is not None and humidity is not None:
    fail = "FAIL"
    print('Temperatur = {0:0.1f}*C og Fuktighet = {1:0.1f}%'.format(temperature, humidity))
    payload = {'temp': temperature, 'fukt': humidity, 'tid': tidUnix, 'server': "localhost", 'usr': "admin", 'passwd': "LeMaTempSens", 'db': "Finnfjordbotn", 'table': "`Rom 235`", 'ID': "1"}
    r = requests.post('http://10.12.3.38/PHP/query-db-tmp.php', data=payload)
    print(r.text)
    del temperature
    del humidity
    humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
 
    while r.text ==  "FAIL":
        if temperature is not None and humidity is not None:
            time.sleep(3)
            humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
            print('Temperatur = {0:0.1f}*C og Fuktighet = {1:0.1f}%'.format(temperature, humidity))
            payload = {'temp': temperature, 'fukt': humidity, 'tid': tidUnix, 'server': "localhost", 'usr': "admin", 'passwd': "LeMaTempSens", 'db': "Finnfjordbotn", 'table': "`Rom 235`", 'ID': "1"}
            r = requests.post('http://10.12.3.38/PHP/query-db-tmp.php', data=payload)
            print(r.text)
            print(r.encoding)
            if r.text ==  "success":
                print(r.text)
                print('ferdig med loop')
                break
            else:
                print('5 sec before new loop if "FAIL".')
                del temperature
                del humidity
                humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
                time.sleep(5)
        else:
            print(r.text)
            print('Feil me sensorn.')
else:
    print('Feilet å lese ifra sensoren, prøv "sudo python3 sensor-script.py" igjen.')

