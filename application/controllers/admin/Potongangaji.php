<?php

    class Potongangaji extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
    
            if($this->session->userdata('hak_akses') !='1' ){
                $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> Anda belum login </strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>');
                    redirect('welcome');
    
            }
    
        }
        public function index()
        {
            $data['title'] = "Setting Potongan Gaji";
            $data['pot_gaji'] = $this->Gajimodel->get_data('potongan_gaji')->result();
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Potongangaji',$data);
            $this->load->view('template_admin/Footer'); 
        }

        public function tambahdata()
        {
            $data['title'] = "Tambah Potongan Gaji";
            
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Formpotongangaji',$data);
            $this->load->view('template_admin/Footer'); 
        }
        public function tambahdataaksi()
        {
            $this->_rules();
            if($this->form_validation->run() == FALSE) {
                $this->tambahdata();

            }else{
                $potongan = $this->input->post('potongan');
                $jml_potongan = $this->input->post('jml_potongan');

                $data = array(
                    'potongan' => $potongan,
                    'jml_potongan' => $jml_potongan
                );
                $this->Gajimodel->insert_data($data,'potongan_gaji');
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil ditambahkan! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Potongangaji');

            } 
        }

        public function updatedata($id){
            $where  = array('id' => $id);
            $data['title'] = 'Update Potongan gaji';
            $data['pot_gaji'] = $this->db->query("SELECT * FROM potongan_gaji WHERE id='$id'")->result();
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Updatepotongangaji',$data);
            $this->load->view('template_admin/Footer');


        }

        public function updatedataaksi()
        {
            $this->_rules();
            if($this->form_validation->run()== false){
                $thhis->updatedata();
            }else{
                $id                  = $this->input->post('id');
                $potongan            = $this->input->post('potongan');
                $jml_potongan        = $this->input->post('jml_potongan');

                $data=array(
                    'potongan'      => $potongan,
                    'jml_potongan'  => $jml_potongan

                );

                $where = array (
                    'id' => $id
                );
                $this->Gajimodel->update_data('potongan_gaji',$data,$where);
                        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil diupdate! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Potongangaji');
            }
        }

        public function _rules()
        {
            $this->form_validation->set_rules('potongan','jenis potongan','required');
            $this->form_validation->set_rules('jml_potongan','Jumlah potongan','required');
        }


        public function delete_data($id)
        {
             $where = array ('id' => $id);
             $this->Gajimodel->delete_data($where, 'potongan_gaji');   
             $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil dihapus! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Potongangaji');
        }       





    }