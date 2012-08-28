<?php
namespace Fuel\Tasks;

class Geolocate
{
	public static function run()
	{
		\Config::load('geolocate', true);
		$path = \Config::get('geolocate.path');
		$database_path = $path.'GeoLiteCity.dat';

		\Cli::write('Downloading database', 'green');

		$command = "curl -s http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz > $database_path.gz";

		// Download the database
		exec($command);

		// Delete the old database
		if (file_exists($database_path)) {
			exec('rm '.$database_path);
			\Cli::write('Old database removed', 'green');
		}

		if (file_exists($database_path.'.gz')) {
			\Cli::write('Extracting database', 'green');

			// Extract the database
			exec('gunzip -q '.$database_path.'.gz');
		}

		if (file_exists($database_path)) {
			\Cli::write('Database added', 'green');
		} else {
			\Cli::write('Something went wrong', 'red');
		}
	}
}
