
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
	    <div class="form-group">
                <label for="date">tgl mulai <?php echo form_error('tgl_mulai') ?></label>
                <input type="text" class="form-control" name="tgl_mulai" id="date" placeholder="tgl mulai" value="<?php echo $tgl_mulai; ?>" />
            </div>
	    <div class="form-group">
                <label for="date">tgl selesai <?php echo form_error('tgl_selesai') ?></label>
                <input type="text" class="form-control" name="tgl_selesai" id="date1" placeholder="tgl selesai" value="<?php echo $tgl_selesai; ?>" />
            </div>
	    <div class="form-group">
            <label for="kelamin">kelamin <?php echo form_error('kelamin') ?></label><br> 
	           <input type='radio'  name='kelamin' value='pria'
                    <?php if($kelamin == "pria" OR $kelamin == ""){    echo "checked";    } ?> > pria &nbsp;&nbsp; 
	           <input type='radio'  name='kelamin' value='wanita'
                    <?php if($kelamin == "wanita" ){    echo "checked";    } ?> > wanita &nbsp;&nbsp; 
	   </div>
	    <div class="form-group">
                <label for="varchar">pass <?php echo form_error('pass') ?></label>
                <input type="password" class="form-control" name="pass" id="date" placeholder="pass" />
            </div>
	    <input type="hidden" name="id_db" value="<?php echo $id_db; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url($folder_admin.'core') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

