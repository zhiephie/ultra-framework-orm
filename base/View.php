<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : View.php
 *  
 * 
 **************************************/
class View
{
    private $_controller;
    private $_js;
    
    public function __construct( Router $_request )
    {
        $this->_controller = $_request->getController();
        $this->_js = array();
    }
    
    public function render( $views, $item = false )
    {   
        $js = array();

        if( count( $this->_js ) )
        {
            $js = $this->_js;
        }
        
        $layout = array(
            'css'    => url . 'public/css/',
            'img'    => url . 'public/images/',
            'script' => url . 'public/js/',
            'js' => $js
        );
		
        $rootView = ROOT . 'views' . YP . $this->_controller . YP . $views . '.phtml';
        
		//<------ * views header * --------->
        if( is_readable( $rootView ) )
        {
            include $rootView;
        } else {
            throw new Exception('Error view');
        }
    } //<--- * End Render * --->

    public function setJs( array $js )
    {
    	$countJs = count( $js );
        if( is_array( $js ) && $countJs )
        {
            for( $i = 0; $i < $countJs; ++$i )
            {
                $this->_js[] = url . 'public/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error js');
        }
    } //<--- * End SetJs * --->
    
} //<-- * End Class * -->

/* End of file View.php */
/* Location: ./base/View.php */
