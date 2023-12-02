<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lajur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if (empty($this->input->get('month'))) {
            $month = date('m');
            $year = date('Y');
            $month2 = $month - 1;
        } else {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
            $month2 = $month - 1;
        }

        
        $neraca =  $this->db->query("SELECT  tb_akun.id_akun, tb_akun.no_akun, tb_akun.nm_akun, saldo.debit_saldo, saldo.kredit_saldo, 
       tb_jurnal.debit_penyesuaian, tb_jurnal.kredit_penyesuaian,
       laba.debit_laba, laba.kredit_laba,
       neraca.debit_neraca, neraca.kredit_neraca,
       neraca_saldo.debit_neraca_saldo, neraca_saldo.kredit_neraca_saldo,
       lanjut.debit_lanjut, lanjut.kredit_lanjut,
       laba_lanjut.debit_laba_lanjut, laba_lanjut.kredit_laba_lanjut
       FROM tb_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_saldo, SUM(tb_jurnal.kredit) as kredit_saldo FROM tb_jurnal WHERE tb_jurnal.id_buku != '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) saldo ON tb_akun.id_akun = saldo.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_penyesuaian, SUM(tb_jurnal.kredit) as kredit_penyesuaian FROM tb_jurnal WHERE tb_jurnal.id_buku = '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5  GROUP BY tb_jurnal.id_akun) tb_jurnal ON tb_akun.id_akun = tb_jurnal.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_neraca, SUM(tb_jurnal.kredit) as kredit_neraca FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) neraca ON tb_akun.id_akun = neraca.id_akun
            LEFT JOIN (SELECT tb_neraca_saldo.id_akun, SUM(tb_neraca_saldo.debit_saldo) as debit_neraca_saldo, SUM(tb_neraca_saldo.kredit_saldo) as kredit_neraca_saldo FROM tb_neraca_saldo GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_lanjut, SUM(tb_jurnal.kredit) as kredit_lanjut FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca_saldo = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) = $year GROUP BY tb_jurnal.id_akun) lanjut ON tb_akun.id_akun = lanjut.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba_lanjut, SUM(tb_jurnal.kredit) as kredit_laba_lanjut FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba_lanjut ON tb_akun.id_akun = laba_lanjut.id_akun

            WHERE tb_akun.id_akun != 55 ORDER BY tb_akun.no_akun ASC
            ")->result();
        $tahun = $this->db->select('tgl')->from('tb_jurnal')->group_by('YEAR(tgl)')->get()->result();    
        $data = array(
            'title' => "Neraca Lajur",
            'neraca' => $neraca,
            'month' => $month,
            'year' => $year,
            'tahun' => $tahun
        );
        $this->load->view('lajur/content', $data);
    }

    public function print()
    {

        $month = $this->input->get('month');
        $year = $this->input->get('year');
        

        
        $neraca =  $this->db->query("SELECT tb_akun.no_akun, tb_akun.nm_akun, saldo.debit_saldo, saldo.kredit_saldo, 
       tb_jurnal.debit_penyesuaian, tb_jurnal.kredit_penyesuaian,
       laba.debit_laba, laba.kredit_laba,
       neraca.debit_neraca, neraca.kredit_neraca,
       neraca_saldo.debit_neraca_saldo, neraca_saldo.kredit_neraca_saldo,
       lanjut.debit_lanjut, lanjut.kredit_lanjut,
       laba_lanjut.debit_laba_lanjut, laba_lanjut.kredit_laba_lanjut
       FROM tb_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_saldo, SUM(tb_jurnal.kredit) as kredit_saldo FROM tb_jurnal WHERE tb_jurnal.id_buku != '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) saldo ON tb_akun.id_akun = saldo.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_penyesuaian, SUM(tb_jurnal.kredit) as kredit_penyesuaian FROM tb_jurnal WHERE tb_jurnal.id_buku = '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5  GROUP BY tb_jurnal.id_akun) tb_jurnal ON tb_akun.id_akun = tb_jurnal.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_neraca, SUM(tb_jurnal.kredit) as kredit_neraca FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) neraca ON tb_akun.id_akun = neraca.id_akun
            LEFT JOIN (SELECT tb_neraca_saldo.id_akun, SUM(tb_neraca_saldo.debit_saldo) as debit_neraca_saldo, SUM(tb_neraca_saldo.kredit_saldo) as kredit_neraca_saldo FROM tb_neraca_saldo GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_lanjut, SUM(tb_jurnal.kredit) as kredit_lanjut FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca_saldo = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) = $year GROUP BY tb_jurnal.id_akun) lanjut ON tb_akun.id_akun = lanjut.id_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba_lanjut, SUM(tb_jurnal.kredit) as kredit_laba_lanjut FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba_lanjut ON tb_akun.id_akun = laba_lanjut.id_akun

            WHERE tb_akun.id_akun != 55 ORDER BY tb_akun.no_akun ASC
            ")->result();
    
        $data = array(
            'title' => "Print Neraca Lajur",
            'neraca' => $neraca,
            'month' => $month,
            'year' => $year
        );
        $this->load->view('lajur/print',$data);
    }

    public function laporan_neraca()
    {
        if (empty($this->input->get('month'))) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
        }

        
        $neraca =  $this->db->query("SELECT tb_akun.id_akun ,tb_akun.id_kategori, tb_akun.no_akun, tb_akun.nm_akun, saldo.debit_saldo, saldo.kredit_saldo, 
       tb_jurnal.debit_penyesuaian, tb_jurnal.kredit_penyesuaian,
       laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,
       neraca.debit_neraca, neraca.kredit_neraca,
       neraca_saldo.debit_neraca_saldo, neraca_saldo.kredit_neraca_saldo,tb_akun.aktiva_t,tb_akun.aktiva_l,
       lanjut.debit_lanjut, lanjut.kredit_lanjut
       FROM tb_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_saldo, SUM(tb_jurnal.kredit) as kredit_saldo FROM tb_jurnal WHERE tb_jurnal.id_buku != '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) saldo ON tb_akun.id_akun = saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_penyesuaian, SUM(tb_jurnal.kredit) as kredit_penyesuaian FROM tb_jurnal WHERE tb_jurnal.id_buku = '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5  GROUP BY tb_jurnal.id_akun) tb_jurnal ON tb_akun.id_akun = tb_jurnal.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_neraca, SUM(tb_jurnal.kredit) as kredit_neraca FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) neraca ON tb_akun.id_akun = neraca.id_akun

            LEFT JOIN (SELECT tb_neraca_saldo.id_akun, SUM(tb_neraca_saldo.debit_saldo) as debit_neraca_saldo, SUM(tb_neraca_saldo.kredit_saldo) as kredit_neraca_saldo FROM tb_neraca_saldo GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_lanjut, SUM(tb_jurnal.kredit) as kredit_lanjut FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca_saldo = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) <= $year GROUP BY tb_jurnal.id_akun) lanjut ON tb_akun.id_akun = lanjut.id_akun

            WHERE tb_akun.id_akun != 55  AND tb_akun.neraca_saldo = 'Y' ORDER BY tb_akun.no_akun ASC
            ")->result();
        
        
        $laba =  $this->db->query("SELECT tb_akun.id_kategori, tb_akun.no_akun, tb_akun.nm_akun,
       laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,tb_akun.aktiva_t,tb_akun.aktiva_l
       FROM tb_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) <= $month AND YEAR(tb_jurnal.tgl) <= $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun

            WHERE tb_akun.id_akun != 55  ORDER BY tb_akun.no_akun ASC
            ")->result();

        $tahun = $this->db->select('tgl')->from('tb_jurnal')->group_by('YEAR(tgl)')->get()->result();    
        $data = array(
            'title' => "Laporan Neraca",
            'neraca' => $neraca,
            'neraca1' => $neraca,
            'hutang' => $neraca,
            'hutang1' => $neraca,
            'laba' => $laba,
            'penutup' => $neraca,
            'month' => $month,
            'year' => $year,
            'tahun' => $tahun
        );
        $this->load->view('lajur/laporan_neraca', $data);
    }

    public function print_neraca()
    {
        if (empty($this->input->get('month'))) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
        }

        
        $neraca =  $this->db->query("SELECT  tb_akun.no_akun, tb_akun.id_kategori, tb_akun.nm_akun, saldo.debit_saldo, saldo.kredit_saldo, 
       tb_jurnal.debit_penyesuaian, tb_jurnal.kredit_penyesuaian,
       laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,
       neraca.debit_neraca, neraca.kredit_neraca,
       neraca_saldo.debit_neraca_saldo, neraca_saldo.kredit_neraca_saldo,tb_akun.aktiva_t,tb_akun.aktiva_l,
       lanjut.debit_lanjut, lanjut.kredit_lanjut
       FROM tb_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_saldo, SUM(tb_jurnal.kredit) as kredit_saldo FROM tb_jurnal WHERE tb_jurnal.id_buku != '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) saldo ON tb_akun.id_akun = saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_penyesuaian, SUM(tb_jurnal.kredit) as kredit_penyesuaian FROM tb_jurnal WHERE tb_jurnal.id_buku = '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5  GROUP BY tb_jurnal.id_akun) tb_jurnal ON tb_akun.id_akun = tb_jurnal.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_neraca, SUM(tb_jurnal.kredit) as kredit_neraca FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) neraca ON tb_akun.id_akun = neraca.id_akun

            LEFT JOIN (SELECT tb_neraca_saldo.id_akun, SUM(tb_neraca_saldo.debit_saldo) as debit_neraca_saldo, SUM(tb_neraca_saldo.kredit_saldo) as kredit_neraca_saldo FROM tb_neraca_saldo GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_lanjut, SUM(tb_jurnal.kredit) as kredit_lanjut FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca_saldo = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) <= $year GROUP BY tb_jurnal.id_akun) lanjut ON tb_akun.id_akun = lanjut.id_akun

            WHERE tb_akun.id_akun != 55  AND tb_akun.neraca_saldo = 'Y' ORDER BY tb_akun.no_akun ASC
            ")->result();

        $laba =  $this->db->query("SELECT tb_akun.id_kategori, tb_akun.no_akun, tb_akun.nm_akun,
        laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,tb_akun.aktiva_t,tb_akun.aktiva_l
        FROM tb_akun

        LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) <= $month AND YEAR(tb_jurnal.tgl) <= $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun

            WHERE tb_akun.id_akun != 55  ORDER BY tb_akun.no_akun ASC
            ")->result();

        $data = array(
            'title' => "Laporan Neraca",
            'neraca' => $neraca,
            'neraca1' => $neraca,
            'hutang' => $neraca,
            'hutang1' => $neraca,
            'laba' => $laba,
            'month' => $month,
            'year' => $year
        );
        $this->load->view('lajur/print_neraca', $data);
    }

    public function excel_neraca()
    {
        if (empty($this->input->get('month'))) {
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
        }

        
        $neraca =  $this->db->query("SELECT  tb_akun.no_akun, tb_akun.id_kategori, tb_akun.nm_akun, saldo.debit_saldo, saldo.kredit_saldo, 
       tb_jurnal.debit_penyesuaian, tb_jurnal.kredit_penyesuaian,
       laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,
       neraca.debit_neraca, neraca.kredit_neraca,
       neraca_saldo.debit_neraca_saldo, neraca_saldo.kredit_neraca_saldo,tb_akun.aktiva_t,tb_akun.aktiva_l,
       lanjut.debit_lanjut, lanjut.kredit_lanjut
       FROM tb_akun
            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_saldo, SUM(tb_jurnal.kredit) as kredit_saldo FROM tb_jurnal WHERE tb_jurnal.id_buku != '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) saldo ON tb_akun.id_akun = saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_penyesuaian, SUM(tb_jurnal.kredit) as kredit_penyesuaian FROM tb_jurnal WHERE tb_jurnal.id_buku = '4' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5  GROUP BY tb_jurnal.id_akun) tb_jurnal ON tb_akun.id_akun = tb_jurnal.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_neraca, SUM(tb_jurnal.kredit) as kredit_neraca FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca = 'Y' AND MONTH(tb_jurnal.tgl) = $month AND YEAR(tb_jurnal.tgl) = $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) neraca ON tb_akun.id_akun = neraca.id_akun

            LEFT JOIN (SELECT tb_neraca_saldo.id_akun, SUM(tb_neraca_saldo.debit_saldo) as debit_neraca_saldo, SUM(tb_neraca_saldo.kredit_saldo) as kredit_neraca_saldo FROM tb_neraca_saldo GROUP BY tb_neraca_saldo.id_akun) neraca_saldo ON tb_akun.id_akun = neraca_saldo.id_akun

            LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_lanjut, SUM(tb_jurnal.kredit) as kredit_lanjut FROM tb_jurnal LEFT JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.neraca_saldo = 'Y' AND MONTH(tb_jurnal.tgl) < $month AND YEAR(tb_jurnal.tgl) <= $year GROUP BY tb_jurnal.id_akun) lanjut ON tb_akun.id_akun = lanjut.id_akun

            WHERE tb_akun.id_akun != 55  AND tb_akun.neraca_saldo = 'Y' ORDER BY tb_akun.no_akun ASC
            ")->result();

        $laba =  $this->db->query("SELECT tb_akun.id_kategori, tb_akun.no_akun, tb_akun.nm_akun,
        laba.debit_laba, laba.kredit_laba, tb_akun.id_akun, tb_akun.ekuitas,tb_akun.aktiva_t,tb_akun.aktiva_l
        FROM tb_akun
 
        LEFT JOIN (SELECT tb_jurnal.id_akun, SUM(tb_jurnal.debit) as debit_laba, SUM(tb_jurnal.kredit) as kredit_laba FROM tb_jurnal JOIN tb_akun ON tb_jurnal.id_akun = tb_akun.id_akun WHERE tb_akun.pl = 'Y' AND MONTH(tb_jurnal.tgl) <= $month AND YEAR(tb_jurnal.tgl) <= $year AND tb_jurnal.id_buku != 5 GROUP BY tb_jurnal.id_akun) laba ON tb_akun.id_akun = laba.id_akun
 
             WHERE tb_akun.id_akun != 55  ORDER BY tb_akun.no_akun ASC
             ")->result();

        $data = array(
            'title' => "Laporan Neraca",
            'neraca' => $neraca,
            'neraca1' => $neraca,
            'hutang' => $neraca,
            'hutang1' => $neraca,
            'laba' => $laba,
            'month' => $month,
            'year' => $year
        );
        $this->load->view('lajur/excel_neraca', $data);
    }

    public function Akumulasi()
    {
        $year = date('Y') - 1;
        $year2 = date('Y');

        $aktiva = $this->db->query("SELECT (k.tarif * 100) as persen , a.barang, a.debit_aktiva, aktiva2.akumulasi2, a.tgl, 
        sum(a.kredit_aktiva) as akumulasi , a.b_penyusutan, aktiva3.bulan
        FROM aktiva as a  
        LEFT JOIN (SELECT aktiva.nota,  sum(aktiva.kredit_aktiva) as akumulasi2 FROM aktiva where YEAR(aktiva.tgl) between YEAR(aktiva.tgl) and $year  group by aktiva.nota ) aktiva2 on aktiva2.nota = a.nota
        
        LEFT JOIN (SELECT aktiva.nota, count(aktiva.nota) as bulan FROM aktiva where YEAR(aktiva.tgl) = $year2 and aktiva.kredit_aktiva != '0' group by aktiva.nota ) aktiva3 on aktiva3.nota = a.nota
        
        LEFT JOIN tb_kelompok_aktiva as k on k.id_kelompok = a.id_kelompok
        where a.id_kelompok = 1
        group by a.nota")->result();

        $aktiva2 = $this->db->query("SELECT (k.tarif * 100) as persen , a.barang, a.debit_aktiva, aktiva2.akumulasi2, a.tgl, 
        sum(a.kredit_aktiva) as akumulasi , a.b_penyusutan, aktiva3.bulan
        FROM aktiva as a  
        LEFT JOIN (SELECT aktiva.nota, sum(aktiva.kredit_aktiva) as akumulasi2 FROM aktiva where YEAR(aktiva.tgl) = $year  group by aktiva.nota ) aktiva2 on aktiva2.nota = a.nota
        
        LEFT JOIN (SELECT aktiva.nota, count(aktiva.nota) as bulan FROM aktiva where YEAR(aktiva.tgl) = $year2 and aktiva.kredit_aktiva != '0' group by aktiva.nota ) aktiva3 on aktiva3.nota = a.nota
        
        LEFT JOIN tb_kelompok_aktiva as k on k.id_kelompok = a.id_kelompok
        where a.id_kelompok = 2
        group by a.nota")->result();

        $aktiva3 = $this->db->query("SELECT (k.tarif * 100) as persen , a.barang, a.debit_aktiva, aktiva2.akumulasi2, a.tgl, 
        sum(a.kredit_aktiva) as akumulasi , a.b_penyusutan, aktiva3.bulan
        FROM aktiva as a  
        LEFT JOIN (SELECT aktiva.nota, sum(aktiva.kredit_aktiva) as akumulasi2 FROM aktiva where YEAR(aktiva.tgl) = $year  group by aktiva.nota ) aktiva2 on aktiva2.nota = a.nota
        
        LEFT JOIN (SELECT aktiva.nota, count(aktiva.nota) as bulan FROM aktiva where YEAR(aktiva.tgl) = $year2 and aktiva.kredit_aktiva != '0' group by aktiva.nota ) aktiva3 on aktiva3.nota = a.nota
        
        LEFT JOIN tb_kelompok_aktiva as k on k.id_kelompok = a.id_kelompok
        where a.id_kelompok = 3
        group by a.nota")->result();

        $aktiva4 = $this->db->query("SELECT (k.tarif * 100) as persen , a.barang, a.debit_aktiva, aktiva2.akumulasi2, a.tgl, 
        sum(a.kredit_aktiva) as akumulasi, a.b_penyusutan, aktiva3.bulan
        FROM aktiva as a  
        LEFT JOIN (SELECT aktiva.nota, sum(aktiva.kredit_aktiva) as akumulasi2 FROM aktiva where YEAR(aktiva.tgl) = $year) aktiva2 on aktiva2.nota = a.nota
        
        LEFT JOIN (SELECT aktiva.nota, count(aktiva.nota) as bulan FROM aktiva where YEAR(aktiva.tgl) = $year2 and aktiva.kredit_aktiva != '0' group by aktiva.nota ) aktiva3 on aktiva3.nota = a.nota
        
        LEFT JOIN tb_kelompok_aktiva as k on k.id_kelompok = a.id_kelompok
        where a.id_kelompok = 4 or a.id_kelompok = 5
        group by a.nota")->result();


        $data = array(
            'title' => "Daftar Aktiva",
            'aktiva' => $aktiva,
            'aktiva2' => $aktiva2,
            'aktiva3' => $aktiva3,
            'aktiva4' => $aktiva4,
            'kelompok' => $this->db->get('tb_kelompok_aktiva')->result(),
        );
        $this->load->view('lajur/aktiva', $data);
    }



    public function detail_aktiva($nota)
    {
        $data = array(
            'title' => "Akumulasi Aktiva",
            'aktiva' => $this->M_salon->aktiva($nota),
            'kelompok' => $this->db->get('tb_kelompok_aktiva')->result(),
        );
        $this->load->view('lajur/detail_aktiva', $data);
    }
}
