<?php
    class Slipgaji extends CI_Controller{
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
            $data['title']= "slip gaji karyawan";
            $data['karyawan']= $this->Gajimodel->get_data('data_karyawan')->result();
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Filterslipgaji',$data);
            $this->load->view('template_admin/Footer');
        }


        public function Cetakslipgaji(){
            $data['title'] = "Cetak slip gaji";
            $data['potongan']= $this->Gajimodel->get_data('potongan_gaji')->result();
            $nama =$this->input->post('nama_karyawan');
            $bulan =$this->input->post('bulan');
            $tahun =$this->input->post('tahun');
            $bulantahun=$bulan.$tahun;
            $data['print_slip'] = $this->db->query("SELECT data_karyawan.nik,data_karyawan.nama_karyawan,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.bulan
            FROM data_karyawan 
            INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
            WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_karyawan='$nama'")->result();
            
            
            $this->load->view('template_admin/Header',$data);
            $this->load->view('admin/Cetakslipgaji',$data);
            
        }


    }

?>