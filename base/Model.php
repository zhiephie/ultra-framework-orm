<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : Model.php
 *  
 * 
 **************************************/
abstract class Model
{
	protected $db;
	
	public function __construct()
	{
		$this->db = Config::conn();
	}
	
} //<------------ * End Class * ------------->

/* End of file Model.php */
/* Location: ./base/Model.php */