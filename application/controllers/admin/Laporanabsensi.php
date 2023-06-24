<?php
    class Laporanabsensi extends CI_Controller {
        public function index(){
            $data['title'] ="Laporan Absensi";
            $this->load->view('template_admin/Header',$data);
            $this->load->view('template_admin/Sidebar');
            $this->load->view('admin/Filterlaporanabsensi',);
            $this->load->view('template_admin/Footer');
        }
        public function Cetaklaporanabsensi(){
            $data['title'] = "Cetak Laporan Absensi";
            if((isset($_GET['bulan']) && $_GET['bulan']!='')&&(isset($_GET['tahun']) && $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
                

            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;

            }
            $bulantahun=$bulan.$tahun;
            $data['lap_kehadiran'] =$this->db->query("SELECT * FROM data_kehadiran
            WHERE bulan='$bulantahun'
            ORDER BY nama_karyawan ASC ")->result();

            $this->load->view('template_admin/Header',$data);
            $this->load->view('admin/Cetaklaporanabsensi',);
           
        }
    }



?>