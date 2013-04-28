Web Security Crash Course
====================

This collection of basic web apps are intended for use in instructing students on basic web security attacks.

Right now, these attacks include the following:

1. Parameter Tampering
2. SQL Injection
3. XSS / CSRF

These apps are simple and run on top of PHP and Sqlite so that database instances are tied to users' PHPSESSION. The result is that students can be as malicious as they want with their database commands without affecting other students.

## Installation

Very little is needed to run these mini-apps.

1. Install the PHP Sqlite PDO adapter. In Ubuntu, this can be accomplished with: ```$ sudo apt-get install php5-sqlite```
2. Make the lib/data directory writable by the web server. In Ubuntu, this can be accomplished by entering the following at the application's root: ```$ sudo chown USER:www-data bin/data```

After that, you're ready to go!
