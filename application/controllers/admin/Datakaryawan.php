<?php

class Datakaryawan extends CI_Controller{
    public function Index()
    {
        $data = $this->db->query("SELECT * FROM data_karyawan")->result();
        var_dump($data);

    }

}

?>