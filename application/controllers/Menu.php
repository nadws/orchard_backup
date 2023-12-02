<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Makassar');
	}

	public function index(){
        $data = array(
			'title' => "Orchard", 
		);
        $this->load->view('tema/Header',$data);
        $this->load->view('tema/sidebar');
        $this->load->view('test/content');
        $this->load->view('tema/Footer');		
	}
}