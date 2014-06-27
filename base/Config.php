<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Config.php
 *  
 * 
 **************************************/
class Config extends PDO
{
	private static $instance = null;
	
	public function __construct()
	{

		/***********************************************************
 		* If Your Config Use Database Driver Default Mysql uncomment
 		************************************************************/

		// ORM::configure('sqlite:./ultra.sqlite');

		ORM::configure('mysql:host=localhost; dbname=ultra');
		ORM::configure('username', 'root');
		ORM::configure('password', '');

		//ORM::configure('pgsql:host=localhost dbname=ultra user=postgres password=');
	}
	
	public static function conn() 
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		
		return self::$instance;
		
	} //<--- * conn * --->
	
} //<------------ * End Class * ------------->

 /* End of file Config.php */
/* Location: ./base/Config.php */