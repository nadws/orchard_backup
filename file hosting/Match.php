<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Match extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Makassar');
	}

    public function index(){
        $data = array(
            'title' => "Beranda", 
        );
        $this->load->view('beranda', $data);
    }

// ================================== CLEAR DATA ==========================================
    public function trash(){

        $data = array(
            'title'  => "Orchard Appointment", 
        );
        $this->load->view('bersih/form', $data);
    }

    public function trash2(){

        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');

        $app    = "Delete from tb_appoiment WHERE tgl BETWEEN '$tgl1' AND '$tgl2'";
        $res1   = $this->db->query($app);

        $denda  = "Delete from ctt_denda WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'";
        $res2   = $this->db->query($denda);

        $kasbon = "Delete from ctt_kasbon WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'";
        $res3   = $this->db->query($kasbon);

        $tips   = "Delete from ctt_tips WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'";
        $res4   = $this->db->query($tips);

        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">*Data Appoitment <br>*Data Denda <br>*Data Kasbon <br>*Data Tips <br> Berhasil Di Hapus !! <div class="ml-5 btn btn-sm"><i class="fas fa-trash fa-2x"></i></div></div>');
        redirect("Match/trash");

    }
// ================================== END CLEAR DATA ==========================================

// ================================== PRODUK ==========================================

    public function produk()
    {
        $data = array(
                'title'  => "Orchard Produk", 
                'produk'   => $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left')->get('tb_produk')->result(),
                'kategori'    => $this->db->get('tb_kategori')->result(),
            );
        $this->load->view('produk/tabel', $data);
    }
    
    public function add_produk()
    {
        $id_kategori = $this->input->post('id_kategori');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        
        $data = array(
            'id_kategori'   => $id_kategori,
            'nm_produk'     => $nama,
            'harga'         => $harga,
            'stok'          => $stok
            );
        $this->db->insert('tb_produk', $data);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Produk berhasil ditambahkan!<div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/produk");
    }
    
     public function add_kategori()
    {
        $nama = $this->input->post('nama');
        
        $data = array(
            'nm_kategori'   => $nama
            );
        $this->db->insert('tb_kategori', $data);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Kategori berhasil ditambahkan!<div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/produk");
    }
    
    public function drop_kategori($id_kategori)
    {
        $where = array('id_kategori' => $id_kategori);
        $res = $this->M_salon->DropData('tb_kategori', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Kategori berhasil dihapus!<div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/produk");
    }
    
    public function drop_produk($id_produk)
    {
        $where = array('id_produk' => $id_produk);
        $res = $this->M_salon->DropData('tb_produk', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Produk berhasil dihapus!<div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/produk");
    }
    
    public function edit_produk($id_produk)
    {
         $data = array(
                'title'  => "Orchard Edit Produk", 
                'produk'   => $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left')->get_where('tb_produk', array('id_produk' => $id_produk))->row(),
                'kategori'    => $this->db->get('tb_kategori')->result(),
            );
        $this->load->view('produk/edit', $data);
    }
    
    public function update_produk($id_produk)
    {
        $id_kategori = $this->input->post('id_kategori');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        
        $data_update = array(
            'id_produk'   => $id_produk,
            'id_kategori'   => $id_kategori,
            'nm_produk'     => $nama,
            'harga'         => $harga,
            'stok'          => $stok
            );
      
        $this->M_salon->update_produk($data_update);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Produk berhasil di ubah!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/produk");
    }

// ================================== END PRODUK ==========================================

// ================================== APPOITMENT ==========================================

    public function appoiment(){
        if (!empty($this->session->userdata('tgl1'))) {
            $dt_a   = $this->session->userdata('tgl1');
            $dt_b   = $this->session->userdata('tgl2');
            $data = array(
                'title'  => "Orchard Appointment", 
                'anak'   => $this->M_salon->ambil_anak(),
                'app'    => $this->M_salon->dt_app(" where tgl BETWEEN '$dt_a' AND '$dt_b' "),
            );
        }else{
            $dt   = date('Y-m-d');
            $data = array(
                'title'  => "Orchard Appointment", 
                'anak'   => $this->M_salon->ambil_anak(),
                'app'    => $this->M_salon->dt_app(" where tgl_input = '$dt' "),
            );
        }
        $this->load->view('appoiment/tabel', $data);
    }

    public function appoiment2(){
        $dt_a = $this->input->post('tgl1');
        $dt_b = $this->input->post('tgl2');
        $sesi = array(
            'tgl1' => $this->input->post('tgl1'), 
            'tgl2' => $this->input->post('tgl2'), 
        );
        $this->session->set_userdata($sesi);
        $data = array(
            'title'  => "Orchard Appointment", 
            'anak'   => $this->M_salon->ambil_anak(),
            'app'    => $this->M_salon->dt_app(" where tgl BETWEEN '$dt_a' AND '$dt_b' "),
        );
        $this->load->view('appoiment/tabel', $data);
    }

    function input_app(){
        $tgl    = $this->input->post('tanggal'); 
        $kd_app = $this->input->post('kd_app'); 
        $cek = $this->db->get_where(" tb_appoiment where kd_app = '$kd_app' and tgl = '$tgl' ")->row();
        if ($cek) {
            echo "Nomor <b style='color: red;'>".$kd_app."</b> Sudah digunakan ... Kembali" ; exit;
        }else{

            $data_input = array(
                'tgl'       => $this->input->post('tanggal'),
                // 'kd_app'    => $this->input->post('kd_app'),
                // 'jam'       => $this->input->post('jam'),
                // 'ket'       => strtoupper($this->input->post('ket')),
                'id_kry_2'  => $this->input->post('id_kry_2'),
                'nm_app'    => strtoupper($this->input->post('nm_app')),
                'org'       => $this->input->post('org'),
                'nominal'   => ($this->input->post('org') * 5000),
                'admin'     => $this->session->userdata('nm_user'),
                'tgl_input' => date('Y-m-d')
            );
            $res  = $this->M_salon->InputData('tb_appoiment', $data_input);
            $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
            redirect("Match/appoiment");
        }
    }

    public function edit_app($id_app){
        $a = $this->M_salon->dt_app(" where id_app ='$id_app' ");
        $data = array(
            "id_app"     => $a[0]->id_app,
            "kd_app"     => $a[0]->kd_app,
            "jam"        => $a[0]->jam,
            "id_kry_2"   => $a[0]->id_kry_2,
            "nm_app"     => $a[0]->nm_app,
            "tgl"        => $a[0]->tgl,
            "ket"        => $a[0]->ket,
            "org"        => $a[0]->org,
            "nominal"    => $a[0]->nominal,
            'title'      => "Edit Appointment", 
            'anak'       => $this->M_salon->ambil_anak()
        );
        $this->load->view('appoiment/form_edit', $data);
    }

    function update_app(){
        $id_app  = $this->input->post('id_app');
        $data_input = array(
            // 'kd_app'    => $this->input->post('kd_app'),
            // 'jam'       => $this->input->post('jam'),
            'tgl'       => $this->input->post('tgl'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_app'    => strtoupper($this->input->post('nm_app')),
            'org'       => $this->input->post('org'),
            'nominal'   => ($this->input->post('org') * 5000),
        );
        $where = array('id_app' => $id_app);
        $res  = $this->M_salon->UpdateData('tb_appoiment', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/appoiment");
    }

    function drop_app($id_app){
        $where = array('id_app' => $id_app);
        $res = $this->M_salon->DropData('tb_appoiment', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/appoiment");
    }

    public function rekap_app(){
        $dt   = date('Y-m-d');
        $dt_a = date('Y-m-25');
        $dt_b = date('Y-m-26');
        $dt_c = date('Y-m-d', strtotime($dt_a.'-1 month'));
        $data = array(
            'title'  => "Orchard Appointment", 
            'salon'  => $this->M_salon->dt_kry(),
        );
        $this->load->view('appoiment/rekap', $data);
    }

    function summary_app(){
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'app'       => $this->M_salon->summary_app($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        ); 

        $this->load->view('appoiment/summary_export', $data);
    }

    function excel_app_sum(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'app'       => $this->M_salon->summary_app($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2)),
        ); 

        $this->load->view('appoiment/excel_sum', $data);
    }

    function excel_app_det(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'app'       => $this->M_salon->dt_app(" where tgl BETWEEN '$tgl1' AND '$tgl2' "),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2)),
        ); 

        $this->load->view('appoiment/excel_det', $data);
    }

// ================================== END APPOIMENT ==========================================

// ================================== APP ==========================================

public function app()
    {

        $d_order = $this->db->get_where('tb_terapis', ['tanggal' => date('Y-m-d')])->result_array();

        $d_order_d = $this->db->join('tb_customer', 'tb_order.id_customer = tb_customer.id_customer', 'left')->join('tb_terapis', 'tb_order.id_terapis = tb_terapis.id_terapis', 'left')->join('tb_servis', 'tb_order.id_servis = tb_servis.id_servis', 'left')->get_where('tb_order', ['tb_order.tanggal' => date('Y-m-d')])->result_array();
        
        $d_order_all = $this->db->join('tb_customer', 'tb_order.id_customer = tb_customer.id_customer', 'left')->join('tb_terapis', 'tb_order.id_terapis = tb_terapis.id_terapis', 'left')->join('tb_servis', 'tb_order.id_servis = tb_servis.id_servis', 'left')->get_where('tb_order', array('tb_order.tanggal' => date('Y-m-d')))->result();
        
        $customer = $this->db->get('tb_customer')->result();
        
        $now = date('Y-m-d');
        $data = array(
            'title'  => "Appointment | Orchard Beauty", 
            'anak'   => $this->db->get('tb_karyawan')->result(),
            'terapis'   => $this->db->get_where('tb_terapis', ['tanggal' => $now])->result(),
            'servis'   => $this->db->get('tb_servis')->result(),
            'd_order' => $d_order,
            'd_order_d' => $d_order_d,
            'd_order_all' => $d_order_all,
            'customer'  => $customer
        );
        $this->load->view('app/tabel', $data);
    }



    function app_add_terapis()
    {
        $id_kry = $this->input->post('terapis');
        $now = date('Y-m-d');
        $cek = $this->db->get_where('tb_terapis', ['nama_t' => $id_kry, 'tanggal' => $now])->num_rows();
        if ($cek==1) 
        {
            $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Terapis gagal ditambahkan karena sudah terdaftar pada sistem!!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
            redirect("Match/app");
        }
        else
        {
            $data = array(
                'nama_t'    => $id_kry,
                'tanggal'   => $now,
                'tzoffset'  => $this->input->post('tzoffset')
            );
            $this->db->insert('tb_terapis', $data);
            $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Terapis berhasil ditambahkan!!  <div class="ml-5 btn btn-sm"><i class="fas fa-check-circle fa-2x"></i></div></div>');
            redirect("Match/app");
        }
    }

    function app_add_order()
    {
        if (!empty($this->input->post('id_customer'))) 
    {
        $id_customer = $this->input->post('id_customer');
    }
    else
    {
        $customer = $this->input->post('customer');
        $data = array(
            'nama'  => $customer
        );
        $this->db->insert('tb_customer', $data);
        $id_customer = $this->db->insert_id();
    }
        $id_terapis= $this->input->post('id_terapis');
        $id_servis= $this->input->post('id_servis');
        $detail_s = $this->db->get_where('tb_servis', array('id_servis' => $id_servis))->row();
        $detail_t = $this->db->get_where('tb_terapis', array('id_terapis' => $id_terapis))->row();
        $start= $this->input->post('jam_mulai');
        $start2 = date('H:i:s', strtotime($start));
        $end = date('H:i:s',strtotime('+'.$detail_s->durasi.' Hours +'.$detail_s->menit.' minutes',strtotime($start2)));
        $now = date('Y-m-d');
        $cek = $this->db->get_where("tb_order where location='$id_terapis' AND tanggal='$now' AND '$end' > start AND '$start2' < end")->num_rows();
        if ($cek > 0) 
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Appointment gagal disimpan, waktu yang Anda inputkan bertabrakan! </div>');
           redirect("match/app");
       }
       else
       {
           $ttl_jam = $detail_t->ttl_jam + $detail_s->durasi;

           $start_t = date('D M d Y ').$start2.' GMT+0800 (Central Indonesia Time)';
           $end_t = date('D M d Y ').$end.' GMT+0800 (Central Indonesia Time)';

        // Sat Dec 26 2020 10:00:00 GMT+0800 (Central Indonesia Time)

           $data_t = array(
            'ttl_jam'  => $ttl_jam
        );

           $where = array( 'id_terapis' => $id_terapis);
           $res = $this->M_salon->UpdateData('tb_terapis', $data_t, $where);

           $data = array(
            'id_terapis'    => $id_terapis,
            'id_servis'     => $id_servis,
            'id_customer'     => $id_customer,
            'location'      => $id_terapis,
            'tanggal'       => date('Y-m-d'),
            'start'         => $start,
            'start_t'         => $start_t,
            'end'           => $end,
            'end_t'           => $end_t
        );

           $this->db->insert('tb_order', $data);

           $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Data Appointment bershil disimpan! </div>');
           redirect("match/app");
       }    
   }
   
   function update_app1()
    {
    $id_order = $this->input->post('id_order');
    $start = $this->input->post('start');
    $end = $this->input->post('end');
    $start2 = date('H:i:s', strtotime($start));
    $end2 = date('H:i:s', strtotime($end));
    
     $start_t = date('D M d Y ').$start2.' GMT+0800 (Central Indonesia Time)';
     $end_t = date('D M d Y ').$end2.' GMT+0800 (Central Indonesia Time)';
    
    $data_update = array(
        'start'   => $start2,
        'start_t'   => $start_t,
        'end'   => $end2,
        'end_t'   => $end_t,

    );
    $where = array('id_order' => $id_order );
    $res = $this->M_salon->UpdateData('tb_order', $data_update, $where);
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Berhasil Di Update </div>');
    redirect("match/app");
    }
    
    function selesai_app()
    {
    $id_order = $this->input->post('id_order');
    $total = $this->input->post('total');
    
    $data_update = array(
        'status'   => 'Selesai',
        'total'   => $total,

    );
    $where = array('id_order' => $id_order );
    $res = $this->M_salon->UpdateData('tb_order', $data_update, $where);
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Berhasil Di Update </div>');
    redirect("match/app");
    }
   
   function drop_app1()
   {
    $id_order = $this->input->post('id_order');
    $costumer = $this->db->join('tb_customer', 'tb_order.id_customer = tb_customer.id_customer', 'left')->get_where('tb_order', array('id_order' => $id_order))->row();
    $ket = $this->input->post('ket');
    $now = date('Y-m-d');
     $data_insert = array(
        'tgl'   => $now,
        'nama'   => $costumer->nama,
        'telepon'   => $costumer->telepon,
        'ket'   => $ket,

    );
    $this->db->insert('tb_cancel', $data_insert);
    $where = array('id_order' => $id_order);
    $res = $this->M_salon->DropData('tb_order', $where);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Di Cancel </div>');
    redirect("match/app");
   }
    
    function summary_app1(){
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'app'       => $this->M_salon->summary_app1($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        ); 

        $this->load->view('app/summary_export', $data);
    }
    
    function app_priode()
    {
        $tgl = $this->input->get('tgl');
        
        $d_order = $this->db->get_where('tb_terapis', array('tanggal' => $tgl))->result_array();

        $d_order_d = $this->db->join('tb_customer', 'tb_order.id_customer = tb_customer.id_customer', 'left')->join('tb_terapis', 'tb_order.id_terapis = tb_terapis.id_terapis', 'left')->join('tb_servis', 'tb_order.id_servis = tb_servis.id_servis', 'left')->get_where('tb_order', array('tb_order.tanggal' => $tgl))->result_array();
        
        $d_order_all = $this->db->join('tb_customer', 'tb_order.id_customer = tb_customer.id_customer', 'left')->join('tb_terapis', 'tb_order.id_terapis = tb_terapis.id_terapis', 'left')->join('tb_servis', 'tb_order.id_servis = tb_servis.id_servis', 'left')->get_where('tb_order', array('tb_order.tanggal' => $tgl))->result();
        
        $customer = $this->db->get('tb_customer')->result();
        
        $now = date('Y-m-d');
        $data = array(
            'title'  => "Appointment | Orchard Beauty", 
            'anak'   => $this->db->get('tb_karyawan')->result(),
            'terapis'   => $this->db->get_where('tb_terapis', array('tanggal' => $tgl))->result(),
            'servis'   => $this->db->get('tb_servis')->result(),
            'd_order' => $d_order,
            'd_order_d' => $d_order_d,
            'd_order_all' => $d_order_all,
            'tgl'       => $tgl,
            'customer'  => $customer
        );
        $this->load->view('app/app_priode', $data);
    }

// ================================== END APP ==========================================

// ================================== ABSEN ==========================================

    public function absen()
    {
       $data = array(
        'title'  => "Orchard Beauty", 
        'anak'   => $this->db->get('tb_karyawan')->result(),
        'komisi'    => $this->M_salon->dt_kom()
    );
       $this->load->view('absen/tabel', $data);
   }

   public function absen2()
   {
       $dt_a = date('Y-m-31');
       $dt_b = date('Y-m-26');
       $dt_c = date('Y-m-d', strtotime($dt_b.'-1 month'));
       $data  = array(
        'title'     => "Orchard Beauty - Absen",
        'absen'     => $this->M_salon->absen(" where tgl BETWEEN '$dt_c' AND '$dt_a'"), 
        'd_nama'    => $this->M_salon->d_nama(),
        'komisi'    => $this->M_salon->dt_kom()

    );
       $this->load->view('absen/edit', $data);
   }

   public function absen3()
   {
      $dt_a = date('Y-m-31');
      $dt_b = date('Y-m-26');
      $dt_c = date('Y-m-d', strtotime($dt_b.'-1 month'));
      $data  = array(
        'title'     => "Absen ",
        'absen'     => $this->M_salon->absen(" where tgl BETWEEN '$dt_c' AND '$dt_a'"), 
        'd_nama'    => $this->M_salon->d_nama(),
        'komisi'    => $this->M_salon->dt_kom()

    );
      $this->load->view('absen/detail', $data);
  }

  function input_absen(){
    $nama = $this->input->post('nm_karyawan');
    $tgl  = $this->input->post('tgl');
    $cek = $this->db->get_where("tb_absen where nm_karyawan = '$nama' and tgl = '$tgl' ")->row();
    if (!empty($cek)) {
        echo "Data sudah ada!! Kembali....";
    }else{
        $data_input = array(
            'nm_karyawan' => $this->input->post('nm_karyawan'),
            'tgl'         => $this->input->post('tgl'),
            'ket'         => $this->input->post('ket'),
            'bulan'       => date('my'),
            'admin'       => $this->session->userdata('nm_user'),
            'tgl_input'   => date('Y-m-d')
        );
        $res = $this->M_salon->InputData('tb_absen', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Data Berhasil Di Tambah </div>');
        redirect("match/absen2");
    }
}

function input_absen3()
{       
    $nm = $this->uri->segment('3');
    $sp = $this->uri->segment('4');
    $data_input = array(
        'nm_karyawan' => $nm,
        'tgl'         => date('Y-m-d'),
        'ket'         => $sp,
        'bulan'       => date('my'),
        'admin'       => $this->session->userdata('nm_user'),
        'tgl_input'   => date('Y-m-d')
    );
        // var_dump($data_input); exit;
    $res = $this->M_salon->InputData('tb_absen', $data_input);
    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Data Berhasil Di Tambah </div>');
    redirect("match/absen");
}

function update_absen3()
{
    $id = $this->uri->segment('3');
    $sp = $this->uri->segment('4');
    $data_update = array(
        'ket'   => $sp,
        'admin' => $this->session->userdata('nm_user')

    );
    $where = array( 'id_absen' => $id );
    $res = $this->M_salon->UpdateData('tb_absen', $data_update, $where);
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Berhasil Di Update </div>');
    redirect("match/absen");
}

function update_absen(){
    $id_absen = $this->input->post('id_absen');
    $data_update = array(
        'nm_karyawan' => $this->input->post('nm_karyawan'),
        'ket'         => $this->input->post('ket'),
        'tgl'         => $this->input->post('tgl'),
        'tgl_input'   => date('Y-m-d')
    );
    $where = array( 'id_absen' => $id_absen );
    $res = $this->M_salon->UpdateData('tb_absen', $data_update, $where);
    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Berhasil Di Update </div>');
    redirect("match/absen2");
}

function drop_absen3($id_absen)
{
    $where = array('id_absen' => $id_absen);
    $res = $this->M_salon->DropData('tb_absen', $where);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Di Delete </div>');
    redirect("match/absen");
}

function drop_absen2($id_absen)
{
    $where = array('id_absen' => $id_absen);
    $res = $this->M_salon->DropData('tb_absen', $where);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Di Delete </div>');
    redirect("match/absen2");
}

// ================================== END ABSEN ==========================================

// ================================== DENDA ==========================================

    public function denda(){
        if (!empty($this->session->userdata('tgl1'))) {
            $dt_a   = $this->session->userdata('tgl1');
            $dt_b   = $this->session->userdata('tgl2');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'denda'  => $this->M_salon->dt_denda(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
            );
        }else{
            $dt   = date('Y-m-d');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'denda'  => $this->M_salon->dt_denda(" where tgl_input = '$dt' "),
            );
        }

        $this->load->view('denda/tabel', $data);
    }

    public function denda2(){
        $dt_a = $this->input->post('tgl1');
        $dt_b = $this->input->post('tgl2');
        $sesi = array(
            'tgl1' => $this->input->post('tgl1'), 
            'tgl2' => $this->input->post('tgl2'), 
        );
        $this->session->set_userdata($sesi);
        $data = array(
            'title'  => "Orchard Beauty", 
            'anak'   => $this->M_salon->ambil_anak(),
            'denda'  => $this->M_salon->dt_denda(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
        );
        $this->load->view('denda/tabel', $data);
    }

    function input_denda(){
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_denda'  => strtoupper($this->input->post('nm_denda')),
            'alasan'    => $this->input->post('alasan'),
            'nominal'   => $this->input->post('nominal'),
            'admin'     => $this->session->userdata('nm_user'),
            'tgl_input' => date('Y-m-d')
        );
        $res  = $this->M_salon->InputData('ctt_denda', $data_input);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/denda");
    }

    public function edit_denda($id_denda){
        $a = $this->M_salon->dt_denda(" where id_denda ='$id_denda' ");
        $data = array(
            "id_denda"   => $a[0]->id_denda,
            "id_kry_2"   => $a[0]->id_kry_2,
            "nm_denda"   => $a[0]->nm_denda,
            "tanggal"     => $a[0]->tanggal,
            "alasan"     => $a[0]->alasan,
            "nominal"    => $a[0]->nominal,
            'title'      => "Edit Denda", 
            'anak'       => $this->M_salon->ambil_anak()
        );
        $this->load->view('denda/form_edit', $data);
    }

    function update_denda(){
        $id_denda  = $this->input->post('id_denda');
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_denda'  => strtoupper($this->input->post('nm_denda')),
            'alasan'    => $this->input->post('alasan'),
            'nominal'   => $this->input->post('nominal')
        );
        $where = array('id_denda' => $id_denda);
        $res  = $this->M_salon->UpdateData('ctt_denda', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/denda");
    }

    function drop_denda($id_denda){
        $where = array('id_denda' => $id_denda);
        $res = $this->M_salon->DropData('ctt_denda', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/denda");
    }

    function summary_denda(){
        $tgl1 = $this->input->post('tgl3');
        $tgl2 = $this->input->post('tgl4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'denda'     => $this->M_salon->summary_denda($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('denda/summary_export', $data);
    }

    function excel_denda_sum(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'denda'     => $this->M_salon->summary_denda($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('denda/excel_sum', $data);
    }


// =============================== DENDA ==========================================

// ================================== SERVIS ==========================================

    public function dt_servis()
    {
      $data = array(
          'title'  => "Orchard Beauty", 
          'kasbon' => $this->M_salon->dt_servis(),
      );
      $this->load->view('servis/tabel', $data);
    }
    
    public function add_servis()
    {
         $data_input = array(
            'nm_servis'   => $this->input->post('servis'),
            'durasi'  => $this->input->post('jam'),
            'menit'  => $this->input->post('menit'),
        );
        $res  = $this->M_salon->InputData('tb_servis', $data_input);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/dt_servis");
    }
    
    public function edit_servis()
    {
        $id_servis  = $this->input->post('id_servis');
        $data_input = array(
            'nm_servis'   => $this->input->post('servis'),
            'durasi'  => $this->input->post('jam'),
            'menit'   => $this->input->post('menit')
        );
        $where = array('id_servis' => $id_servis);
        $res  = $this->M_salon->UpdateData('tb_servis', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/dt_servis");
    }
    
    function drop_servis($id_servis){
        $where = array('id_servis' => $id_servis);
        $res = $this->M_salon->DropData('tb_servis', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/dt_servis");
    }

// =============================== END SERVIS ==========================================


// ================================== KASBON ==========================================

    public function kasbon(){
        if (!empty($this->session->userdata('tgl1'))) {
            $dt_a   = $this->session->userdata('tgl1');
            $dt_b   = $this->session->userdata('tgl2');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'kasbon' => $this->M_salon->dt_kasbon(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
            );
        }else{
            $dt   = date('Y-m-d');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'kasbon' => $this->M_salon->dt_kasbon(" where tgl_input = '$dt' "),
            );
        }
        
        $this->load->view('kasbon/tabel', $data);
    }

    public function kasbon2(){
        $dt_a = $this->input->post('tgl1');
        $dt_b = $this->input->post('tgl2');
        $sesi = array(
            'tgl1' => $this->input->post('tgl1'), 
            'tgl2' => $this->input->post('tgl2'), 
        );
        $this->session->set_userdata($sesi);
        $data = array(
            'title'  => "Orchard Beauty", 
            'anak'   => $this->M_salon->ambil_anak(),
            'kasbon' => $this->M_salon->dt_kasbon(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
        );
        $this->load->view('kasbon/tabel', $data);
    }

    function input_kasbon(){
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_kasbon' => strtoupper($this->input->post('nm_kasbon')),
            'nominal'   => $this->input->post('nominal'),
            'admin'     => $this->session->userdata('nm_user'),
            'tgl_input' => date('Y-m-d')
        );
        $res  = $this->M_salon->InputData('ctt_kasbon', $data_input);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/kasbon");
    }

    public function edit_kasbon($id_kasbon){
        $a = $this->M_salon->dt_kasbon(" where id_kasbon ='$id_kasbon' ");
        $data = array(
            "id_kasbon"   => $a[0]->id_kasbon,
            "id_kry_2"   => $a[0]->id_kry_2,
            "nm_kasbon"   => $a[0]->nm_kasbon,
            "tanggal"     => $a[0]->tanggal,
            "nominal"    => $a[0]->nominal,
            'title'      => "Edit kasbon", 
            'anak'       => $this->M_salon->ambil_anak()
        );
        $this->load->view('kasbon/form_edit', $data);
    }

    function update_kasbon(){
        $id_kasbon  = $this->input->post('id_kasbon');
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_kasbon'  => strtoupper($this->input->post('nm_kasbon')),
            'nominal'   => $this->input->post('nominal')
        );
        $where = array('id_kasbon' => $id_kasbon);
        $res  = $this->M_salon->UpdateData('ctt_kasbon', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/kasbon");
    }

    function drop_kasbon($id_kasbon){
        $where = array('id_kasbon' => $id_kasbon);
        $res = $this->M_salon->DropData('ctt_kasbon', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/kasbon");
    }

    function detail_kasbon(){
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data['kasbon'] = $this->M_salon->detail_kasbon($tgl1, $tgl2);

        $this->load->view('kasbon/detail_export', $data);
    }

    function summary_kasbon(){
        $tgl1 = $this->input->post('tgl3');
        $tgl2 = $this->input->post('tgl4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'kasbon'    => $this->M_salon->summary_kasbon($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('kasbon/summary_export', $data);
    }

    function excel_kasbon_sum(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'kasbon'    => $this->M_salon->summary_kasbon($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('kasbon/excel_sum', $data);
    }

    function excel_kasbon_det(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'kasbon'    => $this->M_salon->dt_kasbon(" where tanggal BETWEEN '$tgl1' AND '$tgl2' "),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('kasbon/excel_det', $data);
    }

// =============================== KASBON ==========================================

// ================================== TIPS ==========================================

    public function tips(){
        if (!empty($this->session->userdata('tgl1'))) {
            $dt_a   = $this->session->userdata('tgl1');
            $dt_b   = $this->session->userdata('tgl2');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'tips'   => $this->M_salon->dt_tips(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
            );
        }else{
            $dt   = date('Y-m-d');
            $data = array(
                'title'  => "Orchard Beauty", 
                'anak'   => $this->M_salon->ambil_anak(),
                'tips'   => $this->M_salon->dt_tips(" where tgl_input = '$dt' "),
            );
        }

        $this->load->view('tips/tabel', $data);
    }

    public function tips2(){
        $dt_a = $this->input->post('tgl1');
        $dt_b = $this->input->post('tgl2');
        $sesi = array(
            'tgl1' => $this->input->post('tgl1'), 
            'tgl2' => $this->input->post('tgl2'), 
        );
        $this->session->set_userdata($sesi);
        $data = array(
            'title'  => "Orchard Beauty", 
            'anak'   => $this->M_salon->ambil_anak(),
            'tips'   => $this->M_salon->dt_tips(" where tanggal BETWEEN '$dt_a' AND '$dt_b' "),
        );
        $this->load->view('tips/tabel', $data);
    }

    function input_tips(){
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_tips'  => strtoupper($this->input->post('nm_tips')),
            'nominal'   => $this->input->post('nominal'),
            'admin'     => $this->session->userdata('nm_user'),
            'tgl_input' => date('Y-m-d')
        );
        $res  = $this->M_salon->InputData('ctt_tips', $data_input);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/tips");
    }

    public function edit_tips($id_tips){
        $a = $this->M_salon->dt_tips(" where id_tips ='$id_tips' ");
        $data = array(
            "id_tips"   => $a[0]->id_tips,
            "id_kry_2"   => $a[0]->id_kry_2,
            "nm_tips"   => $a[0]->nm_tips,
            "tanggal"     => $a[0]->tanggal,
            "nominal"    => $a[0]->nominal,
            'title'      => "Edit tips", 
            'anak'       => $this->M_salon->ambil_anak()
        );
        $this->load->view('tips/form_edit', $data);
    }

    function update_tips(){
        $id_tips  = $this->input->post('id_tips');
        $data_input = array(
            'tanggal'   => $this->input->post('tanggal'),
            'id_kry_2'  => $this->input->post('id_kry_2'),
            'nm_tips'  => strtoupper($this->input->post('nm_tips')),
            'nominal'   => $this->input->post('nominal')
        );
        $where = array('id_tips' => $id_tips);
        $res  = $this->M_salon->UpdateData('ctt_tips', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/tips");
    }

    function drop_tips($id_tips){
        $where = array('id_tips' => $id_tips);
        $res = $this->M_salon->DropData('ctt_tips', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect("Match/tips");
    }

    function summary_tips(){
        $tgl1 = $this->input->post('tgl3');
        $tgl2 = $this->input->post('tgl4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'tips'      => $this->M_salon->summary_tips($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('tips/summary_export', $data);
    }

    function excel_tips_sum(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'tips'      => $this->M_salon->summary_tips($tgl1, $tgl2),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('tips/excel_sum', $data);
    }

    function excel_tips_det(){
        $tgl1 = $this->uri->segment('3');
        $tgl2 = $this->uri->segment('4');
        $data = array(
            'tgl1'      => $tgl1,
            'tgl2'      => $tgl2,
            'tips'      => $this->M_salon->dt_tips(" where tanggal BETWEEN '$tgl1' AND '$tgl2' "),
            'sort'      => date('d-M-y', strtotime($tgl1))." ~ ".date('d-M-y', strtotime($tgl2))
        );

        $this->load->view('tips/excel_det', $data);
    }


// =============================== TIPS ==========================================

// ================================== CANCEL ==========================================

public function cancel()
{
   $data = array(
    'title'  => "Cancel | Orchard Beauty", 
    'cancel'   => $this->M_salon->dt_cancel(),
    'summary'   => $this->M_salon->dt_cancel_sum(),
);
   $this->load->view('cancel/tabel', $data);
}

function add_cancel()
{
    $data_input = array(
        'tgl'    => $this->input->post('tgl'),
        'nama'    => $this->input->post('nama'),
        'telepon'    => $this->input->post('telp'),
        'ket'    => $this->input->post('ket')
    );
    $res  = $this->M_salon->InputData('tb_cancel', $data_input);
    $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
    redirect("Match/cancel");
}

function edit_c($id_cancel)
{
     $data = array(
    'title'  => "Edit Cancel | Orchard Beauty", 
    'detail'   => $this->db->get_where('tb_cancel', array('id_cancel' => $id_cancel))->row(),
    'summary'   => $this->M_salon->dt_cancel_sum(),
);
   $this->load->view('cancel/edit', $data);
}

function edit_cancel()
{
    $data_input = array(
        'tgl'    => $this->input->post('tgl'),
        'nama'    => $this->input->post('nama'),
        'telepon'    => $this->input->post('telp'),
        'ket'    => $this->input->post('ket')
    );
    $where = array('id_cancel' => $this->input->post('id_cancel'));
    $res  = $this->M_salon->UpdateData('tb_cancel', $data_input, $where);
    $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
    redirect("Match/cancel");
}

function del_cancel($id_cancel)
{
  $app    = "Delete from tb_cancel WHERE id_cancel='$id_cancel'";
  $res1   = $this->db->query($app);
  $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
  redirect("Match/cancel");
}

function summary_cancel()
{
    $nama = $this->input->post('nama');
    $data = array(
        'nama'      => $nama,
        'data'      => $this->M_salon->summary_canel($nama)
    );

    $this->load->view('cancel/summary_cancel', $data);
}

// =============================== CANCEL ==========================================

// ================================== CUSTOMER ==========================================

public function customer()
{
   $data = array(
    'title'  => "Customer | Orchard Beauty", 
    'data'   => $this->M_salon->dt_customer(),
    'summary'   => $this->M_salon->dt_customer_sum(),
);
   $this->load->view('customer/tabel', $data);
}

function add_customer()
{
    $data_input = array(
        'nama'    => $this->input->post('nama'),
        'tanggal_lahir'    => $this->input->post('tgl_lahir'),
        'email'    => $this->input->post('email'),
        'telepon'    => $this->input->post('telp'),
        'alamat'    => $this->input->post('alamat')
    );
    $res  = $this->M_salon->InputData('tb_customer', $data_input);
    $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
    redirect("Match/customer");
}

function edit_cus($id_customer)
{
     $data = array(
    'title'  => "Edit Customer | Orchard Beauty", 
    'detail'   => $this->db->get_where('tb_customer', array('id_customer' => $id_customer))->row(),
    'summary'   => $this->M_salon->dt_customer_sum(),
);
   $this->load->view('customer/edit', $data);
}

function edit_customer()
{
     $data_input = array(
        'nama'    => $this->input->post('nama'),
        'tanggal_lahir'    => $this->input->post('tgl_lahir'),
        'email'    => $this->input->post('email'),
        'telepon'    => $this->input->post('telp'),
        'alamat'    => $this->input->post('alamat')
    );
    $where = array('id_customer' => $this->input->post('id_customer'));
    $res  = $this->M_salon->UpdateData('tb_customer', $data_input, $where);
    $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
    redirect("Match/customer");
}

function del_customer($id_customer)
{
  $app    = "Delete from tb_customer WHERE id_customer='$id_customer'";
  $res1   = $this->db->query($app);
  $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
  redirect("Match/customer");
}

function f_customer()
{
     $f = $this->input->get('abj');
     if ($f=="semua")
     {
        redirect("Match/customer");
     }
     else
     {
          $app    = "SELECT * FROM tb_customer WHERE nama LIKE '$f%'";
     $res1   = $this->db->query($app);
     $data = array(
    'title'  => "Customer | Orchard Beauty", 
    'data'   => $res1->result(),
    'summary'   => $this->M_salon->dt_customer_sum(),
);
   $this->load->view('customer/filter', $data);
     }
    
}

// =============================== CUSTOMER ==========================================

// ================================== DATA KARYAWAN ==========================================
    public function dt_anak(){
        $data = array(
            'title' => "Karyawan Laki", 
            'laki'  => $this->M_salon->dt_kry(), 
        );
        $this->load->view('anak_laki/tabel', $data);
    }

    function input_kry(){
        $data_input = array(
            'nm_kry'    => strtoupper($this->input->post('nm_kry'))
        );
        $res  = $this->M_salon->InputData('tb_karyawan', $data_input);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Input !! <div class="ml-5 btn btn-sm"><i class="fas fa-cloud-download-alt fa-2x"></i></div></div>');
        redirect("Match/dt_anak");
    }

    function update_kry(){
        $id_kry  = $this->input->post('id_kry');
        $data_input = array(
            'nm_kry'    => strtoupper($this->input->post('nm_kry'))
        );
        $where = array('id_kry' => $id_kry);
        $res  = $this->M_salon->UpdateData('tb_karyawan', $data_input, $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Update !!  <div class="ml-5 btn btn-sm"><i class="fas fa-sync-alt fa-2x"></i></div></div>');
        redirect("Match/dt_anak");
    }

    function drop_kry($id_kry){
        $where = array('id_kry' => $id_kry);
        $res = $this->M_salon->DropData('tb_karyawan', $where);
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Data Berhasil Di Hapus !!  <div class="ml-5 btn btn-sm"><i class="fas fa-times-circle fa-2x"></i></div></div>');
        redirect('Match/dt_anak');
    }
// ================================== END DATA KARYAWAN ==========================================

// ================================================  HAK AKSES ===========================================
    function input_role(){
        $data = array(
            'nm_role'     => $this->input->post('nm_role')
        );

        $res = $this->M_salon->InputData('tb_role', $data);     
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role Berhasil Di Tambah </div>');
        redirect('Match/dt_user');
    }

    function hak_edit($id_role){
        $a = $this->M_salon->dt_role(" where id_role ='$id_role'");
        $data = array(
            "edit_hapus"  => $a[0]->edit_hapus
        );
            // var_dump($data['edit_hapus']); exit;
        if ($data['edit_hapus'] == '1') {
            $sql = "UPDATE `tb_role` SET `edit_hapus` = '0' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }else{
            $sql = "UPDATE `tb_role` SET `edit_hapus` = '1' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Hak Akses Berhasil di Update !!</div>');
        redirect("Match/dt_user");
    }

    function hak_input($id_role){
        $a = $this->M_salon->dt_role(" where id_role ='$id_role'");
        $data = array(
            "input"  => $a[0]->input
        );
            // var_dump($data['input']); exit;
        if ($data['input'] == '1') {
            $sql = "UPDATE `tb_role` SET `input` = '0' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }else{
            $sql = "UPDATE `tb_role` SET `input` = '1' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Hak Akses Berhasil di Update !!</div>');
        redirect("Match/dt_user");
    }

    function hak_edit2($id_role){
        $a = $this->M_salon->dt_role(" where id_role ='$id_role'");
        $data = array(
            "i_grade"  => $a[0]->i_grade
        );
            // var_dump($data['i_grade']); exit;
        if ($data['i_grade'] == '1') {
            $sql = "UPDATE `tb_role` SET `i_grade` = '0' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }else{
            $sql = "UPDATE `tb_role` SET `i_grade` = '1' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Hak Akses Berhasil di Update !!</div>');
        redirect("Match/dt_user");
    }

    function hak_input2($id_role){
        $a = $this->M_salon->dt_role(" where id_role ='$id_role'");
        $data = array(
            "e_grade"  => $a[0]->e_grade
        );
            // var_dump($data['e_grade']); exit;
        if ($data['e_grade'] == '1') {
            $sql = "UPDATE `tb_role` SET `e_grade` = '0' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }else{
            $sql = "UPDATE `tb_role` SET `e_grade` = '1' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Hak Akses Berhasil di Update !!</div>');
        redirect("Match/dt_user");
    }

    function hak_gudang($id_role){
        $a = $this->M_salon->dt_role(" where id_role ='$id_role'");
        $data = array(
            "gudang"  => $a[0]->gudang
        );
            // var_dump($data['gudang']); exit;
        if ($data['gudang'] == '1') {
            $sql = "UPDATE `tb_role` SET `gudang` = '0' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }else{
            $sql = "UPDATE `tb_role` SET `gudang` = '1' WHERE `tb_role`.`id_role` = '$id_role'";
            $res = $this->db->query($sql);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Hak Akses Berhasil di Update !!</div>');
        redirect("Match/dt_user");
    }
    // ================================================ END HAK AKSES ===========================================

// ================================================ USER ==================================================================

    public function dt_user(){
        $data = array(
            'title' => "Data User", 
            'user'  => $this->M_salon->dt_user(" order by kd_user DESC"),
            'hak'   => $this->M_salon->dt_role()
        );
        $this->load->view('user/tb_user', $data);
    }

    function input_user(){
        $nm_user  = $_POST['nm_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_role  = $_POST['id_role'];
        $aktif    = $_POST['aktif'];

        $data_input = array(
            'nm_user'     => $nm_user,
            'username'    => $username,
            'password'    => $password,
            'id_role'     => $id_role,
            'aktif'       => $aktif,
            'tgl_masuk'   => date('Y-m-d')
        );
        // var_dump($data_input); exit;
        $res = $this->M_salon->InputData('tb_user', $data_input);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengguna Baru Berhasil Di Tambah</div>');
        redirect ('Match/dt_user');
    }

    function edit_user($kd_user){
        $a = $this->M_salon->dt_user("where kd_user ='$kd_user'");
        $data = array(
            "kd_user"   => $a[0]->kd_user,
            "nm_user"   => $a[0]->nm_user,
            "username"  => $a[0]->username,
            "password"  => $a[0]->password,
            "tgl_masuk" => $a[0]->tgl_masuk,
            "id_role"   => $a[0]->id_role,
            "nm_role"   => $a[0]->nm_role,
            "aktif"     => $a[0]->aktif,
            'title'     => "Edit User", 
            'role'      => $this->M_salon->dt_role()
        );

        $this->load->view('tema/Header', $data);
        $this->load->view('user/edit_user', $data);
        $this->load->view('tema/Footer');
    }

    function update_user(){
        $kd_user = $this->input->post('kd_user');
        $data_update = array(
            'nm_user'   => $this->input->post('nm_user'),
            'username'  => $this->input->post('username'),
            'password'  => $this->input->post('password'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'id_role'   => $this->input->post('id_role'),
            'aktif'     => $this->input->post('aktif'),
            'email'     => $this->input->post('email')
        );

        $where = array('kd_user' => $kd_user);
        $res = $this->M_salon->UpdateData('tb_user', $data_update, $where);     
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">User Berhasil Di Update </div>');
        redirect('Match/dt_user');
    }

    function drop_user($kd_user){
        $where = array('kd_user' => $kd_user);
        $res = $this->M_salon->DropData('tb_user', $where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengguna Berhasil Di Hapus !!</div>');
        redirect('Match/dt_user');
    }

// ================================================ END USER ==================================================================

// ================================================ EXTRA ==================================================================
    public function cari_anak(){
        $nm_kry = $_GET['nm_kry'];
        $cari =$this->M_salon->cari_anak($nm_kry)->result();
        echo json_encode($cari);
    }
// ================================================ END EXTRA ==================================================================
// $pernyataan = "jafar resign mau ikut cpns"
// if ("lulus") {
//         echo"resin"
// }else{
//     echo "pemikiran cina ?";
// }

}