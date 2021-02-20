<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// public function __construct()
// {
// 	parent::__construct();
// 	$this->load->database();
// }

class M_salon extends CI_model {

	public function dt_app($where=""){
		return $this->db->query("Select * FROM tb_appoiment " .$where. " order by id_app DESC ")->result();
	}

	public function rkp_app($where=""){
		return $this->db->query("Select * FROM rekap_app " .$where. " order by nm_app ASC ")->result();
	}

	public function dt_denda($where=""){
		return $this->db->query("Select * FROM ctt_denda " .$where. " order by id_denda DESC ")->result();
	}

	public function get_list_penjualan($where=""){
		return $this->db->query("Select * FROM tb_pembelian LEFT JOIN tb_produk ON tb_pembelian.id_produk = tb_produk.id_produk LEFT JOIN tb_karyawan ON tb_pembelian.id_karyawan = tb_karyawan.id_kry" .$where. " order by id_pembelian DESC ")->result();
	}

	public function get_list_produk_masuk($where=""){
		return $this->db->query("Select * FROM tbl_produk_masuk JOIN tb_produk ON tbl_produk_masuk.id_produk = tb_produk.id_produk JOIN tb_kategori ON tb_produk.id_kategori = tb_kategori.id_kategori" .$where. " order by id DESC ")->result();
	}

	public function dt_kasbon($where=""){
		return $this->db->query("Select * FROM ctt_kasbon " .$where. " order by id_kasbon DESC ")->result();
	}

	public function dt_tips($where=""){
		return $this->db->query("Select * FROM ctt_tips " .$where. " order by id_tips DESC ")->result();
	}

	public function dt_kry($where=""){
		return $this->db->query("Select * FROM tb_karyawan " .$where. " order by id_kry DESC ")->result();
	}

	public function dt_user($where=""){
		return $this->db->query("Select * FROM view_user " .$where)->result();
	}

	public function dt_role($where=""){
		return $this->db->query("Select * FROM tb_role " .$where)->result();
	}
	
	public function dt_servis($where=""){
		return $this->db->query("Select * FROM tb_servis " .$where)->result();
	}
	
	public function dt_kom($where="")
	{
		$this->db->select('*');
		$this->db->from('tb_komisi' .$where);
		$data = $this->db->get();
		return $data->result();
	}
	
	public function dt_cancel($where="")
	{
		return $this->db->query("Select * FROM tb_cancel " .$where. " order by id_cancel DESC ")->result();
	}
	
	public function dt_customer($where="")
	{
		$this->db->select('*');
		$this->db->from('tb_customer' .$where);
		$this->db->order_by('id_customer', 'desc');
		$data = $this->db->get();
		return $data->result();
	}

	public function dt_cancel_sum($where="")
	{
		$this->db->select('*');
		$this->db->from('tb_cancel' .$where);
		$this->db->group_by('nama');
		$data = $this->db->get();
		return $data->result();
	}
	
	public function dt_customer_sum($where="")
	{
		$this->db->select('*');
		$this->db->from('tb_customer' .$where);
		$this->db->group_by('nama');
		$data = $this->db->get();
		return $data->result();
	}

	public function search_produk($search_keyword,$kategori)
	{
		$this->db->select('*');
		$this->db->from('tb_produk');
		// $this->db->join('tb_kategori tk', 'tp.id_kategori = tk.id_kategori','left');
		$this->db->where('id_kategori', $kategori);		
		$this->db->like('nm_produk', $search_keyword);
		// $this->db->or_like('harga', $search_keyword);
		$this->db->order_by('nm_produk', 'asc');
		$query = $this->db->get();
		// $query = $this->db->query("SELECT * FROM tb_produk  WHERE id_kategori = '$kategori' AND nm_produk LIKE '$search_keyword'");
		return $query->result();
	}
	
	// =============================================== PROSEDUR ================================================
	public function summary_app($tgl1, $tgl2){
		return $this->db->query('call sum_app("'.$tgl1.'", "'.$tgl2.'" )')->result();
	}
	
	public function summary_app1($tgl1, $tgl2)
	{
		$this->db->select('*');
		$this->db->from('tb_order to');
		$this->db->join('tb_servis ts', 'to.id_servis = ts.id_servis', 'left');
		$this->db->join('tb_terapis tt', 'to.id_terapis = tt.id_terapis', 'left');
		$this->db->join('tb_customer tc', 'to.id_customer = tc.id_customer', 'left');
		$this->db->where('to.tanggal >=', $tgl1);
		$this->db->where('to.tanggal <=', $tgl2);
		$this->db->order_by('id_order');
		$query = $this->db->get();
		return $query->result();
	}

	public function summary_app2($tgl1, $tgl2)
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian to');
		$this->db->join('tb_karyawan ts', 'to.id_karyawan = ts.id_kry', 'left');
		$this->db->join('tb_produk tt', 'to.id_produk = tt.id_produk', 'left');
		$this->db->where('to.tanggal >=', $tgl1);
		$this->db->where('to.tanggal <=', $tgl2);
		$this->db->order_by('id_pembelian');
		$query = $this->db->get();
		return $query->result();
	}

	public function summary_app3($tgl1, $tgl2){
		$this->db->select('*');
		$this->db->from('komisi');
		$this->db->join('tb_karyawan', 'komisi.id_kry = tb_karyawan.id_kry', 'left');
		$this->db->where('komisi.tgl >=', $tgl1);
		$this->db->where('komisi.tgl <=', $tgl2);
		$this->db->select_sum('komisi');
		$this->db->group_by('komisi.id_kry');
		$query = $this->db->get();
		return $query->result();
	}

	public function summary_tips($tgl1, $tgl2){
		return $this->db->query('call sum_tips("'.$tgl1.'", "'.$tgl2.'" )')->result();
	}

	public function summary_kasbon($tgl1, $tgl2){
		return $this->db->query('call sum_kasbon("'.$tgl1.'", "'.$tgl2.'" )')->result();
	}

	public function summary_denda($tgl1, $tgl2){
		return $this->db->query('call sum_denda("'.$tgl1.'", "'.$tgl2.'" )')->result();
	}
	
	public function summary_canel($nama)
	{
		$this->db->select('*');
		$this->db->from('tb_cancel');
		$this->db->where('nama', $nama);
		$query = $this->db->get();
		return $query->result();
	}
	
	// =============================================== SEARCHING ================================================

	function ambil_anak(){ 
		return $this->db->get('tb_karyawan');
	}

	function cari_anak($id){
		$query= $this->db->get_where('tb_karyawan',array('nm_kry'=>$id));
		return $query;
	}
	
	function absen($where="")
	{
		$this->db->select('*');
		$this->db->from('tb_absen' .$where);
		$this->db->order_by('id_absen', 'DESC');
		$data = $this->db->get();
		return $data->result();
	}

	function d_nama($where="")
	{
		$this->db->select('nm_kry');
		$this->db->from('tb_karyawan' .$where);
		$this->db->order_by('nm_kry', 'ASC');
		$data = $this->db->get();
		return $data->result();
	}

	// =============================================== CRUD ================================================
	
	public function update_produk($data_update)
	{
		$this->db->where('id_produk', $data_update['id_produk']);
		$this->db->update('tb_produk', $data_update);
	}
	public function update_produk_masuk($data_update)
	{
		$this->db->where('id', $data_update['id']);
		$this->db->update('tbl_produk_masuk', $data_update);
	}


	public function update_stok($data)
	{
		$this->db->where('id_produk', $data['id_produk']);
		$this->db->update('tb_produk', $data);
	}


	public function InputData($tabelName, $data)
	{
		$res = $this->db->insert($tabelName, $data);
		return $res;
	}

	public function UpdateData($tabelName, $data, $where){
		$res = $this->db->update($tabelName, $data, $where);
		return $res;
	}

	public function DropData($tabelName, $where){
		$res = $this->db->delete($tabelName, $where);
		return $res;
	}

}