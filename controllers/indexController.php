<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : indexController.php
 *  
 * 
 **************************************/
class indexController extends Controller
{
    public function index()
    {
		/* Show Views */
        $this->view->render('index', null);
    }
}

/* End of file indexController.php */
/* Location: ./controllers/indexController.php */