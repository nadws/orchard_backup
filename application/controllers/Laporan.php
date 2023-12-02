<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function laporan_target(){

        $hari  = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        if(empty($this->input->get('tgl1'))){
            $dt_a   = date('Y-m-01');
            // $dt_b   = date('Y-m-').$hari;
            $dt_b   = date('Y-m-10');
        }else{
            $dt_a   = $this->input->get('tgl1');
            // $dt_b   = $this->input->post('tgl2');
            // $dt_b = date('Y-m-d', strtotime('+1 days', strtotime($this->input->get('tgl2'))));
            $dt_b   = $this->input->get('tgl2');
        } 
            
            $data = [
                'title' => 'laporan komisi',
                'komisi' => $this->db->query("SELECT tb_karyawan.id_kry, nm_kry, tb_komisi_app.total_app, komisi.total_produk FROM tb_karyawan
                LEFT JOIN (SELECT komisi.id_kry, SUM(komisi.komisi) as total_produk FROM komisi WHERE komisi.tgl BETWEEN '$dt_a' AND '$dt_b' GROUP BY komisi.id_kry) komisi ON tb_karyawan.id_kry = komisi.id_kry
                LEFT JOIN (SELECT tb_komisi_app.id_kry, SUM(tb_komisi_app.komisi) as total_app FROM tb_komisi_app WHERE tb_komisi_app.tgl BETWEEN '$dt_a' AND '$dt_b' GROUP BY tb_komisi_app.id_kry) tb_komisi_app ON tb_karyawan.id_kry = tb_komisi_app.id_kry")->result(),
                'tgl1' => $dt_a,
                'tgl2' => $dt_b    
            ];
        
    
    
        // $data = [
        //     'title' => 'laporan komisi',
        //     'komisi' => $this->db->query("SELECT nm_kry, tb_komisi_app.total_app, komisi.total_produk FROM tb_karyawan
        //     LEFT JOIN (SELECT komisi.id_kry, SUM(komisi.komisi) as total_produk FROM komisi GROUP BY komisi.id_kry) komisi ON tb_karyawan.id_kry = komisi.id_kry
        //     LEFT JOIN (SELECT tb_komisi_app.id_kry, SUM(tb_komisi_app.komisi) as total_app FROM tb_komisi_app GROUP BY tb_komisi_app.id_kry) tb_komisi_app ON tb_karyawan.id_kry = tb_komisi_app.id_kry")->result()
    
        // ];
    
        $this->load->view('laporan/laporan_target',$data);
    }
    



	



}