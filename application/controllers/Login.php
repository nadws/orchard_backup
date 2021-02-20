<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		
		$this->form_validation->set_rules('username','username','required|trim', ['required' => 'Username tidak boleh kosong!']);
		$this->form_validation->set_rules('password','password','required|trim', ['required' => 'Password tidak boleh kosong!']);

		if ($this->form_validation->run() == false) {			
			$data['title'] = "Agrika Login";

			$this->load->view('tema/Header2', $data);
			$this->load->view('login/login', $data);
			$this->load->view('tema/Footer2');

		}else {  
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// password_verify($password, $oper['password'])

			$oper = $this->db->get_where('view_user', ['username' => $username])->row_array();
			if($oper){
				if($oper['aktif'] == 1){
					if(password_verify($password, $oper['password'])){
						$data = [
							'nm_user' 	 => $oper['nm_user'],
							'username' 	 => $oper['username'],
							'password' 	 => $oper['password'],
							'edit_hapus' => $oper['edit_hapus'],
							'input' 	 => $oper['input'],
							'i_grade' 	 => $oper['i_grade'],
							'e_grade' 	 => $oper['e_grade'],
							'gudang' 	 => $oper['gudang'],
							'id_role'    => $oper['id_role'],
							'salon'      => 'salon'
						];
						switch ($oper['id_role']) {

							case '1':
							$this->session->set_userdata($data);
							redirect('Match');
							break;

							case '2':
							$this->session->set_userdata($data);
							redirect('Match');
							break;

							case '3':
							$this->session->set_userdata($data);
							redirect('Match');
							break;

							case '4':
							$this->session->set_userdata($data);
							redirect('Match');
							break;

							case '5':
							$this->session->set_userdata($data);
							redirect('Match');
							break;

							default:
							redirect('Login');
							break;

						}
					}else{
						echo "<script> alert('Password Salah!');
						window.location='".base_url('Login')."';
						</script>";
					}
				}else{
					echo "<script> alert('Anda Belum aktif!');
					window.location='".base_url('Login')."';
					</script>";
				}
			}else{
				echo "<script> alert('Anda Belum Terdaftar!');
				window.location='".base_url('Login/regis')."';
				</script>";      
			}	
		}
	}



	function regis(){
		$this->form_validation->set_rules('nm_user','nm_user','required|trim', ['required' => 'Nama tidak boleh kosong!']);
		$this->form_validation->set_rules('username','username','required|trim', ['required' => 'Username tidak boleh kosong!']);
		$this->form_validation->set_rules('password','password','required|trim|min_length[5]',
			[
				'required' => 'Password tidak boleh kosong!',
				'min_length' => 'Password Kurang Panjang'
			]);
	
		if ($this->form_validation->run() == false) {			
			$data['title'] = "Agrika Login";

			$this->load->view('tema/Header2', $data);
			$this->load->view('login/regis');
			$this->load->view('tema/Footer2');

		}else {  
			$this->input_regis();
		}	
	}

	function input_regis(){
		$data_input = [
			'nm_user' 	=> $this->input->post('nm_user'),
			'username' 	=> $this->input->post('username'),
			'password' 	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'tgl_masuk' => date('Y-m-d'),
			'aktif' 	=> '0',
			'warna' 	=> '#BCF9BC',
			'id_role' 	=> '2'
		];

		$res = $this->M_salon->InputData('tb_user', $data_input);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Di Tambah</div>');
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">User Berhasil Di Tambah !! <div class="ml-5 btn btn-sm"></div></div>');
		redirect ('Login');
	}

	function logout(){
		unset(
			$_SESSION['nm_user'],
			$_SESSION['username'],
			$_SESSION['password'],
			$_SESSION['beda'],
			$_SESSION['id_role']
		);  
        $this->session->set_flashdata('message', '<div style="background-color: #FFA07A;" class="alert" role="alert">Logout Sukses !! <div class="ml-5 btn btn-sm"><i class="fas fa-exclamation-triangle fa-2x"></i></div></div>');
		redirect('Login');
	}



}