
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div>
        <div class="box-header row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <form method='POST'>
                    <table>
                        <tr>
                            <td>Tanggal Mulai</td><td>:</td><td><input type='text' value='<?=$tgl_mulai?>' id='date' name='tgl_mulai'></td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td><td>:</td><td><input type='text' value='<?=$tgl_selesai?>' id='date1' name='tgl_selesai'></td> 
                        </tr>
                        <tr>
                            <td><input type='submit' value='Filter' class='btn btn-info'> </td> 
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url($folder_admin .'core/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama</th>
		    <th>tgl mulai</th>
		    <th>tgl selesai</th>
		    <th>kelamin</th>
		    <th>pass</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($core_data as $core)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $core->nama ?></td>
		    <td><?php echo tgl_indo($core->tgl_mulai) ?></td>
		    <td><?php echo tgl_indo($core->tgl_selesai) ?></td>
		    <td><?php echo $core->kelamin ?></td>
		    <td><?php echo $core->pass ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url($folder_admin.'core/read/'.$core->id_db),'<span class="fa fa-history"></span>'); 
			echo ' | '; 
			echo anchor(site_url($folder_admin.'core/update/'.$core->id_db),'<span class="fa fa-edit"></span>'); 
			echo ' | '; 
			echo anchor(site_url($folder_admin.'core/delete/'.$core->id_db),'<span class="fa fa-trash"></span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
