<?php

    class gantipassword extends CI_Controller{
        public function index(){
            $data['title'] = "Ganti password";
            $this->load->view('template_karyawan/Header',$data);
            $this->load->view('template_karyawan/Sidebar');
            $this->load->view('karyawan/formgantipassword',$data);
            $this->load->view('template_admin/Footer');
            
        }


        public function gantipasswordaksi(){
            $passbaru =$this->input->post('passbaru');
            $ulangpass =$this->input->post('ulangpass');

            $this->form_validation->set_rules('passbaru','password baru','required|matches[ulangpass]');
            $this->form_validation->set_rules('ulangpass','ulangi password','required');


            if ($this->form_validation->run() != FALSE){
                $data = array('password' => md5 ($passbaru) );
                $id = array('id_karyawan' => $this->session->userdata('id_karyawan'));


                $this->Gajimodel->update_data('data_karyawan',$data,$id);
                        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Password Berhasil diubah! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('welcome');
                }else{
                    $data['title'] = "Ganti password";
                    $this->load->view('template_karyawan/Header',$data);
                    $this->load->view('template_karyawan/Sidebar');
                    $this->load->view('karyawan/formgantipassword',$data);
                    $this->load->view('template_karyawan/Footer');

            }
        }



    }
?>