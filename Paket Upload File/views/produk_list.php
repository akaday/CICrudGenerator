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
                <?php echo anchor(site_url('owner/produk/create'), 'Create', 'class="btn btn-primary"'); ?>
	    </div>
        </div><!-- /.box-header-->
        <div class="box-body">
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>nama</th>
		    <th>nama en</th>
		    <!--<th>deskripsi</th>
		    <th>deskripsi en</th>-->
            <th>urutan</th>
            <th>foto</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($produk_data as $produk)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $produk->nama ?></td>
		    <td><?php echo $produk->nama_en ?></td>
		    <!--<td><?php echo $produk->deskripsi ?></td>
		    <td><?php echo $produk->deskripsi_en ?></td>-->
            <td><?php echo $produk->urutan ?></td>
		    <td>
                <?php if(!empty($produk->foto)): ?>
                <img id="image_baru1" src='<?php echo base_url()."images/gallery/".$produk->foto; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                <?php else : ?>
                <img id="image_baru1" src='<?php echo base_url()."images/default.png"; ?>'
                                style="max-height= 200px; max-width: 200px;"
                                class="img-rounded" />
                <?php endif; ?>
            </td>
		    <td style="text-align:center">
			<?php 
			echo anchor(site_url('owner/produk/read/'.$produk->id_db),'Read'); 
			echo ' | '; 
			echo anchor(site_url('owner/produk/update/'.$produk->id_db),'Update'); 
			echo ' | '; 
			echo anchor(site_url('owner/produk/delete/'.$produk->id_db),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
