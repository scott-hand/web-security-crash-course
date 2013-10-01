Web Security Crash Course
====================

This collection of basic web apps are intended for use in instructing students on basic web security attacks.

Right now, these attacks include the following:

1. Parameter Tampering
2. SQL Injection
3. XSS / CSRF

These apps are simple and run on top of PHP and Sqlite so that database instances are tied to users' PHPSESSION. The result is that students can be as malicious as they want with their database commands without affecting other students.

This was something I threw together quickly for a course, so the code is not terribly elegant or modular at the moment, and the front end uses Twitter Bootstrap examples and Bootswatch themes shameless for a fast, snazzy front-end.

## Installation

Very little is needed to run these mini-apps.

1. Install the PHP Sqlite PDO adapter. In Ubuntu, this can be accomplished with: ```$ sudo apt-get install php5-sqlite```
2. Make the lib/data directory writable by the web server. In Ubuntu, this can be accomplished by entering the following at the application's root: ```$ sudo chown USER:www-data lib/data```
3. Similarly, make the grabber/logs directory writable by the web server.

After that, you're ready to go!

Note that while some very basic precautions have been taken to protect the server running these applications, it's also not recommended that they be run on sensitive systems or over the Internet until some further testing has been done to work towards guaranteeing their safety. Certain attacks, such as denial of service by flooding the disk with cookie grabber data, have not been mitigated yet. So either wait until those are added, add them yourself, or in the mean time, don't run these on a public facing page for an extended duration of time.
