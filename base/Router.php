<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Router.php
 *  
 * 
 **************************************/
class Router
{
    private $_controller;
    private $_method;
    
    public function __construct() {
        $page        = $_GET['page'];    //Pages eg: http:website.com/page and don't forget setting htaccess

        /* function method controller */
        $staticPages = array(
                        'test'
        );
        
        //<-- *  Pages Default * -->
        if( !in_array( $page, $staticPages ) 
            && isset( $page ) 

        ) {
            $this->_controller = strtolower( $page );
            $this->_method     = strtolower( $page );
            
        }
        //<--- ************* Pages ********* --->
        else if( isset( $page ) 
                && in_array( $page, $staticPages )
        ) {
            //load controller name pages = load folder name pages in views
            $this->_controller = 'test';
            $this->_method     = strtolower( $page );
        }
        
        //<-- * if no have variables defined $ _GET showed index * -->
        if( !$this->_controller ) {
            $this->_controller = default_controller;
        }

        if( !$this->_method ) {
            $this->_method = 'index';
        }
        
    } //<--- * End * -->
    
    public function getController() {
        return $this->_controller;
    }
    
    public function getMethod() {
        return $this->_method;
    }
 
} //<-- * End Class * -->

/* End of file Router.php */
/* Location: ./base/Router.php */