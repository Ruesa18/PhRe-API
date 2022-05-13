![](documentation/media/logo.png)

[![Stable Badge](https://img.shields.io/badge/Stable/Ready_for_production%3F-No-red.svg)](https://shields.io/)
[![GitHub latest release](https://badgen.net/github/release/Ruesa18/PhRe-API?label=latest%20release)](https://github.com/Ruesa18/PhRe-API/releases/)
[![GitHub latest stable release](https://badgen.net/github/release/Ruesa18/PhRe-API/stable?label=latest%20stable%20release)](https://github.com/Ruesa18/PhRe-API/releases/)
[![GitHub latest commit](https://badgen.net/github/last-commit/Ruesa18/PhRe-API)](https://github.com/Ruesa18/PhRe-API/commit/)
[![Recommended PHP Version](https://img.shields.io/badge/Recommended_PHP_Version->=8.0-blue.svg)](https://shields.io/)

# PhRe-API - PHP REST-API
Yet another PHP Backend Framework.
The possibility that it will not bring any new features is pretty big.
Soooo... Are you sure you want to take a look at this?

Well... Here we go then!

# Documentation

## Installation
You can either download the source from [GitHub](https://github.com/Ruesa18/PhRe-API) or you can use composer.
```bash
composer create-project sandro.ruefenacht/PhRe-API
```

## Setup
In order to have a configuration file copy the `.env.example` file and name it `.env`.

### Example API
If you wanna use the example API, you will need to import the `sql/db.sql` script in a MySQL environment. Don't forget to connect PhRe-API with your database by configuring the credentials inside the `.env` file.

## Configuration
Inside of the `.env`-file there are a few settings you might wanna check.
You can for example specify which kinds of messages will be outputted and which ones will be suppressed.

## Error Messages and such
To output error, debug and other useful messages please use the class `PHREAPI\kernel\utils\output\Logger`.
This will also check in the `.env`-file if the message-level is even allowed to be printed out.

