
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div><!-- /.box-header-->
        <div class="box-body">
            
            <table class="table">
	    <tr><td>nama_perusahaan</td><td><?php echo $nama_perusahaan; ?></td></tr>
	    <tr><td>motto</td><td><?php echo $motto; ?></td></tr>
	    <tr><td>alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>phone</td><td><?php echo $phone; ?></td></tr>
	    <tr><td>fax</td><td><?php echo $fax; ?></td></tr>
	    <tr><td>email</td><td><?php echo $email; ?></td></tr>
	    <!-- <tr><td>logo</td><td><?php echo $logo; ?></td></tr> -->
	    <tr><td></td><td><a href="<?php echo site_url('owner/perusahaan') ?>" class="btn btn-default">Kembali</button></td></tr>
	</table>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

