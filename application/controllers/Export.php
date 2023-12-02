<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{
    public function index()
    {
        $produk = $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left')->join('tb_satuan', 'tb_produk.id_satuan = tb_satuan.id_satuan', 'left')->get('tb_produk')->result();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Produk Orchard');
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Produk');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Kategori');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'SKU');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Satuan');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Stok');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Harga');
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

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);

        $yelow = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F7F700')
            )
        );

        $red = array(
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'F70000')
            )
        );

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setWrapText(true);

        // $spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(23);

        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(34.73);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(9.91);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(9.64);

        $kolom = 2;
        $no = 1;
        foreach ($produk as $d) {
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom, $no++);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $kolom, $d->nm_produk);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $kolom, $d->nm_kategori);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $kolom, $d->sku);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $kolom, $d->satuan);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $kolom, $d->stok);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $kolom, $d->harga);
            $kolom++;
        }

        $border_collom = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            )
        );

        $batas = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A1:G' . $batas)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data export product.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
