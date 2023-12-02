<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public function __construct(){
        
		parent::__construct();
        if(!$this->session->userdata('nm_user')){
            redirect('Login');
          }
		date_default_timezone_set('Asia/Makassar');
	}


      public function index()
      {

        if($this->input->get('tgl1')){
            $tgl1 = $this->input->get('tgl1');
            $tgl2 = $this->input->get('tgl2');
        }else{
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-t');
        }
            
              $data = array(
                    'title'  => "Extra Time & Request",
                    'service' => $this->db->get('tb_service_request')->result(),
                    'req' => $this->db->query("SELECT a.*, b.nm_kry, d.nm_service FROM tb_request AS a
                    LEFT JOIN tb_karyawan as b ON a.id_kry = b.id_kry
                    LEFT JOIN tb_service_request AS d ON a.id_service = d.id_service
                    WHERE a.tgl >= '$tgl1' AND a.tgl <= '$tgl2'
                    ORDER BY a.tgl DESC
                    ")->result(),
                    'kry' => $this->db->get('tb_karyawan')->result()
              );
         
          $this->load->view('request/index', $data);
          
      }

      public function add_request()
      {
          $tgl = $this->input->post('tgl');
          $id_service = $this->input->post('id_service');
          $id_kry = $this->input->post('id_kry');
          $admin = $this->session->userdata('nm_user');

          $kd_gabungan = 'RQ'.date('ymd') . strtoupper(random_string('alpha', 3));

          $jml_therapist = count($id_kry);

          $dt_service = $this->db->get_where('tb_service_request',['id_service' => $id_service])->row();
          
          $jml_orchard = ($dt_service->harga * (100 - $dt_service->komisi)) / 100;
          
          $jml_komisi = (($dt_service->harga * $dt_service->komisi) / 100) / $jml_therapist;

          for ($x = 0; $x < sizeof($id_kry); $x++) {
            $data_terapis = [
                'id_service' => $id_service,
                'komisi' => $jml_komisi,
                'id_kry' => $id_kry[$x],
                'tgl' => $tgl,
                'admin' => $admin,
                'kd_gabungan' => $kd_gabungan
            ];
  
            $this->db->insert('tb_request',$data_terapis);
          }

          $data_orchard = [
              'id_service' => $id_service,
              'komisi' => $jml_orchard,
              'id_kry' => 12,
              'tgl' => $tgl,
              'admin' => $admin,
              'kd_gabungan' => $kd_gabungan
          ];

          $this->db->insert('tb_request',$data_orchard);

        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data berhasil diinput!<div class="ml-5 btn btn-sm"></div></div>');
        redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
      }

      public function drop_request($kd_gabungan)
      {
          $this->db->where('kd_gabungan',$kd_gabungan);
          $this->db->delete('tb_request');

          $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data berhasil hapus!<div class="ml-5 btn btn-sm"></div></div>');
        redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
      }

      public function summary_request()
      {
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');

        $dt_request = $this->db->query("SELECT b.nm_kry, SUM(a.komisi) as ttl_komisi FROM tb_request AS a
        LEFT JOIN tb_karyawan as b ON a.id_kry = b.id_kry
        WHERE a.tgl >= '$tgl1' AND a.tgl <= '$tgl2'
        GROUP BY a.id_kry")->result();

        $data = [
            'dt_request' => $dt_request,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        ];

        $this->load->view('request/excel',$data);

      }
  
      
}