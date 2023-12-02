<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_denda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

public function index(){
    $data = array(
        'title' => "List Peraturan / Denda", 
        'list' => $this->db->get('list_denda')->result(),
        
    );
    $this->load->view('list/denda', $data);
}

public function add(){
    $data = array(
        'nama_list' => $this->input->post('nama'), 
        'rupiah'=> $this->input->post('rupiah')
        
    );
    $this->db->insert('list_denda',$data);
    redirect('list_denda');
}

public function hapus($id){
    $this->db->where('id_list',$id);
    $this->db->delete('list_denda');
    redirect('list_denda');
}


	



}