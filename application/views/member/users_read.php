
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div><!-- /.box-header-->
        <div class="box-body">
            
            <table class="table">
	    <tr><td>password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>nama_lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
	    <tr><td>email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>no_telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>level</td><td><?php echo $level; ?></td></tr>
	    <tr><td>blokir</td><td><?php echo $blokir; ?></td></tr>
	    <tr><td>id_session</td><td><?php echo $id_session; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('owner/users') ?>" class="btn btn-default">Kembali</button></td></tr>
	</table>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

