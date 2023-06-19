
<div class="container-fluid">


<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

</div>

    <?php echo $this->session->flashdata('pesan') ?>
    <a class= "mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/Datakaryawan/tambahdata') ?>"><i class="fas fa-plus"></i>Tambah Pegawai</a>

    
    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nik</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Jabatan</th>
            <th class="text-center">Tanggal Masuk</th>
            <th class="text-center">Status</th>
            <th class="text-center">Photo</th>
            <th class="text-center">Action</th>
        </tr>

        <?php $no=1; foreach($karyawan as $k) : ?>
            <tr>
                <td>
                    <?php echo $no++ ?>
                </td>
                <td>
                    <?php echo $k->nik ?>
                </td>
                <td>
                    <?php echo $k->nama_karyawan ?>
                </td>
                <td>
                    <?php echo $k->jenis_kelamin ?>
                </td>
                <td>
                    <?php echo $k->jabatan ?>
                </td>
                <td>
                    <?php echo $k->tanggal_masuk ?>
                </td>
                <td>
                    <?php echo $k->status ?>
                </td>
                <td>
                    <img src="<?php echo base_url().'assets/photo/'.$k->photo ?>" width="75px">
                </td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/Datakaryawan/update_data/'.$k->id_karyawan) ?>"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('yakin ingin menghapus')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/Datakaryawan/delete_data/'. $k->id_karyawan )?>"><i class="fas fa-trash"></i></a>
                    </center>
                </td>
            </tr>

        <?php endforeach; ?>


    </table>


</div>
                          
