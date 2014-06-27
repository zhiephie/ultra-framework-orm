<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : pagesController.php
 *  
 * 
 **************************************/
class testController extends Controller
{   
    //<-- * Index Error * --->
    public function index() {
        header ('HTTP/1.0 404 Not Found');
        include 'public/error/404.php'; // Show Error 404
    }

    public function test()
    {
    	$this->view->title = "Test controller";
		/* Show Views */
        $this->view->render('index', null);

        //redirect statement
        //$this->redirect('public/error/404');
    }
}

/* End of file indexController.php */
/* Location: ./controllers/indexController.php */