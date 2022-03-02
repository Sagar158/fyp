#!/usr/bin/env python
from tracemalloc import start

from sqlalchemy import desc
from apiclient.discovery import build
from google_auth_oauthlib.flow import InstalledAppFlow
import pickle
from datetime import datetime, timedelta
import sys, json
import base64
from dateutil.parser import parse

data = json.loads(base64.b64decode(sys.argv[1]))

description = data[2]
summary = data[3]
location = data[4]
emails = data[5]

attendees = []
for value in emails:
    attendees.append({'email' : value})

#Read Credentials
credentials = pickle.load(open('C:\\xampp-7\\htdocs\\iqraUniversity\\public\\python\\token.pkl','rb'))
service = build('calendar','v3',credentials=credentials)
result = service.calendarList().list().execute()

calendar_id = result['items'][2]['id']

result = service.events().list(calendarId=calendar_id, timeZone="Asia/Karachi").execute()


start_time = parse(data[0])

end_time = parse(data[1])
timezone = 'Asia/Karachi'

event = {
  'summary': summary,
  'location': location,
  'description': description,
  'start': {
    'dateTime': start_time.strftime("%Y-%m-%dT%H:%M:%S"),
    'timeZone': timezone,
  },
  'end': {
    'dateTime': end_time.strftime("%Y-%m-%dT%H:%M:%S"),
    'timeZone': timezone,
  },
  'attendees': attendees,
  'reminders': {
    'useDefault': False,
    'overrides': [
      {'method': 'email', 'minutes': 24 * 60 * 2},
      {'method': 'popup', 'minutes': 2 * 60},
    ],
  },
}


serviceID = service.events().insert(calendarId=calendar_id, body=event).execute()
print(serviceID['id'])

