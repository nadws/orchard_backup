<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Import extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('form_validation');
      $this->load->library('form_validation','upload');
		$this->load->helper(array('form','url'));// load library validation
        date_default_timezone_set('Asia/Makassar');
	}

    public function index(){
		// $data['pembeli'] = $this->db->query("SELECT * FROM bkin WHERE id %2 <> 0")->result_array();
        // $data['produk'] = $this->db->get('tb_produk')->result();
		$this->load->view('import/index');
	}

	public function import_cash(){
		// include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($_FILES['cash']['tmp_name']);
		// $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		// $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
		
		
		$data = array();
		$numrow = 1;
		foreach($sheet as $row){

		if($row['A'] == "" && $row['I'] == "" )
			continue;
	
		  if($numrow > 1){
	
        $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
        $month = date('m' , strtotime($row['A']));
        $year = date('Y' , strtotime($row['A']));

        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 1])->result()[0];
        $kode_akun = $this->db->where('id_akun', 1)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
        if($kode_akun == 0){
            $kode_akun = 1;
        }else{
            $kode_akun += 1;
        }
            $data_cash = [
                'id_buku' => 1,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                'id_akun' => 1,
                'debit' => $row['I'],
                'kredit' => 0,
                'tgl' => $row['A'],
                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                'admin' => 'rahman',
                'ket' => 'Penjualan'
            ];

            $this->db->insert('tb_jurnal',$data_cash);


        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 4])->result()[0];
        $kode_akun = $this->db->where('id_akun', 4)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
        if($kode_akun == 0){
            $kode_akun = 1;
        }else{
            $kode_akun += 1;
        }

            $data_penjualan = [
                'id_buku' => 1,
                'id_akun' => 4,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                'kredit' => $row['I'],
                'debit' => 0,
                'tgl' => $row['A'],
                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                'admin' => 'rahman',
            ];
                    
            $this->db->insert('tb_jurnal',$data_penjualan);
            // $id_produk = $this->db->insert_id();
            // $sku = 'OBP'.$id_produk;

            // $data_sku = [
            //     'sku' => $sku
            // ];

            // $this->db->where('id_produk', $id_produk);
            // $this->db->update('tb_produk', $data_sku);

		  }
		  
		  $numrow++; // Tambah 1 setiap kali looping

		  
		}
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		// $this->OrchardModel->insert_multiple_port($data);
	
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
					  Import Success</div>');
		redirect("Import");
			}

            public function import_bca(){
                // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($_FILES['bca']['tmp_name']);
                // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                
                
                $data = array();
                $numrow = 1;
                foreach($sheet as $row){
        
                if($row['A'] == "" && $row['I'] == "" && $row['J'] == "")
                    continue;
            
                  if($numrow > 1){
            
                $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                $month = date('m' , strtotime($row['A']));
                $year = date('Y' , strtotime($row['A']));
        
                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 2])->result()[0];
                $kode_akun = $this->db->where('id_akun', 2)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                if($kode_akun == 0){
                    $kode_akun = 1;
                }else{
                    $kode_akun += 1;
                }
                    $data_piutang = [
                        'id_buku' => 1,
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                        'id_akun' => 2,
                        'debit' => $row['I'],
                        'kredit' => 0,
                        'tgl' => $row['A'],
                        'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                        'admin' => 'rahman',
                        'ket' => 'Penjualan'
                    ];
        
                    $this->db->insert('tb_jurnal',$data_piutang);
        
        //penjualan
                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 4])->result()[0];
                $kode_akun = $this->db->where('id_akun', 4)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                if($kode_akun == 0){
                    $kode_akun = 1;
                }else{
                    $kode_akun += 1;
                }
        
                    $data_penjualan = [
                        'id_buku' => 1,
                        'id_akun' => 4,
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                        'kredit' => $row['I'],
                        'debit' => 0,
                        'tgl' => $row['A'],
                        'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                        'admin' => 'rahman',
                    ];
                            
                    $this->db->insert('tb_jurnal',$data_penjualan);
                    // $id_produk = $this->db->insert_id();
                    // $sku = 'OBP'.$id_produk;
        
                    // $data_sku = [
                    //     'sku' => $sku
                    // ];
        
                    // $this->db->where('id_produk', $id_produk);
                    // $this->db->update('tb_produk', $data_sku);

                    //penerimaan bank
                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 6])->result()[0];
                $kode_akun = $this->db->where('id_akun', 6)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                if($kode_akun == 0){
                    $kode_akun = 1;
                }else{
                    $kode_akun += 1;
                }
                    $data_bca = [
                        'id_buku' => 2,
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                        'id_akun' => 6,
                        'debit' => $row['J'],
                        'kredit' => 0,
                        'tgl' => $row['A'],
                        'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                        'admin' => 'rahman',
                        'ket' => 'Penjualan'
                    ];
        
                    $this->db->insert('tb_jurnal',$data_bca);
                
                    //piutang bca kredit

                    $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 2])->result()[0];
                    $kode_akun = $this->db->where('id_akun', 2)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                    if($kode_akun == 0){
                        $kode_akun = 1;
                    }else{
                        $kode_akun += 1;
                    }
                        $data_piutang = [
                            'id_buku' => 2,
                            'kd_gabungan' => $kd_gabungan,
                            'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                            'id_akun' => 2,
                            'kredit' => $row['I'],
                            'debit' => 0,
                            'tgl' => $row['A'],
                            'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                            'admin' => 'rahman',
                            'ket' => 'Penjualan'
                        ];
            
                        $this->db->insert('tb_jurnal',$data_piutang);
                
                //biaya admin bca
                
                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 54])->result()[0];
                $kode_akun = $this->db->where('id_akun', 54)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                if($kode_akun == 0){
                    $kode_akun = 1;
                }else{
                    $kode_akun += 1;
                }
                    $data_admin = [
                        'id_buku' => 2,
                        'kd_gabungan' => $kd_gabungan,
                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                        'id_akun' => 54,
                        'debit' => $row['I'] - $row['J'],
                        'kredit' => 0,
                        'tgl' => $row['A'],
                        'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                        'admin' => 'rahman',
                        'ket' => 'Penjualan'
                    ];
        
                    $this->db->insert('tb_jurnal',$data_admin);


        
                  }
                  
                  $numrow++; // Tambah 1 setiap kali looping
        
                  
                }
                // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                // $this->OrchardModel->insert_multiple_port($data);
            
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                              Import Success</div>');
                redirect("Import");
                    }
                    
                    public function import_mandiri(){
                        // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                        
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        $spreadsheet = $reader->load($_FILES['mandiri']['tmp_name']);
                        // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                        // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                        
                        
                        $data = array();
                        $numrow = 1;
                        foreach($sheet as $row){
                
                        if($row['A'] == "" && $row['I'] == "" && $row['J'] == "")
                            continue;
                    
                          if($numrow > 1){
                    
                        $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                        $month = date('m' , strtotime($row['A']));
                        $year = date('Y' , strtotime($row['A']));
                
                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 3])->result()[0];
                        $kode_akun = $this->db->where('id_akun', 3)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                        if($kode_akun == 0){
                            $kode_akun = 1;
                        }else{
                            $kode_akun += 1;
                        }
                            $data_piutang = [
                                'id_buku' => 1,
                                'kd_gabungan' => $kd_gabungan,
                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                'id_akun' => 3,
                                'debit' => $row['I'],
                                'kredit' => 0,
                                'tgl' => $row['A'],
                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                'admin' => 'rahman',
                                'ket' => 'Penjualan'
                            ];
                
                            $this->db->insert('tb_jurnal',$data_piutang);
                
                //penjualan
                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 4])->result()[0];
                        $kode_akun = $this->db->where('id_akun', 4)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                        if($kode_akun == 0){
                            $kode_akun = 1;
                        }else{
                            $kode_akun += 1;
                        }
                
                            $data_penjualan = [
                                'id_buku' => 1,
                                'id_akun' => 4,
                                'kd_gabungan' => $kd_gabungan,
                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                'kredit' => $row['I'],
                                'debit' => 0,
                                'tgl' => $row['A'],
                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                'admin' => 'rahman',
                            ];
                                    
                            $this->db->insert('tb_jurnal',$data_penjualan);
                            // $id_produk = $this->db->insert_id();
                            // $sku = 'OBP'.$id_produk;
                
                            // $data_sku = [
                            //     'sku' => $sku
                            // ];
                
                            // $this->db->where('id_produk', $id_produk);
                            // $this->db->update('tb_produk', $data_sku);
        
                            //penerimaan bank
                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 7])->result()[0];
                        $kode_akun = $this->db->where('id_akun', 7)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                        if($kode_akun == 0){
                            $kode_akun = 1;
                        }else{
                            $kode_akun += 1;
                        }
                            $data_bca = [
                                'id_buku' => 2,
                                'kd_gabungan' => $kd_gabungan,
                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                'id_akun' => 7,
                                'debit' => $row['J'],
                                'kredit' => 0,
                                'tgl' => $row['A'],
                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                'admin' => 'rahman',
                                'ket' => 'Penjualan'
                            ];
                
                            $this->db->insert('tb_jurnal',$data_bca);
                        
                            //piutang bca kredit
        
                            $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 3])->result()[0];
                            $kode_akun = $this->db->where('id_akun', 3)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                            if($kode_akun == 0){
                                $kode_akun = 1;
                            }else{
                                $kode_akun += 1;
                            }
                                $data_piutang = [
                                    'id_buku' => 2,
                                    'kd_gabungan' => $kd_gabungan,
                                    'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                    'id_akun' => 3,
                                    'kredit' => $row['I'],
                                    'debit' => 0,
                                    'tgl' => $row['A'],
                                    'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                    'admin' => 'rahman',
                                    'ket' => 'Penjualan'
                                ];
                    
                                $this->db->insert('tb_jurnal',$data_piutang);
                        
                        //biaya admin bca
                        
                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => 54])->result()[0];
                        $kode_akun = $this->db->where('id_akun', 54)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                        if($kode_akun == 0){
                            $kode_akun = 1;
                        }else{
                            $kode_akun += 1;
                        }
                            $data_admin = [
                                'id_buku' => 2,
                                'kd_gabungan' => $kd_gabungan,
                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                'id_akun' => 54,
                                'debit' => $row['I'] - $row['J'],
                                'kredit' => 0,
                                'tgl' => $row['A'],
                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                'admin' => 'rahman',
                                'ket' => 'Penjualan'
                            ];
                
                            $this->db->insert('tb_jurnal',$data_admin);
        
        
                
                          }
                          
                          $numrow++; // Tambah 1 setiap kali looping
                
                          
                        }
                        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                        // $this->OrchardModel->insert_multiple_port($data);
                    
                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                      Import Success</div>');
                        redirect("Import");
                            }

                            public function import_pengeluaran(){
                                // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                                
                                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                $spreadsheet = $reader->load($_FILES['pengeluaran']['tmp_name']);
                                // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                                // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                                $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                                
                                
                                $data = array();
                                $numrow = 1;
                                foreach($sheet as $row){
                        
                                if($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" )
                                    continue;
                            
                                  if($numrow > 1){
                            
                                // $month = date('m' , strtotime($row['A']));
                                // $year = date('Y' , strtotime($row['A']));
                        
                                

                                

                                    $pengeluaran = [

                                        'id_buku' => $row['B'],
                                        'id_akun' => $row['C'],
                                        'kd_gabungan' => $row['D'],
                                        'no_nota' => $row['E'],
                                        'debit' => $row['F'],
                                        'kredit' => $row['G'],
                                        'ttl_rp' => $row['L'],
                                        'tgl' => $row['N'],
                                        'tgl_input' => $row['N'] . ' '. date('H:i:s'),
                                        'admin' => $row['Q'],
                                        'ket' => $row['P']                              
                                    ];
                        
                                    $this->db->insert('tb_jurnal',$pengeluaran);                      

                                  }
                                  
                                  $numrow++; // Tambah 1 setiap kali looping
                        
                                  
                                }
                                // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                                // $this->OrchardModel->insert_multiple_port($data);
                            
                                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                              Import Success</div>');
                                redirect("Import");
                                    }
                            
                            public function import_pengeluaran1(){
                                // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                                
                                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                $spreadsheet = $reader->load($_FILES['pengeluaran']['tmp_name']);
                                // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                                // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                                $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                                
                                
                                $data = array();
                                $numrow = 1;

                                $kd_gabungan = 'ORC'.date('dmy' , strtotime('2021-01-03')). strtoupper(random_string('alpha',3));
                                $cek = 0;
                                $cek2 = 0;
                                foreach($sheet as $row){
                        
                                if($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" )
                                    continue;
                            
                                  if($numrow > 1){
                            
                                // $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                                if($cek != $cek2){
                                    $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['N'])). strtoupper(random_string('alpha',3));
                                    $cek2 ++;
                                }    

                                $month = date('m' , strtotime($row['N']));
                                $year = date('Y' , strtotime($row['N']));
                        
                                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $row['C']])->result()[0];
                                $kode_akun = $this->db->where('id_akun', $row['C'])->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                                if($kode_akun == 0){
                                    $kode_akun = 1;
                                }else{
                                    $kode_akun += 1;
                                }

                                $debit = 0;
                                $kredit = 0;

                                if($row['F'] == "" || $row['F'] == 'NULL'){
                                    $debit = 0;
                                }else{
                                    $debit = $row['F'];
                                }

                                if($row['G'] == "" || $row['G'] == 'NULL'){
                                    $kredit = 0;
                                }else{
                                    $kredit = $row['G'];
                                }

                                if($row['P'] == 'NULL'){
                                    $ket = '';
                                }else{
                                    $ket = $row['P'];
                                }

                                

                                    $pengeluaran = [
                                        'id_buku' => $row['B'],
                                        'kd_gabungan' => $kd_gabungan,
                                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['N'])).'-'.$kode_akun,
                                        'id_akun' => $row['C'],
                                        // 'debit' => $row['F'],
                                        // 'kredit' => $row['G'],
                                        'debit' => $debit,
                                        'kredit' => $kredit,
                                        'tgl' => $row['N'],
                                        'tgl_input' => $row['N'] . ' '. date('H:i:s'),
                                        'admin' => 'rahman',
                                        'ket' => $ket
                                    ];
                        
                                    $this->db->insert('tb_jurnal',$pengeluaran);
                        
                        
                               
                                    if($row['G'] != "" || $row['G'] != '0' || $row['G'] != NULL){
                                        $cek ++;
                                    }
                                  }
                                  
                                  $numrow++; // Tambah 1 setiap kali looping
                        
                                  
                                }
                                // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                                // $this->OrchardModel->insert_multiple_port($data);
                            
                                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                              Import Success</div>');
                                redirect("Import");
                                    }

                                    public function import_pengeluaran2(){
                                        // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                                        
                                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                        $spreadsheet = $reader->load($_FILES['pengeluaran']['tmp_name']);
                                        // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                                        // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                                        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                                        
                                        
                                        $data = array();
                                        $numrow = 1;
                                        foreach($sheet as $row){
                                
                                        if($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" )
                                            continue;
                                    
                                          if($numrow > 1){
                                    
                                        $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                                        $month = date('m' , strtotime($row['A']));
                                        $year = date('Y' , strtotime($row['A']));
                                
                                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $row['D']])->result()[0];
                                        $kode_akun = $this->db->where('id_akun', $row['D'])->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                                        if($kode_akun == 0){
                                            $kode_akun = 1;
                                        }else{
                                            $kode_akun += 1;
                                        }
        
                                        $debit = 0;
                                        $kredit = 0;
        
                                        if($row['F'] == ""){
                                            $debit = 0;
                                        }else{
                                            $debit = $row['F'];
                                        }
        
                                        if($row['G'] == ""){
                                            $kredit = 0;
                                        }else{
                                            $kredit = $row['G'];
                                        }
        
                                            $pengeluaran = [
                                                'id_buku' => 3,
                                                'kd_gabungan' => $kd_gabungan,
                                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                                'id_akun' => $row['D'],
                                                'debit' => $row['F'],
                                                'kredit' => $row['G'],
                                                'tgl' => $row['A'],
                                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                                'admin' => 'rahman',
                                                'ket' => $row['B']
                                            ];
                                
                                            $this->db->insert('tb_jurnal',$pengeluaran);
                                
                                
                                       
                                
                                          }
                                          
                                          $numrow++; // Tambah 1 setiap kali looping
                                
                                          
                                        }
                                        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                                        // $this->OrchardModel->insert_multiple_port($data);
                                    
                                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                                      Import Success</div>');
                                        redirect("Import");
                                            }

                                            public function import_penjualan_april(){
                                                // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                                                
                                                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                                $spreadsheet = $reader->load($_FILES['import_penjualan_april']['tmp_name']);
                                                // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                                                // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                                                $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                                                
                                                
                                                $data = array();
                                                $numrow = 1;
                
                                                $kd_gabungan = 'ORC'.date('dmy' , strtotime('2021-04-01')). strtoupper(random_string('alpha',3));
                                                $cek = 0;
                                                $cek2 = 0;
                                                foreach($sheet as $row){
                                        
                                                if($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" )
                                                    continue;
                                            
                                                  if($numrow > 1){
                                            
                                                // $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                                                if($cek != $cek2){
                                                    $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                                                    $cek2 ++;
                                                }    
                
                                                $month = date('m' , strtotime($row['A']));
                                                $year = date('Y' , strtotime($row['A']));
                                        
                                                $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $row['D']])->result()[0];
                                                $kode_akun = $this->db->where('id_akun', $row['D'])->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                                                if($kode_akun == 0){
                                                    $kode_akun = 1;
                                                }else{
                                                    $kode_akun += 1;
                                                }
                
                                                $debit = 0;
                                                $kredit = 0;
                
                                                if($row['F'] == "" || $row['F'] == 'NULL'){
                                                    $debit = 0;
                                                }else{
                                                    $debit = $row['F'];
                                                }
                
                                                if($row['G'] == "" || $row['G'] == 'NULL'){
                                                    $kredit = 0;
                                                }else{
                                                    $kredit = $row['G'];
                                                }
                
                                                if($row['B'] == 'NULL'){
                                                    $ket = '';
                                                }else{
                                                    $ket = $row['B'];
                                                }
                
                                                
                
                                                    $penerimaan = [
                                                        'id_buku' => 2,
                                                        'kd_gabungan' => $kd_gabungan,
                                                        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                                        'id_akun' => $row['D'],
                                                        // 'debit' => $row['F'],
                                                        // 'kredit' => $row['G'],
                                                        'debit' => $debit,
                                                        'kredit' => $kredit,
                                                        'tgl' => $row['A'],
                                                        'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                                        'admin' => 'rahman',
                                                        'ket' => $ket
                                                    ];
                                        
                                                    $this->db->insert('tb_jurnal',$penerimaan);
                                        
                                        
                                               
                                                    if($row['G'] != "" || $row['G'] != 0 || $row['G'] != NULL){
                                                        $cek ++;
                                                    }
                                                  }
                                                  
                                                  $numrow++; // Tambah 1 setiap kali looping
                                        
                                                  
                                                }
                                                // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                                                // $this->OrchardModel->insert_multiple_port($data);
                                            
                                                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                                              Import Success</div>');
                                                redirect("Import");
                                                    }        
        
                                    public function import_penjualan_april2(){
                                        // include APPPATH.'third_party/PHPExcel/PHPExcel.php';
                                        
                                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                        $spreadsheet = $reader->load($_FILES['import_penjualan_april']['tmp_name']);
                                        // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
                                        // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                                        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
                                        
                                        
                                        $data = array();
                                        $numrow = 1;
                                        foreach($sheet as $row){
                                
                                        if($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" )
                                            continue;
                                    
                                          if($numrow > 1){
                                    
                                        $kd_gabungan = 'ORC'.date('dmy' , strtotime($row['A'])). strtoupper(random_string('alpha',3));
                                        $month = date('m' , strtotime($row['A']));
                                        $year = date('Y' , strtotime($row['A']));
                                
                                        $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $row['D']])->result()[0];
                                        $kode_akun = $this->db->where('id_akun', $row['D'])->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
                                        if($kode_akun == 0){
                                            $kode_akun = 1;
                                        }else{
                                            $kode_akun += 1;
                                        }
        
                                        $debit = 0;
                                        $kredit = 0;
        
                                        if($row['F'] == ""){
                                            $debit = 0;
                                        }else{
                                            $debit = $row['F'];
                                        }
        
                                        if($row['G'] == ""){
                                            $kredit = 0;
                                        }else{
                                            $kredit = $row['G'];
                                        }
        
                                            $pengeluaran = [
                                                'id_buku' => 1,
                                                'kd_gabungan' => $kd_gabungan,
                                                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($row['A'])).'-'.$kode_akun,
                                                'id_akun' => $row['D'],
                                                'debit' => $debit,
                                                'kredit' => $kredit,
                                                'tgl' => $row['A'],
                                                'tgl_input' => $row['A'] . ' '. date('H:i:s'),
                                                'admin' => 'rahman',
                                                'ket' => $row['B']
                                            ];
                                
                                            $this->db->insert('tb_jurnal',$pengeluaran);              
                                
                                       
                                
                                          }
                                          
                                          $numrow++; // Tambah 1 setiap kali looping
                                
                                          
                                        }
                                        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                                        // $this->OrchardModel->insert_multiple_port($data);
                                    
                                        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                                                      Import Success</div>');
                                        redirect("Import");
                                            }                            


        public function export()
            {
                 $produk = $this->db->join('tb_satuan','tb_produk.id_satuan = tb_satuan.id_satuan')->join('tb_kategori','tb_produk.id_kategori = tb_kategori.id_kategori')->get('tb_produk')->result();
       
                 $spreadsheet = new Spreadsheet;
       
                 $spreadsheet->setActiveSheetIndex(0)
                             ->setCellValue('A1', 'Produk')
                             ->setCellValue('B1', 'Kategori')
                             ->setCellValue('C1', 'Satuan')
                             ->setCellValue('D1', 'SKU')
                             ->setCellValue('E1', 'Harga Modal')
                             ->setCellValue('F1', 'Harga Jual')
                             ->setCellValue('G1', 'Stok')
                             ->setCellValue('H1', 'Diskon')
                             ->setCellValue('I1', 'Komisi');
       
                 $kolom = 2;
                 foreach($produk as $p) {
       
                      $spreadsheet->setActiveSheetIndex(0)
                                  
                                  ->setCellValue('A' . $kolom, $p->nm_produk)
                                  ->setCellValue('B' . $kolom, $p->nm_kategori)
                                  ->setCellValue('C' . $kolom, $p->satuan)
                                  ->setCellValue('D' . $kolom, $p->sku)
                                  ->setCellValue('E' . $kolom, $p->harga_modal)
                                  ->setCellValue('F' . $kolom, $p->harga)
                                  ->setCellValue('G' . $kolom, $p->stok)
                                  ->setCellValue('H' . $kolom, $p->diskon)
                                  ->setCellValue('I' . $kolom, $p->komisi);
       
                      $kolom++;
       
                 }
       
                 $writer = new Xlsx($spreadsheet);
       
            header('Content-Type: application/vnd.ms-excel');
             header('Content-Disposition: attachment;filename="Data Produk Orchard.xlsx"');
             header('Cache-Control: max-age=0');
       
             $writer->save('php://output');
            }
}