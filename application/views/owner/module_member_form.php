
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">nama_menu <?php echo form_error('nama_menu') ?></label>
                <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="nama_menu" value="<?php echo $nama_menu; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">link <?php echo form_error('link') ?></label>
                <input type="text" class="form-control" name="link" id="link" placeholder="link" value="<?php echo $link; ?>" />
            </div>
	    <div class="form-group">
                <label for="jabatan">jabatan <?php echo form_error('jabatan') ?></label>
                <textarea class="form-control" rows="3" id="loko" name="jabatan" placeholder="jabatan"><?php echo $jabatan; ?></textarea>
            </div>
	    <div class="form-group">
                <label for="varchar">parrent <?php echo form_error('parrent') ?></label>
                <input type="text" class="form-control" name="parrent" id="parrent" placeholder="parrent" value="<?php echo $parrent; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">urutan <?php echo form_error('urutan') ?></label>
                <input type="text" class="form-control" name="urutan" id="urutan" placeholder="urutan" value="<?php echo $urutan; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">icon <?php echo form_error('icon') ?></label>
                <input type="text" class="form-control" name="icon" id="icon" placeholder="icon" value="<?php echo $icon; ?>" />
            </div>
	    <input type="hidden" name="id_main" value="<?php echo $id_main; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url($folder_admin.'module_member') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

