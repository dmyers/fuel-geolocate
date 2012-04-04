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
	 * get
	 * Uses GeoLiteCity.dat and geoip helpers to get Geo location information for the IP address passed
	 *
	 * @access  public
	 * @param   string    $ip_address     IP Address
	 * @param   boolean   $conn           TRUE or FALSE - whether a connection to GeoLiteCity is already open or not
	 * @return  array
	 */
	public static function get($ip_address, $conn = FALSE)
	{
		($conn == FALSE ? static::_geoip_open() : 0);
		$geoip = array();
		$record = geoip_record_by_addr(static::$_gi, $ip_address);
		if(!empty($record))
		{
			$geoip = array(
				'city'		=> $record->city,
				'region'	=> $record->region,
				'country'	=> $record->country_code3
			);
		}
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
		static::$_gi = geoip_open(\Config::get('geolocate.path').'GeoLiteCity.dat', GEOIP_STANDARD);
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
