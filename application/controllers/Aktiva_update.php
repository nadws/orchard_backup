<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktiva_update extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $db = $this->db->get_where('aktiva', ['kredit_aktiva' => '0'])->result();

        foreach ($db as $d) {
            $data = [
                'kredit_aktiva' => $d->b_penyusutan,
                'nota' => $d->nota,
                'tgl' => date('Y-m-d')
            ];
            // var_dump($data)
            $this->db->insert('aktiva', $data);
        }
    }
}
