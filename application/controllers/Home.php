<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() 
    {
		parent::__construct();		

    }
    
	function index()
	{
		$data['title'] = 'Home';
        $data['product_list'] = $this->common->getWhere('tbl_product', array('is_delete'=>0));
		$this->load->view('home', $data);
	}

}
