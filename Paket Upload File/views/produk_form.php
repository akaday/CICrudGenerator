
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="varchar">nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">nama en <?php echo form_error('nama_en') ?></label>
                <input type="text" class="form-control" name="nama_en" id="nama_en" placeholder="nama en" value="<?php echo $nama_en; ?>" />
            </div>
	    <div class="form-group">
                <label for="deskripsi">deskripsi <?php echo form_error('deskripsi') ?></label>
                <textarea class="form-control" rows="3" id="loko" name="deskripsi" placeholder="deskripsi"><?php echo $deskripsi; ?></textarea>
            </div>
	    <div class="form-group">
                <label for="deskripsi_en">deskripsi en <?php echo form_error('deskripsi_en') ?></label>
                <textarea class="form-control" rows="3" id="loko2" name="deskripsi_en" placeholder="deskripsi en"><?php echo $deskripsi_en; ?></textarea>
            </div>
         <div class="form-group">
                <label for="varchar">urutan <?php echo form_error('urutan') ?></label>
                <input type="text" class="form-control" name="urutan" id="urutan" placeholder="urutan" value="<?php echo $urutan; ?>" />
            </div>
	    <!-- <div class="form-group">
                <label for="varchar">foto <?php echo form_error('foto') ?></label>
                <input type="text" class="form-control" name="foto" id="foto" placeholder="foto" value="<?php echo $foto; ?>" />
            </div> -->
        <div class="form-group">
                <label for="varchar">foto <?php echo form_error('foto') ?></label>
                <br>
                <?php if(!empty($foto)): ?>
                <img id="image_baru1" src='<?php echo base_url()."images/gallery/".$foto; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                <?php else : ?>
                <img id="image_baru1" src='<?php echo base_url()."images/default.png"; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                <?php endif; ?>
                <br>
                <input type='file' name='foto' onchange="readURL1(this);" >
            </div>
	    <input type="hidden" name="id_db" value="<?php echo $id_db; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/produk') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

