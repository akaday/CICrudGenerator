
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div>
        <div class="box-header row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('owner/identitas/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama_website</th>
		    <th>meta_deskripsi</th>
		    <th>meta_keyword</th>
		    <th>favicon</th>
		    <th>email</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($identitas_data as $identitas)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $identitas->nama_website ?></td>
		    <td><?php echo $identitas->meta_deskripsi ?></td>
		    <td><?php echo $identitas->meta_keyword ?></td>
		    <td><?php echo $identitas->favicon ?></td>
		    <td><?php echo $identitas->email ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('owner/identitas/read/'.$identitas->id_identitas),'Read'); 
			echo ' | '; 
			echo anchor(site_url('owner/identitas/update/'.$identitas->id_identitas),'Update'); 
			echo ' | '; 
			echo anchor(site_url('owner/identitas/delete/'.$identitas->id_identitas),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->
