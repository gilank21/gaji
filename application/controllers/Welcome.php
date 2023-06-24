<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{	


		$this->_rules();
		if ($this->form_validation->run()==false){


			$data['title'] ="form login";
			$this->load->view('template_admin/Header',$data);
			$this->load->view('formlogin');


		}else{
			$username =$this->input->post('username');
			$password =$this->input->post('password');

			$cek = $this->Gajimodel->cek_login($username, $password);

			if($cek == FALSE){

				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong> Username atau password salah! </strong> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('welcome');
			}else{
				$this->session->set_userdata('hak_akses',$cek->hak_akses);
				$this->session->set_userdata('nama_karyawan',$cek->nama_karyawan);
				$this->session->set_userdata('photo',$cek->photo);
				$this->session->set_userdata('id_karyawan',$cek->id_karyawan);
				switch($cek->hak_akses){

					case 1 : redirect('admin/Dashboard');
							break;
					case 2 : redirect('karyawan/dashboard');
							break;

					default: break;

				}
			}
			
			
		}

		
		
	}


	public function _rules()
	{
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
