#!/usr/bin/python3

import requests

# begin config
DEVICE_ID = 'SomeDevice'
PRIVATE_KEY = 'SomeKey'

# end config

HEARTBEAT_URL = 'https://status-ayrscott-com.herokuapp.com/heartbeat.php'

HEARTBEAT_DATA = {
    'id': DEVICE_ID,
    'key': PRIVATE_KEY
}

result = requests.post(HEARTBEAT_URL, HEARTBEAT_DATA)

print(result)