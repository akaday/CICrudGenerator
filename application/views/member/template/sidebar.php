<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

        <!-- Sidebar user panel -->

        <div class="user-panel">

            <div class="pull-left image">

                <img src="<?php echo base_url('images/logo.jpg') ?>" class="img-circle" alt="User Image" /> 

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

        <ul class="sidebar-menu">

            <li class="header"> MAIN NAVIGATION </li>
                <?php
                    $class = $this->router->fetch_class();
                ?>
                <li class="treeview <?php if ($class == "download"): ?>active<?php endif; ?>">
                    <a href="#">
                        <i class="fa fa-download"></i> <span> Download File </span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                    <?php 
                        $sql_kat_download = $this->db->query("SELECT * FROM download_kategori ORDER by id_db ASC");                      
                        foreach ($sql_kat_download->result() as $row1)
                        {
                            ?>
                            <li <?php if ($class == "download"): ?>class="active"<?php endif; ?> />
                                <a href="<?php echo site_url($folder_member."download/index/".$row1->id_db); ?>" />
                                    <i class="fa fa-circle-o"></i> <?=$row1->nama_kategori?> 
                                </a>
                            </li>                            
                            <?php
                        }

                    ?>

                    </ul>

                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-download"></i> <span> Publikasi </span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li  />
                            <a target='_blank' href="<?php echo site_url("artikel"); ?>" />
                                <i class="fa fa-circle-o"></i> Artikel
                            </a>
                        </li>
                        <li  />
                            <a target='_blank' href="<?php echo site_url("kegiatan"); ?>" />
                                <i class="fa fa-circle-o"></i> Kegiatan
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="<?php if ($class == "jurnal"): ?>active<?php endif; ?>">
                    <a href="<?php echo site_url($folder_member."/jurnal"); ?>"> <i class="fa fa-book"></i>Jurnal</a>
                </li>
                <li class="<?php if ($class == "users"): ?>active<?php endif; ?>">
                    <a href="<?php echo site_url($folder_member."/users"); ?>"> <i class="fa fa-user"></i>Ganti Password</a>
                </li>
        </ul>

    </section>

    <!-- /.sidebar -->

</aside>



<!-- =============================================== -->



<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">