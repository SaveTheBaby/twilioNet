# Save the Baby

## Project Description

"Save the Baby" is a service of digitalized Maternal and Child Health Handbook for developing countries. It’s a service to record health data using telephone line to suit for the communication environment of the developing countries. This service is useful not only in daily life but also in time of disaster. This project began as a part of Race for Resilience / Code for Resilience to create a "Global Data Commons for Baby Care".

## Technical Details

"Save the Baby" employs Twilio API which connects between Web application and telephone/SMS. In order to build centralised management system of automatic voice responses via telephone lines in developing countries, "Save the Baby" makes use of various API/ libraries for voice calls in the three‐layer structure below:

1. Web Layer
 * Highcharts: A JavaScript library which draws a Smart Graph
2. Application Layer
 * Twilio.Connection: Control API for active calls
 * Twilio markup language (TwiML): Markup language which orders simultaneous delivery by PHP to Twilio
3. DataBase Layer
 * MySQL: Relational database management system which handles:
    1. Read-aloud data of the automatic voice response
    2. Basic information about the mother and baby
    3. Health and medical checkup data of the mother and baby

## License

"Save the Baby" is released under the GNU General Public License v2 (GPL v2).

## Contact

info@savethebaby.jp

http://savethebaby.github.io/twilioNet/
