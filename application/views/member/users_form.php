
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center> <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></center>
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar"> Username </label>
                <input type="text" disabled class="form-control" value="<?php echo $username; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">Password Lama <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">Password Baru <?php echo form_error('password_baru') ?></label>
                <input type="password" class="form-control" name="password_baru" id="password" placeholder="password_baru" value="<?php echo $password_baru; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar"> Ulangi password <?php echo form_error('ulangi_password') ?></label>
                <input type="password" class="form-control" name="ulangi_password" id="ulangi_password" placeholder="ulangi password" value="<?php echo $ulangi_password; ?>" />
            </div>
<!-- 	    <div class="form-group">
                <label for="varchar"> nama di admin <?php echo form_error('nama_lengkap') ?></label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="nama_lengkap" value="<?php echo $nama_lengkap; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">no_telp <?php echo form_error('no_telp') ?></label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="no_telp" value="<?php echo $no_telp; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">level <?php echo form_error('level') ?></label>
                <input type="text" class="form-control" name="level"  id="level" placeholder="level" value="<?php echo $level; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum">blokir <?php echo form_error('blokir') ?></label>
                <input type="text" class="form-control" name="blokir" id="blokir" placeholder="blokir" value="<?php echo $blokir; ?>" />
            </div> 
	    <div class="form-group">
                <label for="varchar">id_session <?php echo form_error('id_session') ?></label>
                <input type="text" class="form-control" name="id_session" id="id_session" placeholder="id_session" value="<?php echo $id_session; ?>" />
            </div>-->
	    <input type="hidden" name="username" value="<?php echo $username; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/users') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

