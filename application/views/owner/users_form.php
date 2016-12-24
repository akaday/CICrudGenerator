
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post">
	    
<?php
            if($username != "")
            {   
                ?>
            <div class="form-group">
            <label for="varchar"> username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" disabled id="username" placeholder="username" 
                        value="<?php echo $username; ?>" />
            <div class="form-group">
                    <label for="varchar"> Password Lama <?php echo form_error('password') ?></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
                </div>
            <div class="form-group">
                    <label for="varchar"> Password Baru <?php echo form_error('password_baru') ?></label>
                    <input type="password" class="form-control" name="password_baru" id="password" placeholder="password baru" value="<?php echo $password_baru; ?>" />
                </div>
            <div class="form-group">
                    <label for="varchar"> Ulangi password <?php echo form_error('ulangi_password') ?></label>
                    <input type="password" class="form-control" name="ulangi_password" id="ulangi_password" placeholder="ulangi password" value="<?php echo $ulangi_password; ?>" />
                </div>
                <?php
            }
            else
            {   
                ?>
                <div class="form-group">
                    <label for="varchar"> userdata <?php echo form_error('userdata') ?></label>
                    <input type="text" class="form-control" name="userdata" id="userdata" placeholder="userdata" 
                            value="<?php echo $userdata; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar"> Password <?php echo form_error('password') ?></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
                </div>
                <?php
            }
?>

	    <div class="form-group">
                <label for="varchar"> nama lengkap <?php echo form_error('nama_lengkap') ?></label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="nama lengkap" value="<?php echo $nama_lengkap; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar"> no telp <?php echo form_error('no_telp') ?></label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="no telp" value="<?php echo $no_telp; ?>" />
            </div>
	    <div class="form-group">
            <label for="varchar"> level <?php echo form_error('level') ?></label>
            <select class="form-control" name='level'>
                <option value=''>Pilih Jabatan</option>
                <?php
                $sql = $this->db->query("SELECT * FROM users_jabatan ORDER by id_jabatan ASC")->result();

                foreach ($sql as $row) {
                    if($level == $row->id_jabatan)
                    {
                        echo "<option value='$row->id_jabatan' selected> $row->nama_jabatan </option>";                        
                    }
                    else{
                        echo "<option value='$row->id_jabatan'> $row->nama_jabatan </option>";                        
                    }
                }
                ?>
            </select>
            <!-- <input type="text" class="form-control" name="level" id="level" placeholder="level" value="<?php echo $level; ?>" /> -->
        </div>
	    <div class="form-group">
            <label for="enum"> blokir <?php echo form_error('blokir') ?></label><br>
            <input type='radio' value='N' name='blokir' <?php if($blokir == "N"){ echo "checked"; } ?> /> Tidak
            <input type='radio' value='Y' name='blokir' <?php if($blokir == "Y"){ echo "checked"; } ?> /> Ya
        </div>
	    <input type="hidden" name="username" value="<?php echo $username; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/users') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

