<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Kirim extends CI_Controller {

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

	public function index2()
     {

        
		$tgl1 = '2021-02-28';
		$tgl2 = '2021-03-3';
		$data = array(
			'tgl1'      => $tgl1,
			'tgl2'      => $tgl2,
			'app'       => $this->M_salon->summary_app1($tgl1, $tgl2),
			'penjualan'       => $this->M_salon->summary_app2($tgl1, $tgl2),
			'komisi'       => $this->M_salon->summary_app3($tgl1, $tgl2),
			'komisi_app'       => $this->M_salon->summary_app4($tgl1, $tgl2),
			'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
		); 
	
		$this->load->view('app/summary_export', $data);

      $pdfFilePath = FCPATH . '/asset/file/mpdf.pdf';
         ini_set('memory_limit', '32M');
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
          $data = $this->load->view('app/summary_export', [], TRUE);
          $mpdf->setAutoBottomMargin;
        $mpdf->setAutoTopMargin;
          $mpdf->WriteHTML($data);
         $mpdf->Output($pdfFilePath);
         redirect('kirim');
   }



	



}