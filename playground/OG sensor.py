#!/usr/bin/python3
import Adafruit_DHT
import time
import requests
sensor = Adafruit_DHT.DHT22
pin = 4
tidUnix = time.time()
humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
if temperature is not None and humidity is not None:
    print('Temperatur = {0:0.1f}*C og Fuktighet = {1:0.1f}%'.format(temperature, humidity))
    payload = {'temp': temperature, 'fukt': humidity, 'tid': tidUnix, 'server': "localhost", 'usr': "admin", 'passwd': "LeMaTempSens", 'db': "Finnfjordbotn Logg", 'table': "`Rom 235`"}
    r = requests.post('http://10.12.3.38/PHP/query-db-logging.php', data=payload)
    print(r.text)
else:
    print('Feilet å lese ifra sensoren, prøv "sudo python3 sensor-script.py" igjen.')

