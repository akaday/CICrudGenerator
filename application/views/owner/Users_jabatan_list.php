
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
                <?php echo anchor(site_url('owner/users_jabatan/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama jabatan</th>
		    <!-- <th>keterangan</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($users_jabatan_data as $users_jabatan)
            {   
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $users_jabatan->nama_jabatan ?></td>
		    <!-- <td><?php echo $users_jabatan->ke ?></td> -->
		    <td style="text-align:center">
			<?php 
			// echo anchor(site_url('owner/users_jabatan/read/'.$users_jabatan->id_jabatan),'Read'); 
			// echo ' | '; 
            if($users_jabatan->nama_jabatan != "superadmin")
            {
			    echo anchor(site_url('owner/users_jabatan/update/'.$users_jabatan->id_jabatan),'<span class="fa fa-edit"></span>'); 
            }
			// echo ' | '; 
			// echo anchor(site_url('owner/users_jabatan/delete/'.$users_jabatan->id_jabatan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
