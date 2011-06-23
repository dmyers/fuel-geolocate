# Geolocate

Geolocate integrates MaxMind's free GeoLiteCity.dat geoip database and PHP API classes to allow your fuel application to perform IP based geolocation lookups

# Download / Install

To install this package, create a folder called geolocate in your packages directory and drop the files from this repository in it. Then you need to download and extract the GeoLiteCity.dat database into the classes folder.
	GeoLiteCity Download: http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz

# Usage

Fuel::add_package('geolocate');

$location = Geolocate::get('63.141.243.160');

// $location array contains elements 'city', 'region', and 'country'