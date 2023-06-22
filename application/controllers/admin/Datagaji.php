<?php

    class Datagaji extends CI_Controller{

        public function index(){
        

            $data['title'] = "Data Gaji Karyawan";
            if((isset($_GET['bulan']) && $_GET['bulan']!='')&&(isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
                

            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;

            }
            $data['potongan'] = $this->Gajimodel->get_data('potongan_gaji')->result();

            $data['gaji'] =$this->db->query("SELECT data_karyawan.nik,data_karyawan.nama_karyawan,data_karyawan.jenis_kelamin,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha
            FROM data_karyawan
            INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
            WHERE data_kehadiran.bulan='$bulantahun'
            ORDER BY data_karyawan.nama_karyawan ASC")->result();
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Datagaji',$data);
            $this->load->view('template_admin/Footer');
        }

        public function Cetakgaji(){

            $data['title'] = "Cetak Data Gaji Karyawan";
            if((isset($_GET['bulan']) && $_GET['bulan']!='')&&(isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
                

            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;

            }
            $data['potongan'] = $this->Gajimodel->get_data('potongan_gaji')->result();

            $data['cetakgaji'] =$this->db->query("SELECT data_karyawan.nik,data_karyawan.nama_karyawan,data_karyawan.jenis_kelamin,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha
            FROM data_karyawan
            INNER JOIN data_kehadiran ON data_kehadiran.nik=data_karyawan.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
            WHERE data_kehadiran.bulan='$bulantahun'
            ORDER BY data_karyawan.nama_karyawan ASC")->result();
            $this->load->view('template_admin/Header',$data);
            
            $this->load->view('admin/Cetakdatagaji',$data);
            

        }
            
    }


?>