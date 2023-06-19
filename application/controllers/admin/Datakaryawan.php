<?php

class Datakaryawan extends CI_Controller{
    public function Index()
    {
        $data['title'] ="Data Karyawan";
        $data['karyawan'] = $this->Gajimodel->get_data('data_karyawan')->result();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Datakaryawan',$data);
        $this->load->view('template_admin/Footer');


    
        



    }

    public function tambahdata()
    {
        $data['title'] ="Tambah data Karyawan";
        $data['jabatan'] = $this->Gajimodel->get_data('data_jabatan')->result();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Formtambahkaryawan',$data);
        $this->load->view('template_admin/Footer');
    }

    public function tambahdataaksi()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE ){
                $this->tambahdata();
            }

            else{
                $nik              =$this->input->post('nik');
                $nama_karyawan    =$this->input->post('nama_karyawan');
                $jenis_kelamin    =$this->input->post('jenis_kelamin');
                $tanggal_masuk    =$this->input->post('tanggal_masuk');
                $jabatan          =$this->input->post('jabatan');
                $status           =$this->input->post('status');
                $photo            =$_FILES['photo']['name'];
                if($photo=''){}else{
                    $config ['upload_path']   ='./assets/photo';
                    $config ['allowed_types']  ='jpg|jpeg|png|tiff';
                    $this->load->library('upload',$config);
                    if(!$this->upload->do_upload('photo')){
                        echo "Photo Gagal Di Upload!";
                    }else{
                        $photo=$this->upload->data('file_name');
                    
                }

            }

            $data =array(   'nik'   => $nik,
                            'nama_karyawan'   => $nama_karyawan,
                            'jenis_kelamin'   => $jenis_kelamin,
                            'jabatan'   => $jabatan,
                            'tanggal_masuk'   => $tanggal_masuk,
                            'status'   => $status,
                            'photo'   => $photo,);


                            $this->Gajimodel->insert_data($data,'data_karyawan');
                            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil ditambahkan! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');

                                redirect('admin/Datakaryawan');





        }


        
    }

    public function update_data($id){
        $where  = array('id_karyawan' => $id);
        $data['title'] = 'Update Data karyawan';
        $data['jabatan'] = $this->Gajimodel->get_data('data_jabatan')->result();
        $data['karyawan'] = $this->db->query("SELECT * FROM data_karyawan WHERE id_karyawan='$id'")->result();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Formupdatekaryawan',$data);
        $this->load->view('template_admin/Footer');

    }

    public function updatedataaksi()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE ){
                $this->update_data();
            }

            else{
                $id               =$this->input->post('id_karyawan');
                $nik              =$this->input->post('nik');
                $nama_karyawan    =$this->input->post('nama_karyawan');
                $jenis_kelamin    =$this->input->post('jenis_kelamin');
                $tanggal_masuk    =$this->input->post('tanggal_masuk');
                $jabatan          =$this->input->post('jabatan');
                $status           =$this->input->post('status');
                $photo            =$_FILES['photo']['name'];
                if($photo){
                    $config ['upload_path']   ='./assets/photo';
                    $config ['allowed_types']  ='jpg|jpeg|png|tiff';
                    $this->load->library('upload',$config);
                    if($this->upload->do_upload('photo')){
                        $photo=$this->upload->data('file_name');
                        $this->db->set('photo',$photo);
                    }else{
                        echo $this->upload-display_errors();
                    
                }

            }

            $data = array(  'nik'   => $nik,
                            'nama_karyawan'   => $nama_karyawan,
                            'jenis_kelamin'   => $jenis_kelamin,
                            'jabatan'         => $jabatan,
                            'tanggal_masuk'   => $tanggal_masuk,
                            'status'          => $status,
                            );
                            $where= array('id_karyawan' =>$id);


                            $this->Gajimodel->update_data('data_karyawan',$data,$where);
                            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil diupdate! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');

                                redirect('admin/Datakaryawan');





        }

    }











    public function _rules(){
        $this->form_validation->set_rules('nik','nik','required');
        $this->form_validation->set_rules('nama_karyawan','nama karyawan','required');
        $this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
        $this->form_validation->set_rules('tanggal_masuk','tanggal masuk','required');
        $this->form_validation->set_rules('jabatan','jabatan','required');
        $this->form_validation->set_rules('status','statuss','required');

    }

    public function delete_data($id)
        {
             $where = array ('id_karyawan' => $id);
             $this->Gajimodel->delete_data($where, 'data_karyawan');   
             $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil dihapus! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Datakaryawan');
        }       

}

?>