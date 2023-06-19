<?php


class Dataabsensi extends CI_Controller{
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
}