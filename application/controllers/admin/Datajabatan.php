<?php

class Datajabatan extends CI_Controller{
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

        public function Index(){

        $data['title'] = "Data Jabatan";
        $data['jabatan'] = $this->Gajimodel->get_data('data_jabatan')->result();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Datajabatan',$data);
        $this->load->view('template_admin/Footer');
        
        }

        public function tambah_data(){

                $data['title'] = "Tambah Data Jabatan";
                $this->load->view('template_admin/Header',$data);
                $this->load->view('template_admin/Sidebar');
                $this->load->view('admin/Tambahdatajabatan',$data);
                $this->load->view('template_admin/Footer');
                
        }

        public function tambah_data_aksi(){
                $this->_rules();

                if($this->form_validation->run() == FALSE) {
                        $this->tambah_data();
                }else{
                        $nama_jabatan    =$this->input->post('nama_jabatan');
                        $gaji_pokok      =$this->input->post('gaji_pokok');
                        $tj_transport    =$this->input->post('tj_transport');
                        $uang_makan      =$this->input->post('uang_makan');

                        $data = array(
                                'nama_jabatan' => $nama_jabatan,
                                'gaji_pokok' => $gaji_pokok,
                                'tj_transport' => $tj_transport,
                                'uang_makan' => $uang_makan,

                        );
                        $this->Gajimodel->insert_data($data,'data_jabatan');
                        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil ditambahkan! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Datajabatan');
                }

        }
        
        public function update_data($id){
                

                $where = array('id_jabatan' => $id);
                $data['jabatan'] =$this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan= '$id' ")->result();
                $data['title'] = "Update Data Jabatan";
                $this->load->view('template_admin/Header',$data);
                $this->load->view('template_admin/Sidebar');
                $this->load->view('admin/Updatedatajabatan',$data);
                $this->load->view('template_admin/Footer');
                
        }

        public function update_data_aksi(){
                $this->_rules();

                if($this->form_validation->run() == FALSE) {
                        $this->update_data();
                }else{

                        $id              =$this->input->post('id_jabatan');
                        $nama_jabatan    =$this->input->post('nama_jabatan');
                        $gaji_pokok      =$this->input->post('gaji_pokok');
                        $tj_transport    =$this->input->post('tj_transport');
                        $uang_makan      =$this->input->post('uang_makan');

                        $data = array(
                                'nama_jabatan' => $nama_jabatan,
                                'gaji_pokok' => $gaji_pokok,
                                'tj_transport' => $tj_transport,
                                'uang_makan' => $uang_makan,

                        );

                        $where = array(
                                'id_jabatan' => $id
                        );
                        $this->Gajimodel->update_data('data_jabatan',$data,$where);
                        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil diupdate! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Datajabatan');
                }

        }
        

        public function _rules(){
                $this->form_validation->set_rules('nama_jabatan','nama jabatan','required');
                $this->form_validation->set_rules('gaji_pokok','gaji pokok','required');
                $this->form_validation->set_rules('tj_transport','tunjangan transport','required');
                $this->form_validation->set_rules('uang_makan','uang makan','required');

        }

        public function delete_data($id)
        {
             $where = array ('id_jabatan' => $id);
             $this->Gajimodel->delete_data($where, 'data_jabatan');   
             $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil dihapus! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Datajabatan');
        }       



}
?>
