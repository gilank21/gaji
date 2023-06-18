<?php

class Dashboard extends CI_Controller{
    public function index()
    {
        $data['title'] = "Dashboard";
        $karyawan = $this->db->query("SELECT * FROM data_karyawan");
        $admin = $this->db->query("SELECT * FROM data_karyawan WHERE jabatan ='admin'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['karyawan']=$karyawan->num_rows();
        $data['admin']=$admin->num_rows();
        $data['jabatan']=$jabatan->num_rows();
        $data['kehadiran']=$kehadiran->num_rows();
        $this->load->view('template_admin/Header',$data);
        $this->load->view('template_admin/Sidebar');
        $this->load->view('admin/Dashboard',$data);
        $this->load->view('template_admin/Footer');
    }
}

?>