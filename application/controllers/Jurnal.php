<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Jurnal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function export_akun()
    {
       $dt_akun = $this->db->get('tb_akun')->result();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Id Akun');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Akun');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Post Center');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'No Akun');
        
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'P&L');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Neraca');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Penyesuaian');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Neraca Saldo');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Penutup');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Aktiva lancar');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Aktiva Tetap');
		$spreadsheet->getActiveSheet()->setCellValue('L1', 'Ekuitas');
		$spreadsheet->getActiveSheet()->setCellValue('M1', 'Pendapatan');
		$spreadsheet->getActiveSheet()->setCellValue('N1', 'Pengeluaran');
		$spreadsheet->getActiveSheet()->setCellValue('O1', 'Biaya Fix');
        $spreadsheet->getActiveSheet()->setCellValue('P1', 'PPH Terhutang');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', 'Pendapatan Bunga');

        $style = array(
            'font' => array(
                'size' => 9
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($style);


        $spreadsheet->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setWrapText(true);

        // $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AS')->setWidth(2);

        // $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(23);

        $kolom = 2;
        foreach ($dt_akun as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $d->id_akun);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, $d->nm_akun);
            
            $dt_post_center = $this->db->get_where('tb_post_center',['id_akun' => $d->id_akun])->result();

            $post_center = [];

            foreach($dt_post_center as $dtp){
                $post_center [] = $dtp->nm_post;
            }

            $post_center2 = implode(',',$post_center);

            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, $post_center2);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom, $d->no_akun);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, $d->pl);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->neraca);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->penyesuaian);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $kolom, $d->neraca_saldo);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $kolom, $d->penutup);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $kolom, $d->aktiva_l);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $kolom, $d->aktiva_t);
			$spreadsheet->getActiveSheet()->setCellValue('L' . $kolom, $d->ekuitas);
			$spreadsheet->getActiveSheet()->setCellValue('M' . $kolom, $d->pendapatan);
			$spreadsheet->getActiveSheet()->setCellValue('N' . $kolom, $d->pengeluaran);
			$spreadsheet->getActiveSheet()->setCellValue('O' . $kolom, $d->biaya_fix);
            $spreadsheet->getActiveSheet()->setCellValue('P' . $kolom, $d->pph_hutang);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $kolom, $d->pendapatan_bank);

            $kolom++;
        }

        $batas = $kolom - 1;
        // $spreadsheet->getActiveSheet()->getStyle('A')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD);

            $border_collom = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ),
                )
            );

        // $spreadsheet->getActiveSheet()->getStyle('E')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        // $spreadsheet->getActiveSheet()->getStyle('G')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        // $spreadsheet->getActiveSheet()->getStyle('H')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        
        $spreadsheet->getActiveSheet()->getStyle('A1:Q' . $batas)->applyFromArray($border_collom);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Akun.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function import_akun()
    {

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($_FILES['data_akun']['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $data = array();
        $numrow = 1;
        $numrow2 = 1;


            foreach ($sheet as $row) {
                if ($row['A'] == "" && $row['B'] == "" && $row['C'] == "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" && $row['H'] == "" && $row['I'] == "" && $row['J'] == "" && $row['K'] == "" && $row['L'] == "" && $row['M'] == "" && $row['N'] == "")
                    continue;

                if ($numrow > 1) {
                    $data = [
                        'nm_akun' => $row['B'],
                        'no_akun' => $row['D'],
                        'pl' => $row['E'],
                        'neraca' => $row['F'],
                        'penyesuaian' => $row['G'],
                        'neraca_saldo' => $row['H'],
                        'penutup' => $row['I'],
                        'aktiva_l' => $row['J'],
                        'aktiva_t' => $row['K'],
                        'ekuitas' => $row['L'],
                        'pendapatan' => $row['M'],
                        'pengeluaran' => $row['N'],
                        'biaya_fix' => $row['O'],
                        'pph_hutang' => $row['P'],
                        'pendapatan_bank' => $row['Q'],
                    ];
                    $this->db->where('id_akun', $row['A']);
                    $this->db->update('tb_akun', $data);

                    $center = explode(",", $row['C']);

                    // $this->db->where('id_akun', $row['A']);
                    // $this->db->delete('tb_post_center');
                    

                    $dt_post_center = $this->db->get_where('tb_post_center',['id_akun' => $row['A']])->result();

                    if (empty($row['C'])) {
                        continue;
                    } elseif(!$dt_post_center) {
                        if (is_numeric($row['A'])) {
                            
                                foreach ($center as $c) {
                                    $data = [
                                        'id_akun' => $row['A'],
                                        'nm_post' => $c
                                    ];
                                    $this->db->insert('tb_post_center', $data);
                                }
                            
                            
                        }
                    }elseif(count($center) == count($dt_post_center)){
                        for($count = 0; $count<count($center); $count++){
                            $dt_update = [
                                'nm_post' => $center[$count]
                            ];
                            $this->db->where('id_post',$dt_post_center[$count]->id_post);
                            $this->db->update('tb_post_center',$dt_update);
                        }
                    }elseif(count($center) > count($dt_post_center)){
                        for($count = 0; $count<count($dt_post_center); $count++){
                            $dt_update = [
                                'nm_post' => $center[$count]
                            ];
                            $this->db->where('id_post',$dt_post_center[$count]->id_post);
                            $this->db->update('tb_post_center',$dt_update);
                        }

                        for($batas = $count; $batas<count($center); $batas++){
                            $data = [
                                'id_akun' => $row['A'],
                                'nm_post' => $center[$count]
                            ];
                            $this->db->insert('tb_post_center', $data);
                        }

                    }
                }

                $numrow++; // Tambah 1 setiap kali looping
            }




            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Import Berhasil! <i class="fas fa-check-circle"></i></div></div>');
    	redirect(base_url('Match/akun'), 'refresh');
        
    }

    public function test_count()
    {
       var_dump(count($this->db->get_where('tb_post_center',['id_akun' => 70])->result()));
    }

	public function add_relation_akun()
	{
		$id_akun = $this->input->post('id_akun');

		$cek = $this->db->get_where('tb_relasi_akun',['id_akun' => $id_akun])->row();

		if($cek){
			$data = [
				'id_relation_debit' => $this->input->post('id_relation_debit'),
				'id_relation_kredit' => $this->input->post('id_relation_kredit'),
			];
			$this->db->where('id_akun',$id_akun);
			$this->db->update('tb_relasi_akun',$data);
		}else{
			$data = [
				'id_akun' => $id_akun,
				'id_relation_debit' => $this->input->post('id_relation_debit'),
				'id_relation_kredit' => $this->input->post('id_relation_kredit'),
			];
			$this->db->insert('tb_relasi_akun',$data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan! <i class="fas fa-check-circle"></i></div></div>');
    	redirect(base_url('Match/akun'), 'refresh');
	}

	public function get_relation_akun()
	{
        $id_akun = $this->input->post('id_akun');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $last_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $tgl = $year.'-'.$month.'-'.$last_day;

		$dt_relation = $this->db->select('tb_relasi_akun.id_relation_debit as id_debit, a.nm_akun as akun_debit, tb_relasi_akun.id_relation_kredit as id_kredit, b.nm_akun as akun_kredit')->join('tb_akun as a','tb_relasi_akun.id_relation_debit = a.id_akun','left')->join('tb_akun as b','tb_relasi_akun.id_relation_kredit = b.id_akun','left')->where('tb_relasi_akun.id_akun',$id_akun)->get('tb_relasi_akun')->row();        

        $data = [
            'dt_relation' => $dt_relation,
            'tgl' => $tgl
        ];
        return $this->load->view('pembukuan/form_penyesuaian',$data);
    }

    public function add_penyesuaian(){
        $kd_gabungan = 'ORC'.date('dmy'). strtoupper(random_string('alpha',3));
        $tgl = $this->input->post('tgl');
        $id_akun = $this->input->post('id_akun');
        $metode = $this->input->post('metode');
        $ket = 'Penyesuaian';
        $total = $this->input->post('total');
        $debit = $this->input->post('debit');
        $kredit = $this->input->post('kredit');
        // $total = $this->input->post('total');
        $admin = $this->session->userdata('nm_user');
    
            $month = date('m' , strtotime($tgl));
            $year = date('Y' , strtotime($tgl));
    
            $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $id_akun])->result()[0];
            $kode_akun = $this->db->where('id_akun', $id_akun)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
            if($kode_akun == 0){
                $kode_akun = 1;
            }else{
                $kode_akun += 1;
            }
    
            $get_kd_metode = $this->db->get_where('tb_akun',['id_akun' => $metode])->result()[0];
            $kode_metode = $this->db->where('id_akun', $metode)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
            if($kode_metode == 0){
              $kode_metode = 1;
            }else{
                $kode_metode += 1;
            }
    
        // $total = 0;
        // for($count = 0; $count<count($ttl_rp); $count++){
        //   $total += $ttl_rp[$count];
        // }
    
        $get_akun = $this->db->get_where('tb_akun',['id_akun'=>$id_akun])->row();
        
        $data_metode = [
          'id_buku' => 4,
          'id_akun' => $metode,
          'kd_gabungan' => $kd_gabungan,
          'no_nota' => $get_kd_metode->kd_akun.date('my' , strtotime($tgl)).'-'.$kode_metode,
          'kredit' => $kredit,
          'ket' => $ket,
          'tgl' => $tgl,
          'tgl_input' => date('Y-m-d H:i:s'),
          'admin' => $admin,
          'ket'=>'Penyesuaian '.$get_akun->nm_akun
      ];
    
      $this->db->insert('tb_jurnal',$data_metode);
    
      $data_jurnal = [
        'id_buku' => 4,
        'id_akun' => $id_akun,
        'kd_gabungan' => $kd_gabungan,
        'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($tgl)).'-'.$kode_akun,
        'debit' => $debit,
        'ket' => $ket,
        'tgl' => $tgl,
        'tgl_input' => date('Y-m-d H:i:s'),
        'admin' => $admin,
    ];
    
    $this->db->insert('tb_jurnal',$data_jurnal);
    
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diinput!<div class="ml-5 btn btn-sm"></div></div>');
    redirect(isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '');
    
    }

    public function add_post_center()
    {    
        $cek_post_center = $this->db->get_where('tb_post_center',['nm_post' => $this->input->post('nm_post'), 'id_akun' => $this->input->post('id_akun')])->row();
        if($cek_post_center){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Post center sudah ada! </div>');
            redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        }else{
            $data = [
                'id_akun' => $this->input->post('id_akun'),
                'nm_post' => $this->input->post('nm_post')
            ];

            $this->db->insert('tb_post_center',$data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Post center berhasil dibuat! </div>');
            redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        }
    
    }

    public function get_post_center()
    {
        $id_akun = $this->input->post('id_akun');
        $dt_post = $this->db->get_where('tb_post_center',['id_akun' => $id_akun])->result();
        $id_post = $this->input->post('id_post');
        if($dt_post){
            echo '<option value="">-Pilih Post Center-</option>';
        }
        
        foreach($dt_post as $dp){
            if($id_post == $dp->id_post){
                echo '<option selected value="'.$dp->id_post.'">'.$dp->nm_post.'</option>';
            }else{
                echo '<option value="'.$dp->id_post.'">'.$dp->nm_post.'</option>';
            }
            
        }
    }

    public function get_count_post_center()
    {
        $id_akun = $this->input->post('id_akun');
        $dt_post = $this->db->select('COUNT(id_post) as count_post')->get_where('tb_post_center',['id_akun' => $id_akun])->row();

        echo $dt_post->count_post;

    }

    public function add_post_center_jurnal()
    {
        $id_akun = $this->input->post('id_akun');
        $nm_post = $this->input->post('nm_post');

        $data = [
            'id_akun' => $id_akun,
            'nm_post' => $nm_post
        ];

        $this->db->insert('tb_post_center',$data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diinput!<div class="ml-5 btn btn-sm"></div></div>');
        redirect(isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '');
    }

    public function get_data_post_center()
    {
        $id_akun = $this->input->post('id_akun');
        $data = [
            'post_center' => $this->db->get_where('tb_post_center',['id_akun' => $id_akun])->result()
        ];

       return $this->load->view('pembukuan/post_center',$data);
    }

    public function drop_post_center($id_post)
    {
        $cek = $this->db->get_where('tb_jurnal',['id_post_center' => $id_post])->result();
        if($cek){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal! data post center sudah masuk di data jurnal<div class="ml-5 btn btn-sm"></div></div>');
            redirect(isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '');
        }else{
            $this->db->where('id_post',$id_post);
            $this->db->delete('tb_post_center');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!<div class="ml-5 btn btn-sm"></div></div>');
            redirect(isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '');
        }
    }


    public function add_pengeluaran(){
        $kd_gabungan = 'ORC'.date('dmy'). strtoupper(random_string('alpha',3));
        $tgl = $this->input->post('tgl');
        $id_akun = $this->input->post('id_akun');
        $metode = $this->input->post('metode');
        $ket = $this->input->post('ket');
        $ttl_rp = $this->input->post('ttl_rp');
        // $total = $this->input->post('total');
        $admin = $this->session->userdata('nm_user');
    
        $id_satuan = $this->input->post('id_satuan');
        $qty = $this->input->post('qty');
        $rp_beli = $this->input->post('rp_beli');
        $id_post_center = $this->input->post('id_post_center');
    
    
            $month = date('m' , strtotime($tgl));
            $year = date('Y' , strtotime($tgl));
    
            $get_kd_akun = $this->db->get_where('tb_akun',['id_akun' => $id_akun])->result()[0];
             // $kode_akun = $this->db->where('id_akun', $id_akun)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
            
            // if($kode_akun == 0){
            //     $kode_akun = 1;
            // }else{
            //     $kode_akun += 1;
            // }
            
            $get_urutan_akun = $this->db->order_by('no_nota','DESC')->get_where('tb_jurnal',[
                'id_akun' => $id_akun,
                'MONTH(tgl)' => $month,
                'YEAR(tgl)' => $year
              ])->row();
      
              // var_dump ($get_urutan_akun);
      
              if($get_urutan_akun){
                $pecah = explode("-" , $get_urutan_akun->no_nota);
                $kode_akun = $pecah[1] + 1;
              }else{
                $kode_akun = 1;
              }
    
            $get_kd_metode = $this->db->get_where('tb_akun',['id_akun' => $metode])->result()[0];
            $kode_metode = $this->db->where('id_akun', $metode)->where('MONTH(tgl)', $month)->where('YEAR(tgl)',$year)->get('tb_jurnal')->num_rows();
            if($kode_metode == 0){
              $kode_metode = 1;
            }else{
                $kode_metode += 1;
            }
    
        $total = 0;
        for($count = 0; $count<count($ttl_rp); $count++){
          $total += $ttl_rp[$count];
        }
    
        $dt_ak = $this->db->get_where('tb_akun',['id_akun'=>$id_akun])->row();
        
        $data_metode = [
          'id_buku' => 3,
          'id_akun' => $metode,
          'kd_gabungan' => $kd_gabungan,
          'no_nota' => $get_kd_metode->kd_akun.date('my' , strtotime($tgl)).'-'.$kode_metode,
          'kredit' => $total,
          'tgl' => $tgl,
          'tgl_input' => date('Y-m-d H:i:s'),
          'admin' => $admin,
          'ket'=>$dt_ak->nm_akun
      ];
    
      $this->db->insert('tb_jurnal',$data_metode);
    
      if(!empty($id_satuan)){
        for($count = 0; $count<count($ttl_rp); $count++){
            // $total += $ttl_rp[$count];
    
            //jurnal
            $data_jurnal = [
                'id_buku' => 3,
                'id_akun' => $id_akun,
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($tgl)).'-'.$kode_akun,
                'debit' => $ttl_rp[$count],
                'ket' => $ket[$count],
                'id_post_center' => $id_post_center[$count],
                'tgl' => $tgl,
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
      
                'qty' => $qty[$count],
                'id_satuan' => $id_satuan[$count],
                'rp_beli' => $rp_beli[$count],
                'ttl_rp' => $ttl_rp[$count],
            ];
      
            $this->db->insert('tb_jurnal',$data_jurnal);
    
            //peralatan
            $data_peralatan = [
                'kd_gabungan' => $kd_gabungan,
                'ket' => $ket[$count],
                'rp_beli' => $rp_beli[$count],
                'qty' => $qty[$count],
                'id_satuan' => $id_satuan[$count],
                'ttl_rp' => $ttl_rp[$count],            
                'tgl' => $tgl,
                'admin' => $admin    
            ];
    
            $this->db->insert('tb_peralatan',$data_peralatan);
    
            // $kode_akun++;
          }
      }else{
        for($count = 0; $count<count($ket); $count++){
            // $total += $ttl_rp[$count];
            $data_jurnal = [
                'id_buku' => 3,
                'id_akun' => $id_akun,
                'id_post_center' => $id_post_center[$count],
                'kd_gabungan' => $kd_gabungan,
                'no_nota' => $get_kd_akun->kd_akun.date('my' , strtotime($tgl)).'-'.$kode_akun,
                'debit' => $ttl_rp[$count],
                'ket' => $ket[$count],
                'tgl' => $tgl,
                'ttl_rp' => $ttl_rp[$count],
                'tgl_input' => date('Y-m-d H:i:s'),
                'admin' => $admin,
            ];
      
            $this->db->insert('tb_jurnal',$data_jurnal);
            // $kode_akun++;
          }
      }
    
        
    
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diinput!<div class="ml-5 btn btn-sm"></div></div>');
        redirect(base_url("match/laporan_bulanan"),'refresh');
    }

    public function get_detail_jurnal()
    {
        $id_akun = $this->input->post('id_akun');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $dt_detail = $this->db->query("SELECT tb_post_center.nm_post, kd_gabungan,ket,debit,kredit,no_nota,tgl, ps.pasangan, tb_jurnal.admin
        FROM tb_jurnal
        LEFT JOIN(SELECT tb_akun.nm_akun as pasangan, tb_jurnal.kd_gabungan as gabungan FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.id_akun != $id_akun GROUP BY tb_jurnal.kd_gabungan) ps on tb_jurnal.kd_gabungan = ps.gabungan
        LEFT JOIN tb_post_center ON tb_jurnal.id_post_center = tb_post_center.id_post
        WHERE tb_jurnal.id_akun = $id_akun AND MONTH(tb_jurnal.tgl) = '$month' AND YEAR(tb_jurnal.tgl) = '$year' ORDER BY tb_jurnal.tgl ASC")->result();
    
        $data = [
            'dt_detail' => $dt_detail,
        ];

        return $this->load->view('pembukuan/detail_jurnal',$data);
    }

    public function get_detail_jurnal_post()
    {
        $id_akun = $this->input->post('id_akun');
        $id_post = $this->input->post('id_post');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $dt_detail = $this->db->query("SELECT tb_post_center.nm_post, kd_gabungan,ket,debit,kredit,no_nota,tgl, ps.pasangan, tb_jurnal.admin
        FROM tb_jurnal
        LEFT JOIN(SELECT tb_akun.nm_akun as pasangan, tb_jurnal.kd_gabungan as gabungan FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.id_akun != $id_akun GROUP BY tb_jurnal.kd_gabungan) ps on tb_jurnal.kd_gabungan = ps.gabungan
        LEFT JOIN tb_post_center ON tb_jurnal.id_post_center = tb_post_center.id_post

        WHERE tb_jurnal.id_akun = $id_akun AND tb_jurnal.id_post_center = $id_post AND MONTH(tb_jurnal.tgl) = '$month' AND YEAR(tb_jurnal.tgl) = '$year' ORDER BY tb_jurnal.tgl ASC")->result();
    
        $data = [
            'dt_detail' => $dt_detail,
        ];

        return $this->load->view('pembukuan/detail_jurnal',$data);
    }


    public function edit_jurnal_pengeluaran(){
        $tgl = $this->input->post('tgl');
        $metode = $this->input->post('metode');
        $ket = $this->input->post('ket');
        $ttl_rp = $this->input->post('ttl_rp');
        $admin = $this->session->userdata('nm_user');
        $id_akun = $this->input->post('id_akun');
        $id_post_center = $this->input->post('id_post_center');
        $id_jurnal = $this->input->post('id_jurnal');
        // $id_satuan = $this->input->post('id_satuan');
        // $qty = $this->input->post('qty');
        // $rp_beli = $this->input->post('rp_beli');
    
        // $rp_pajak = $this->input->post('rp_pajak');
        // $id_produk = $this->input->post('id_produk');
    
        $id_jurnal_kredit = $this->input->post('id_jurnal_kredit');
    
        //metode
    
        $total = 0;
        
            for($count = 0; $count<count($ttl_rp); $count++){
                $total += $ttl_rp[$count];
    
                $data_akun = [
                    'id_akun' => $id_akun[$count],
                    'id_post_center' => $id_post_center[$count],
                    'kredit' => 0,
                    'debit' => $ttl_rp[$count],
                    'tgl' => $tgl,
                    'ket'=>$ket[$count],
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'admin' => $admin,
                ];
            
            
                $this->db->where('id_jurnal',$id_jurnal[$count]);  
                $this->db->update('tb_jurnal',$data_akun);
              }
    
        
    
        $data_metode = [
            'id_akun' => $metode,
            'kredit' => $total,
            'debit' => 0,
            'tgl' => $tgl,
          //   'ket'=>'BKIN',
            'tgl_input' => date('Y-m-d H:i:s'),
            'admin' => $admin,
        ];
    
    
        $this->db->where('id_jurnal',$id_jurnal_kredit);  
        $this->db->update('tb_jurnal',$data_metode);
    
        redirect("Match/laporan_bulanan",'refresh');
      }

      public function drop_pengeluaran($kd_gabungan){
        //jurnal  
        $this->db->where('kd_gabungan',$kd_gabungan);
        $this->db->delete('tb_jurnal');
    
        //peralatan
        $this->db->where('kd_gabungan',$kd_gabungan);
        $this->db->delete('tb_peralatan');
    
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!<div class="ml-5 btn btn-sm"></div></div>');
        redirect(base_url("match/laporan_bulanan"),'refresh');
    
      }
      
      
      public function exort_cash_flow()
  {

    $tgl1 = $this->input->get('tgl1');
    $tgl2 = $this->input->get('tgl2');
    

    $kas_dll_harian =  $this->db->query("SELECT tb_akun.nm_akun, ps.debit, kredit,tgl, ps.urutan, ps.no_urutan, ps.no_nota, ps.keterangan, ps.pasangan , ps.kategori, ps.post_center
    FROM tb_jurnal
    LEFT JOIN(SELECT tb_jurnal.urutan as urutan, tb_jurnal.no_urutan as no_urutan, tb_jurnal.no_nota as no_nota, tb_akun.nm_akun as pasangan, tb_post_center.nm_post as post_center, tb_jurnal.kd_gabungan as gabungan, tb_jurnal.ket as keterangan, tb_akun.id_kategori as kategori, tb_jurnal.debit FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun LEFT JOIN tb_post_center ON tb_jurnal.id_post_center = tb_post_center.id_post WHERE tb_akun.id_akun NOT IN(13,73,74) ) ps on tb_jurnal.kd_gabungan = ps.gabungan
    LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun
    WHERE tb_jurnal.id_akun IN(13,73,74) AND tb_jurnal.id_buku != 5 AND tb_jurnal.kredit > 0 AND  tb_jurnal.tgl >= '$tgl1' AND tb_jurnal.tgl <= '$tgl2'
    ORDER BY ps.urutan ASC
    ")->result();

  //   $data = [

     
    
  //     'kas_dll_harian' => $kas_dll_harian,
  //     'gantung_harian' => $this->db->get_where('tb_jurnal_gantung',[
  //       'jenis' => 'KELUAR', 
  //       'tgl >=' => $tgl1,
  //       'tgl <=' => $tgl2
  //       ])->row(),  

  //   'tgl1' => $tgl1,
  //   'tgl2' => $tgl2

  // ];


    // $this->load->view('summary/export_harian',$data);


    $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Cash Flow');
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Akun2');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Akun');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'No id');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Post Center');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Keterangan');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Jumlah');

        $style = array(
            'font' => array(
                'size' => 12
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ),
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);


        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setWrapText(true);

        // $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(2);
        // $spreadsheet->getActiveSheet()->getColumnDimension('AS')->setWidth(2);

        // $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(23);

        $kolom = 2;
        foreach ($kas_dll_harian as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $d->nm_akun);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, $d->pasangan);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, $d->no_urutan);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom,  date('d-m-Y', strtotime($d->tgl)));            
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, $d->post_center);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->keterangan);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->debit,2);
            $kolom++;
        }

        $batas = $kolom - 1;
        // $spreadsheet->getActiveSheet()->getStyle('A')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD);

            $border_collom = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ),
                )
            );

        // $spreadsheet->getActiveSheet()->getStyle('E')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        // $spreadsheet->getActiveSheet()->getStyle('G')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        // $spreadsheet->getActiveSheet()->getStyle('H')
        // ->getNumberFormat()
        // ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

        
        $spreadsheet->getActiveSheet()->getStyle('A1:G' . $batas)->applyFromArray($border_collom);

        

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Cash Flow Orchard.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

  }


}