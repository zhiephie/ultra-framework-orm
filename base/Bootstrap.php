<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Bootstrap.php
 *  
 * 
 **************************************/
class Bootstrap
{
    public static function run( Router $getRouter )
    {
        $controller      = $getRouter->getController() . 'Controller';
        $rootController  = ROOT . 'controllers' . YP . $controller . '.php';
        $method          = $getRouter->getMethod();
        
        if( is_readable( $rootController ) )
        {
            require $rootController;
            $controller = new $controller;
            
            if( is_callable( array( $controller, $method ) ) )
            {
                $method = $getRouter->getMethod();
            }
            else
            {   //load default controller
                $method = 'index';
            }
			
				call_user_func( array( $controller, $method ) );
			
            
        } //<-- * is_readable * -->
        else {
	          include 'public/error/404.php'; // SHOW ERROR 404
        }
    } //<-- * End Function * -->
} //<-- * End Class * -->

/* End of file Bootstrap.php */
/* Location: ./base/Bootstrap.php */