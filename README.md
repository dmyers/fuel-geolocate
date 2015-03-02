# Fuel Geolocate Package

A Fuel package for integrating [MaxMind](http://maxmind.com)'s geoip database.

## Installation

Simply add the following to your composer.json require block:

	'geoip/geoip'

### Git Submodule

If you are installing this as a submodule (recommended) in your git repo root, run this command:

	$ git submodule add git://github.com/dmyers/fuel-geolocate.git fuel/packages/geolocate

Then you you need to initialize and update the submodule:

	$ git submodule update --init --recursive fuel/packages/geolocate/

### Download

Alternatively you can download it and extract it into `fuel/packages/geolocate/`.

## Setup

### Run task

Run the oil task which will download and extract the GeoLiteCity.dat file into the vendor folder.

	$ php oil r geolocate

### Download

Alternatively you can [manually download the GeoLiteCity.dat database](http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz) and extract into the vendor folder.

## Usage

```php
$location = Geolocate::forge($ip_address);
```
## Updates

In order to keep the package up to date simply run:

	$ git submodule update --recursive fuel/packages/geolocate/
