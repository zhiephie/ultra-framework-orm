<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : App.php
 * 
 **************************************/

 /* Date Default*/
date_default_timezone_set('Asia/Jakarta');
define( 'time', date( 'd-m-Y G:i:s', time() ) );

/* Default Controller NOT MODIFIED */
define('default_controller', 'index');

/*--Config site data -- */
define('site', 'Ultra Framework (ORM)' ); 	// Your site name
define('description', 'Your description' ); // Your site name description
define('keyword', 'Your keyword' );  // Your site name keyword

/* site name path */
define('url', 'http://localhost/ultraorm/'); // IMPORTANT: place a backslash at the end

/* End of file App.php */
/* Location: ./base/App.php */
