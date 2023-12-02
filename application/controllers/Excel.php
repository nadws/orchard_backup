<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Excel extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('form_validation');
      $this->load->library('form_validation','upload');
		$this->load->helper(array('form','url'));// load library validation
	}

	public function import_data(){
		// include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($_FILES['produk']['tmp_name']);
		// $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		// $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		$numrow = 1;
		foreach($sheet as $row){
		  // Cek $numrow apakah lebih dari 1
		  // Artinya karena baris pertama adalah nama-nama kolom
		  // Jadi dilewat saja, tidak usah diimport
		if($row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" && $row['H'] == "" && $row['I'] == "")
			continue;
	
		  if($numrow > 1){
			// Kita push (add) array data ke variabel data
			$data =  array(
			'harga_modal'=> preg_replace("/[^0-9]/", "", $row['E']),
			'harga'=>preg_replace("/[^0-9]/", "", $row['F']),
			'stok'=>preg_replace("/[^0-9]/", "", $row['G']),
			'diskon'=>preg_replace("/[^0-9]/", "", $row['H']),
            'komisi'=>preg_replace("/[^0-9]/", "", $row['I']), 
		  );

          $this->db->where('sku',$row['D']);
		  $this->db->update('tb_produk', $data);

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
		redirect("Match/produk");
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