
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
        </div>
        <div class='form'>

<form action="" method="post">
        <label for="int">Menu : </label>
        <select name="filter">
            <option value='menu_utama' <?php if($filter == "menu_utama"){ echo "selected"; } ?>>Menu Utama</option>
            <option value='menu_sub' <?php if($filter == "menu_sub"){ echo "selected"; } ?>>Menu Sub</option>
        </select>
    <button type="submit" class="btn btn-primary">Pilih</button>
</form>

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
                <?php echo anchor(site_url('owner/module/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <!-- <th>No</th> -->
		    <th>urutan</th>
            <th>nama menu</th>
            <?php if($filter == "menu_sub"){ echo "<th>induk</th>"; }else{ echo "<th>icon</th>"; } ?>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($sistem_module_data as $sistem_module)
            {
                $sql0 = $this->module_model->get_by_id($sistem_module->parrent);
                if($sql0)
                { $parrent = $sql0->nama_menu; }
                else
                { $parrent = "Menu Induk"; }
                ?>
                <tr>
		    <!-- <td><?php echo ++$start ?></td> -->
            <td><?php echo $sistem_module->urutan ?></td>
            <td><?php echo $sistem_module->nama_menu ?></td>
            <?php if($filter == "menu_sub"){ ?><td><?php echo $parrent ?></td><?php }else{ ?> <td><?php echo $sistem_module->icon ?></td> <?php } ?>		    
            
		    <td style="text-align:center">
			<?php 
			// echo anchor(site_url('owner/sistem_module/read/'.$sistem_module->id_main),'Read'); 
			// echo ' | '; 
			echo anchor(site_url('owner/module/update/'.$sistem_module->id_main),'Update'); 
			echo ' | '; 
			echo anchor(site_url('owner/module/delete/'.$sistem_module->id_main),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
