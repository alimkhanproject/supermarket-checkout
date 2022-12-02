<?php

class MY_Controller extends CI_Controller
{

	public $user;
    
    function __construct(){

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('email');

        $this->load->library('upload');   

        $this->load->helper('cookie');
        $this->load->helper('string');
        $this->load->helper('html');

        $this->load->model('Common_model', 'common');

        $this->load->library('cart'); 

        //date_default_timezone_set('UTC');
        date_default_timezone_set('Asia/Kolkata');
    }

    protected function _response($response = array())
    {
        return json_encode($response);
    }
}
