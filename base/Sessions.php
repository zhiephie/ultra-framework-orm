<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Sessions.php
 *  
 * 
 **************************************/
class Session
{
	public static function init()
	{
		session_start();
	} //<--- * End init() * --->
	
	public function destroy( $action = false  )
	{
		if( $action === true )
		{
			$_SESSION = array();
			session_destroy();
		}
	} //<--- * End destroy() * -->
	
	public function get( $key )
	{
		if( isset( $_SESSION[$key] ) )
		{
			return $_SESSION[$key];
		} else {
			return false;
		}
	} //<--- * End get() * -->
	
} //<------------ * End Class * ------------->

/* End of file Session.php */
/* Location: ./base/Session.php */