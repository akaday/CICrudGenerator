
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header-->
        <div class="box-body">
            
            <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">nama jabatan <?php echo form_error('nama_jabatan') ?></label>
                <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="nama_jabatan" value="<?php echo $nama_jabatan; ?>" />
            </div>
	    <div class="form-group">
                <label for="list_modul">list modul <?php echo form_error('list_modul') ?></label>
                <!-- <input type='text' class="form-control" name="list_modul" placeholder="list_modul" value='<?php echo $list_modul; ?>'> -->
<table>
<?php
    $sql_menu = $this->db->query("SELECT * FROM module WHERE parrent IS NULL ORDER by urutan ASC");
    echo "<tr>
            ";
        ?>
        <td>
            <input type='hidden' name='list_modul[]' value='dashboard'>  &nbsp;
                <!-- dashboard --> &nbsp; &nbsp;
        </td>
        <?php
        $i=1;
        foreach ($sql_menu->result() as $row)
        {
        ?>  <td>
                <input type='checkbox' name='id_menu[]' value='<?=$row->link?>'>  &nbsp;
                <?=$row->nama_menu?> &nbsp; &nbsp; 
            </td>
        <?php
            if($i/9 == 1 OR $i/9 == 2 OR $i/9 == 3)
            {
                echo "</tr><tr>";
            }

        $i++;
        }
    echo "
            
        </tr>";
echo "</table>
    <table>";
    $sql_menu = $this->db->query("SELECT * FROM module WHERE parrent = '0' ORDER by urutan ASC");
    foreach ($sql_menu->result() as $row)
    {
        $sql_sub_menu = $this->db->query("SELECT * FROM module 
                                         WHERE parrent = '$row->id_main' ORDER by urutan ASC");
        $sql_sub_row = $sql_sub_menu->num_rows();
        if($sql_sub_row == 0)
        {   
            $this->db->from('users_jabatan');
            $this->db->where('id_jabatan', $id_jabatan);
            $this->db->where("list_modul like '%$row->link%'");
            $result1 = $this->db->get();
            if($result1->num_rows() > 0 AND $row->link != "")
            {
            ?>
            <tr>
                <td>
                    <input type='checkbox' name='list_modul[]' checked value='<?=$row->link?>'>  &nbsp;
                    <?=$row->nama_menu?> &nbsp; &nbsp;
                </td>
            </tr>
            <?php
            }
            else
            {
            ?>
            <tr>
                <td>
                    <input type='checkbox' name='list_modul[]' value='<?=$row->link?>'>  &nbsp;
                    <?=$row->nama_menu?> &nbsp; &nbsp;
                </td>
            </tr>
            <?php
            }
            
        }
        else
        {
        ?>
        <!--<li class="treeview <?php if ($sql_sub_row != 0): ?> active <?php endif; ?>" >-->
        <tr>
            <td>
                <?php
                $this->db->from('users_jabatan');
                $this->db->where('id_jabatan', $id_jabatan);
                $this->db->where("list_modul like '%$row->link%'");
                $result = $this->db->get();
                //echo $this->db->last_query()."<br>";
                if($result->num_rows() > 0 AND $row->link != "")
                {
                ?>  
                    <!-- <input type='checkbox' name='list_modul[]' value='<?=$row->link?>' checked>  &nbsp; -->
                    <b><?=$row->nama_menu?></b> : <!-- | <i class='red'> <?=$row->link?></i> -->  &nbsp; &nbsp;
                <?php
                }
                else
                {
                ?>  
                    <!-- <input type='checkbox' name='list_modul[]' value='<?=$row->link?>' >  &nbsp; -->
                    <b><?=$row->nama_menu?></b> : <!-- | <i class='red'> <?=$row->link?></i> -->  &nbsp; &nbsp;                        
                <?php
                }

                //Bagian Sub Module
                $i=1;
                foreach ($sql_sub_menu->result() as $row1)
                {
                    $this->db->from('users_jabatan');
                    $this->db->where('id_jabatan', $id_jabatan);
                    $this->db->where("list_modul like '%$row1->link%'");
                    $result1 = $this->db->get();
                    //echo $this->db->last_query()."<br>";

                    if($result1->num_rows() > 0 AND $row1->link != "")
                    {
                    ?>  <td>
                        <input type='checkbox' name='list_modul[]' value='<?=$row1->link?>' checked>  
                        &nbsp;  <?=$row1->nama_menu?> &nbsp; &nbsp;

                        </td>                           
                    <?php
                    }
                    else
                    {
                    ?>  <td> 
                        <input type='checkbox' name='list_modul[]' value='<?=$row1->link?>' > &nbsp; 
                        <?=$row1->nama_menu?> <!-- | <i class='red'> <?=$row1->link?></i> -->  &nbsp; &nbsp;
                        </td>                         
                    <?php
                    }
                    if($i/8 == 1 OR $i/8 == 2 OR $i/8 == 3 OR $i/8 == 4)
                    {
                        echo "</tr><tr>";
                    }
                    $i++;
                }
            ?>
            </td>
        </tr>
        <?php
        }
    }

?>
</table>

            </div>
	    <div class="form-group">
                <label for="varchar">URL Awal Setelah Login <?php echo form_error('ke') ?></label>
                <input type="text" required class="form-control" name="ke" id="ke" placeholder="contoh : penjualan_main/create" value="<?php echo $ke; ?>" />
            </div>
	    <input type="hidden" name="id_jabatan" value="<?php echo $id_jabatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('owner/users_jabatan') ?>" class="btn btn-default">Cancel</a>
	</form>

        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

