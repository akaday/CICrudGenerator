
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <div class='msg text-center'>
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="varchar">nama perusahaan <?php echo form_error('nama_perusahaan') ?></label>
                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="nama perusahaan" value="<?php echo $nama_perusahaan; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">motto <?php echo form_error('motto') ?></label>
                <input type="text" class="form-control" name="motto" id="motto" placeholder="motto" value="<?php echo $motto; ?>" />
            </div>
        <!-- <div class="form-group">
                <label for="varchar">home text <?php echo form_error('home_text') ?></label>
                <input type="text" class="form-control" name="home_text" id="home_text" placeholder="home text" value="<?php echo $home_text; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">home text en <?php echo form_error('home_text_en') ?></label>
                <input type="text" class="form-control" name="home_text_en" id="home_text_en" placeholder="home text en" value="<?php echo $home_text_en; ?>" />
            </div> -->
	    <div class="form-group">
                <label for="alamat">alamat <?php echo form_error('alamat') ?></label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" value="<?php echo $alamat; ?>" />
            </div>
        <div class="form-group">
                <label for="alamat">alamat 2 <?php echo form_error('alamat2') ?></label>
                <input type="text" class="form-control" name="alamat2" id="alamat2" placeholder="alamat2" value="<?php echo $alamat2; ?>" />
                        </div>
        <div class="form-group">
                <label for="alamat">alamat 3 <?php echo form_error('alamat') ?></label>
                <input type="text" class="form-control" name="alamat3" id="alamat3" placeholder="alamat3" value="<?php echo $alamat3; ?>" />
                        </div>
	    <div class="form-group">
                <label for="varchar">phone <?php echo form_error('phone') ?></label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="<?php echo $phone; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">fax <?php echo form_error('fax') ?></label>
                <input type="text" class="form-control" name="fax" id="fax" placeholder="fax" value="<?php echo $fax; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <!-- <div class="form-group">
                <label for="varchar">logo <?php echo form_error('logo') ?></label>
                <br><img id="image_baru1" src='<?php echo base_url()."images/".$logo; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                                <br>
                <input type='file' name='logo' onchange="readURL1(this);" >
                 <input type="text" class="form-control" name="fupload1" id="logo" placeholder="logo" value="<?php echo $logo; ?>" /> 
            </div>-->
	    <input type="hidden" name="id_perusahaan" value="<?php echo $id_perusahaan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/perusahaan') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

