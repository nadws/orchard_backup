<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
        $data = array(
			'title' => "Beranda", 
		);
        $this->load->view('tema/Header',$data);
        $this->load->view('tema/sidebar');
        $this->load->view('test/content');
        $this->load->view('tema/Footer');		
	}



	



}