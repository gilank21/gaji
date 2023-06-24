<?php


class Dataabsensi extends CI_Controller{
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
    
        
    public function Index()
    {
        $data['title'] ="Data Absensi karyawan";

        
        if((isset($_GET['bulan']) && $_GET['bulan']!='')&&(isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
            

        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;

        }

    
        $data['absensi'] = $this->db->query("SELECT data_kehadiran. *, data_karyawan.nama_karyawan, data_karyawan.jenis_kelamin, data_karyawan.jabatan FROM data_kehadiran 
        INNER JOIN data_karyawan ON data_kehadiran.nik=data_karyawan.nik
        INNER JOIN data_jabatan ON data_karyawan.jabatan =data_jabatan.nama_jabatan
        WHERE data_kehadiran.bulan= '$bulantahun' 
        ORDER BY data_karyawan.nama_karyawan ASC ")->result();
        





        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Dataabsensi',$data);
        $this->load->view('template_admin/Footer');


    
        



    }

    public function Inputabsensi(){


        if($this->input->POST('submit', TRUE ) == 'submit') {
            $post =$this->input->post();

            foreach($post['bulan'] as $key => $value) {
                if($post['bulan']['$key'] !='' || $post['nik'][$key] !='')
                {
                    $simpan []= array(
                        'bulan'             => $post['bulan'][$key],
                        'nik'               => $post['nik'][$key],
                        'nama_karyawan'     => $post['nama_karyawan'][$key],
                        'jenis_kelamin'     => $post['jenis_kelamin'][$key],
                        'nama_jabatan'      => $post['nama_jabatan'][$key],
                        'hadir'             => $post['hadir'][$key],
                        'sakit'             => $post['sakit'][$key],
                        'alpha'             => $post['alpha'][$key],
                    );
                }
            }

            $this->Gajimodel->insert_batch('data_kehadiran',$simpan);
                        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> Data Berhasil ditambahkan! </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>');
                                redirect('admin/Dataabsensi');

        }


        $data['title'] ="Form Input Absensi";
        if((isset($_GET['bulan']) && $_GET['bulan']!='')&&(isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
            

        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;

        }
        $data['input_absensi']= $this->db->query("SELECT data_karyawan.*, data_jabatan.nama_jabatan FROM data_karyawan
        INNER JOIN data_jabatan ON data_karyawan.jabatan=data_jabatan.nama_jabatan
        WHERE NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' AND data_karyawan.nik=data_kehadiran.nik) ORDER BY data_karyawan.nama_karyawan ASC ")->result();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Forminputabsensi',$data);
        $this->load->view('template_admin/Footer');

    }
}


?>