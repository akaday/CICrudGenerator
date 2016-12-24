
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center> <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></center>
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="varchar">nama website <?php echo form_error('nama_website') ?></label>
                <input type="text" class="form-control" name="nama_website" id="nama_website" placeholder="nama website" value="<?php echo $nama_website; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">meta deskripsi <?php echo form_error('meta_deskripsi') ?></label>
                <input type="text" class="form-control" name="meta_deskripsi" id="meta_deskripsi" placeholder="meta deskripsi" value="<?php echo $meta_deskripsi; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">meta keyword <?php echo form_error('meta_keyword') ?></label>
                <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="meta keyword" value="<?php echo $meta_keyword; ?>" />
            </div>
<!-- 	    <div class="form-group">
                <label for="varchar">favicon <?php echo form_error('favicon') ?></label>
                <input type="text" class="form-control" name="favicon" id="favicon" placeholder="favicon" value="<?php echo $favicon; ?>" />
            </div> -->
        <div class="form-group">
                <label for="varchar">favicon <?php echo form_error('favicon') ?></label>
                <br><img id="image_baru1" src='<?php echo base_url()."images/".$favicon; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                                <br>
                <input type='file' name='favicon' onchange="readURL1(this);" >
            </div>
	    <div class="form-group">
                <label for="varchar">email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <input type="hidden" name="id_identitas" value="<?php echo $id_identitas; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/identitas') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

