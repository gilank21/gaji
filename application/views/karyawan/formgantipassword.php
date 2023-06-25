
<div class="container-fluid">


<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

</div>


    <div class="card" style="width: 50%;">
        <div class="card-body">
            <form method="post" action="<?php echo base_url('karyawan/Gantipassword/gantipasswordaksi')?>">
            <div class="form-group">
                <label>Password baru</label>
                <input type="password " name="passbaru" class="form-control">
                <?php echo form_error(
                    'passbaru','<div class="text-small text-danger"></div>') 
                    
                ?>


            </div>
            
            <div class="form-group">
                <label>Ulangi password  baru</label>
                <input type="password " name="ulangpass" class="form-control">
                <?php echo form_error(
                    'ulangpass','<div class="text-small text-danger"></div>') 
                    
                ?>


            </div>
            <button type="submit" class="btn btn-success">Simpan</button>

            </form>

        </div>

    </div>







</div>
                          
