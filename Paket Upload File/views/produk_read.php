
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div><!-- /.box-header-->
        <div class="box-body">
            
            <table class="table">
	    <tr><td>nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>nama en</td><td><?php echo $nama_en; ?></td></tr>
	    <tr><td>deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>deskripsi en</td><td><?php echo $deskripsi_en; ?></td></tr>
        <tr><td>urutan</td><td><?php echo $urutan; ?></td></tr>
	    <tr><td>foto</td><td>
            <?php if(!empty($foto)): ?>
            <img id="image_baru1" src='<?php echo base_url()."images/gallery/".$foto; ?>'
                            style="max-height= 200px; max-width: 200px;"
                            class="img-rounded" />
            <?php else : ?>
            <img id="image_baru1" src='<?php echo base_url()."images/default.png"; ?>'
                            style="max-height= 200px; max-width: 200px;"
                            class="img-rounded" />
            <?php endif; ?>
        </td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('owner/produk') ?>" class="btn btn-default">Kembali</button></td></tr>
	</table>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

