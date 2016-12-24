
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
                <?php echo anchor(site_url('owner/users/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>password</th>
		    <th>nama_lengkap</th>
		    <th>email</th>
		    <th>no_telp</th>
		    <th>level</th>
		    <th>blokir</th>
		    <th>id_session</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($users_data as $users)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $users->password ?></td>
		    <td><?php echo $users->nama_lengkap ?></td>
		    <td><?php echo $users->email ?></td>
		    <td><?php echo $users->no_telp ?></td>
		    <td><?php echo $users->level ?></td>
		    <td><?php echo $users->blokir ?></td>
		    <td><?php echo $users->id_session ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('owner/users/read/'.$users->username),'Read'); 
			echo ' | '; 
			echo anchor(site_url('owner/users/update/'.$users->username),'Update'); 
			echo ' | '; 
			echo anchor(site_url('owner/users/delete/'.$users->username),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
