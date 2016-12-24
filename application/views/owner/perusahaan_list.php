
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
                <?php echo anchor(site_url('owner/perusahaan/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama_perusahaan</th>
		    <th>motto</th>
		    <th>alamat</th>
		    <th>phone</th>
		    <th>fax</th>
		    <th>email</th>
		    <!-- <th>logo</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($perusahaan_data as $perusahaan)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $perusahaan->nama_perusahaan ?></td>
		    <td><?php echo $perusahaan->motto ?></td>
		    <td><?php echo $perusahaan->alamat ?></td>
		    <td><?php echo $perusahaan->phone ?></td>
		    <td><?php echo $perusahaan->fax ?></td>
		    <td><?php echo $perusahaan->email ?></td>
		    <!-- <td><?php echo $perusahaan->logo ?></td> -->
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('owner/perusahaan/read/'.$perusahaan->id_perusahaan),'Read'); 
			echo ' | '; 
			echo anchor(site_url('owner/perusahaan/update/'.$perusahaan->id_perusahaan),'Update'); 
			echo ' | '; 
			echo anchor(site_url('owner/perusahaan/delete/'.$perusahaan->id_perusahaan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
