<?php
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : index.php
 *  
 * 
 **************************************/
 
	error_reporting( 0 );
	/* Define absolute paths */
	define( 'YP', DIRECTORY_SEPARATOR );
	define( 'ROOT', realpath( dirname( __FILE__ ) ) . YP );
	define( 'APP', ROOT . 'base' . YP );
	
	/* require files */
try{
    require_once APP . 'autoload.php';
	
    /* session start */
    Session::init();

	/* router */
    Bootstrap::run( new Router );
    
}
catch( Exception $e )
{
    echo $e->getMessage();
}

/* End of file index.php */
/* Location: ./index.php */