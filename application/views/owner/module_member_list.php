
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
                <?php echo anchor(site_url($folder_admin .'module_member/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama_menu</th>
		    <th>link</th>
		    <th>jabatan</th>
		    <th>parrent</th>
		    <th>urutan</th>
		    <th>icon</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($module_member_data as $module_member)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $module_member->nama_menu ?></td>
		    <td><?php echo $module_member->link ?></td>
		    <td><?php echo $module_member->jabatan ?></td>
		    <td><?php echo $module_member->parrent ?></td>
		    <td><?php echo $module_member->urutan ?></td>
		    <td><?php echo $module_member->icon ?></td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url($folder_admin.'module_member/read/'.$module_member->id_main),'<span class="fa fa-history"></span>'); 
			echo ' | '; 
			echo anchor(site_url($folder_admin.'module_member/update/'.$module_member->id_main),'<span class="fa fa-edit"></span>'); 
			echo ' | '; 
			echo anchor(site_url($folder_admin.'module_member/delete/'.$module_member->id_main),'<span class="fa fa-trash"></span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
