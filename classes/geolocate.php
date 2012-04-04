<?php

namespace Geolocate;

/**
 * Geolocate
 *
 * @package		Fuel
 * @subpackage	Geolocate
 * @author		Bryce Johnston
 */

require_once PKGPATH.'geolocate/classes/geoipcity.php';
 
class Geolocate
{
	protected static $_gi;

	/**
	 * Init, config loading.
	 */
	public static function _init()
	{
		\Config::load('geolocate', true);
	}
	
	/**
	 * forge
	 * Uses GeoLiteCity.dat and geoip helpers to get Geo location information for the IP address passed
	 *
	 * @access  public
	 * @param   string    $ip_address     IP Address
	 * @param   boolean   $conn           TRUE or FALSE - whether a connection to GeoLiteCity is already open or not
	 * @return  array
	 */
	public static function forge($ip_address, $conn = FALSE)
	{
		($conn == FALSE ? static::_geoip_open() : 0);

		$geoip = geoip_record_by_addr(static::$_gi, $ip_address);

		($conn == FALSE ? static::_geoip_close() : 0);
		return $geoip;
	}
	
	/**
	 * _geoip_open
	 * Opens connection to GeoLiteCity.dat
	 *
	 * @access  protected
	 * @return  void
	 */
	protected static function _geoip_open()
	{
		$database = \Config::get('geolocate.path').'GeoLiteCity.dat';

		if (!file_exists($database)) {
			throw new \Fuel_Exception('Missing GeoLiteCity database file');
		}
		
		static::$_gi = geoip_open($database, GEOIP_STANDARD);
	}
	
	/**
	 * _geoip_close
	 * Closes connection to GeoLiteCity.dat
	 *
	 * @access  protected
	 * @return  void
	 */
	protected static function _geoip_close()
	{
		geoip_close(static::$_gi);
	}

}

/* End of file geolocate.php */
