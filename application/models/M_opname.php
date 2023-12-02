<?php
defined('BASEPATH') or exit('No direct script access allowed');

// public function __construct()
// {
// 	parent::__construct();
// 	$this->load->database();
// }

class M_opname extends CI_model
{
    public function daftar_opname($where = "")
    {
        return $this->db->query("Select * FROM tb_opname " . $where . " GROUP BY kode_opname ")->result();
    }
    public function get_opname()
    {
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_produk.id_satuan = tb_satuan.id_satuan', 'left');
        // $this->db->where('tb_produk.monitoring ', 'Y');
        // $this->db->or_like('harga', $search_keyword);
        $this->db->order_by('nm_produk', 'asc');
        $query = $this->db->get();
        // $query = $this->db->query("SELECT * FROM tb_produk  WHERE id_kategori = '$kategori' AND nm_produk LIKE '$search_keyword'");
        return $query->result();
    }
    function cari_anak($id)
    {
        $query = $this->db->get_where('tb_karyawan', array('nm_kry' => $id));
        return $query;
    }
    public function InputData($tabelName, $data)
    {
        $res = $this->db->insert($tabelName, $data);
        return $res;
    }
}
