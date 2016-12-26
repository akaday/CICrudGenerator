<!DOCTYPE html>
<html>
<?php $this->load->view($folder_admin.'template/head'); ?>

<body class="skin-purple">

    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Top side column. topbar -->
        <header class="main-header">
            <?php $this->load->view($folder_admin.'template/topbar'); ?>
        </header>
        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <?php $this->load->view($folder_admin.'template/sidebar'); ?>
        </aside>
        <!-- =============================================== -->
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $content_header; ?>
                    <small><?php echo $content_header_small; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
                    <?php echo $breadcrumb_active; ?>
                </ol>
            </section>
            <!-- Main content -->
            <?php
                //Load Page
                $this->load->view($view);
            ?>
            <!-- Main content -->
        </div><!-- /.content-wrapper -->
        <!-- =============================================== -->

        <!-- footer.  -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <!-- <b>Version</b> 2.0 -->
            </div>
            <strong>Copyright &copy; <?=DATE('Y')?> </strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->    
    <!-- =============================================== -->
    

<?php   $this->load->view($folder_admin.'template/js'); ?>
<?php   $this->load->view($folder_admin.'template/foot'); ?>
