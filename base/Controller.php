<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Controller.php
 *  @loadModel - Load Models
 *  @Rediret - Redirect
 *  
 * 
 **************************************/
abstract class Controller
{
    protected $view;
    
    public function __construct() {
        $this->view = new View( new Router );
    }
    
	abstract public function index();
	 
    protected function loadModel( $model )
    {
        $model     = $model . 'Model';
        $rootModel = ROOT . 'models' . YP . $model . '.php';
        
        if( is_readable( $rootModel ) )
        {
            require $rootModel;
            $model = new $model;
            return $model;
        }
		
        else {
            throw new Exception('Error model');
        }
    } //<-- * END Function * -->
    
    protected function redirect( $root = false )
    {
        if( $root )
        {
            header('location:' . url . $root . '.php');
            exit;
        }
        else {
            header('location:' . url );
            exit;
        }
	}
	    
} //<<<----- * End Class * ------->>>

/* End of file Controller.php */
/* Location: ./base/Controller.php */
