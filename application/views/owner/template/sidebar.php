<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <!-- <img src="<?php echo base_url('images/logo.jpg') ?>" class="img-circle" alt="User Image" />  -->
        </div>
        <div class="pull-left info">
            <p><?php echo $show_username; ?></p>
            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
    </div>
    <!-- search form -->
   <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php //echo "SELECT * FROM module_member WHERE parrent = '0' ORDER by urutan ASC"; ?>
    <ul class="sidebar-menu">
        <li class="header"> MAIN NAVIGATION </li>
        <?php
            $class = $this->router->fetch_class();
            $sql_menu = $this->db->query("SELECT * FROM module WHERE parrent = '0' ORDER by urutan ASC");
            foreach ($sql_menu->result() as $row)
            {
                $sql_sub_menu = $this->db->query("SELECT * FROM module 
                                                 WHERE parrent = '$row->id_main' ORDER by urutan ASC");
                $sql_sub_row = $sql_sub_menu->num_rows();
                if($sql_sub_row == 0)
                {   
                    ?>
                    <li <?php if($class == $row->link){ echo "class='active'"; } ?> /><a href="<?php echo site_url($folder_admin."".$row->link); ?>"> <i class="fa <?=$row->icon?>"></i><?=$row->nama_menu?></a></li>
                    <?php
                }
                else{
                    $sql_cek_menu = $this->db->query("SELECT * FROM module WHERE link like '%$class%' AND parrent = '$row->id_main' ");

                    $sql_cek_menu = $sql_cek_menu->num_rows();
                ?>
                    <li class="treeview <?php if ($sql_cek_menu != 0): ?>active<?php endif; ?>">
                        <a href="#">
                            <i class="fa <?=$row->icon?>"></i> <span><?=$row->nama_menu?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                        <?php
                            foreach ($sql_sub_menu->result() as $row1)
                            {
                              $this->db->from('users');
                              // $this->db->where('id_jabatan', $this->session->userdata('leveluser'));
                              // $this->db->where("list_modul like '%$row1->link%'");
                              $result = $this->db->get();

                              if($result->num_rows() > 0)
                              {
                                ?>
                                  <li <?php if ($class == $row1->link): ?>class="active"<?php endif; ?> />
                                    <a href="<?php echo site_url($folder_admin."".$row1->link); ?>" />
                                        <i class="fa fa-circle-o"></i> <?=$row1->nama_menu?> 
                                    </a>
                                  </li>                            
                                <?php
                              }
                              elseif($this->session->userdata('leveluser') == '1')
                              {
                                ?>
                                  <li <?php if ($class == $row1->link): ?>class="active"<?php endif; ?> />
                                    <a href="<?php echo site_url($folder_admin."".$row1->link); ?>" />
                                        <i class="fa fa-circle-o"></i> <?=$row1->nama_menu?> 
                                    </a>
                                  </li>
                                <?php
                              }
                            }
                        ?>
                        </ul>
                    </li>
                <?php
                }
            }
            //END
        ?>
    </ul>
</section>
<!-- /.sidebar -->
