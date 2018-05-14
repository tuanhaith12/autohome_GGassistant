# Example of using the MQTT client class to subscribe to a feed and print out
# any changes made to the feed.  Edit the variables below to configure the key,
# username, and feed to subscribe to for changes.

# Import standard python modules.
import sys
import os
import sqlite3
import datetime

# Import Adafruit IO MQTT client.
from Adafruit_IO import MQTTClient


# Set to your Adafruit IO key & username below.
ADAFRUIT_IO_KEY      = '7f0f3552de314068a7f32dab73fd8292'
ADAFRUIT_IO_USERNAME = 'tuanhaith12'  # See https://accounts.adafruit.com
                                                    # to find your username.



# Set to the ID of the feed to subscribe to for updates.
FEED_ID_TEMP = 'Temperature'
FEED_ID_HUM = 'Humidity'
FEED_ID_BRIGHTNESS = 'Brightness'
FEED_ID_r1onoff = 'r1onoff'

conn = sqlite3.connect('/home/pi/autohome_DB.db')

sensor_data_count = 0
data_temp = 0
data_humi = 0
data_brightness = 0
temp_rasp = 0

# Define callback functions which will be called when certain events happen.
def connected(client):
    # Connected function will be called when the client is connected to Adafruit IO.
    # This is a good place to subscribe to feed changes.  The client parameter
    # passed to this function is the Adafruit IO MQTT client so you can make
    # calls against it easily.
    print('Connected to Adafruit IO!  Listening for feed changes...')
    # Subscribe to changes on a feed named DemoFeed.
    client.subscribe(FEED_ID_r1onoff)
    client.subscribe(FEED_ID_TEMP)
    client.subscribe(FEED_ID_HUM)
    client.subscribe(FEED_ID_BRIGHTNESS)


def disconnected(client):
    # Disconnected function will be called when the client disconnects.
    print('Disconnected from Adafruit IO!')
    sys.exit(1)

def message(client, feed_id, payload):
    # Message function will be called when a subscribed feed has a new value.
    # The feed_id parameter identifies the feed, and the payload parameter has
    # the new value.
    global data_temp
    global data_humi
    global data_brightness
    global temp_rasp
    global sensor_data_count

    print('Feed {0} received new value: {1}'.format(feed_id, payload))
    now = datetime.datetime.now().time()
    c = conn.cursor()
    if feed_id == 'Temperature':
        data_temp = payload
        sensor_data_count = sensor_data_count + 1

    if feed_id == 'Humidity':
        data_humi = payload
        sensor_data_count = sensor_data_count + 1

    if feed_id == 'Brightness':
        data_brightness = payload
        sensor_data_count = sensor_data_count + 1

    if feed_id == 'r1onoff':
        if payload == 'r1ON':
                c.execute("UPDATE device_remote SET device_state = 'r1ON', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r01'")
                conn.commit()
        if payload == 'r1OFF':
                c.execute("UPDATE device_remote SET device_state = 'r1OFF', lastdate = date('now','localtime'), lastime = time('now','localtime') WHERE device_id = 'r01'")
                conn.commit()

    if sensor_data_count == 3:
        temp_rasp_CPU = (os.popen("vcgencmd measure_temp").readline()).replace("temp=","")
        temp_rasp = float(temp_rasp_CPU.replace("'C",""))
        c.execute('''INSERT INTO SYS_REC(temperature, humidity, brightness, temp_rasp, currentdate, currentime, device_id) values((?), (?), (?), (?), date('now','localtime'), time('now','localtime'), "s01")''', (data_temp, data_humi, data_brightness, temp_rasp))
        conn.commit()
        print(data_temp, data_humi, data_brightness, temp_rasp)
        sensor_data_count = 0
        data_temp = 0
        data_humi = 0
        data_brightness = 0
        temp_rasp = 0
        c.execute("SELECT device_state FROM device_remote WHERE device_id ='r01'")
        rows = c.fetchall()
        for row in rows:
                print (row[0])
                if row[0] == 'r1ON-web':
                       client.publish("r1onoff", "r1ON")
                if row[0] == 'r1OFF-web':
                       client.publish("r1onoff", "r1OFF")


# Create an MQTT client instance.
client = MQTTClient(ADAFRUIT_IO_USERNAME, ADAFRUIT_IO_KEY)

# Setup the callback functions defined above.
client.on_connect    = connected
client.on_disconnect = disconnected
client.on_message    = message

# Connect to the Adafruit IO server.
client.connect()

# Start a message loop that blocks forever waiting for MQTT messages to be
# received.  Note there are other options for running the event loop like doing
# so in a background thread--see the mqtt_client.py example to learn more.
client.loop_blocking()




