<?php

$this->load->view($folder_member.'template/head');

?>



<!--tambahkan custom css disini-->

<!-- iCheck -->

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />

<!-- Morris chart -->

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />

<!-- jvectormap -->

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />

<!-- Date Picker -->

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />

<!-- Daterange picker -->

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />



<?php

$this->load->view($folder_member.'template/topbar');

$this->load->view($folder_member.'template/sidebar');

?>





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





<?php 

$this->load->view($folder_member.'template/js');

?>

<!--tambahkan custom js disini, edit dan gunakan plugin yang sesaui kebutuhan-->

<!-- Bootstrap WYSIHTML5 -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>



<!-- Sparkline -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>



<!-- Morris.js charts -->

<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>

<!-- jvectormap -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>



<!-- daterangepicker -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>

<!-- datepicker -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>

<!-- iCheck -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>

<!-- ChartJS 1.0.1 -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/chartjs/Chart.min.js') ?>" type="text/javascript"></script>



<!-- jQuery Knob Chart -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>



<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard2.js') ?>" type="text/javascript"></script>



<!-- AdminLTE for demo purposes -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>



<!-- jQuery UI 1.11.2 -->

<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

    $.widget.bridge('uibutton', $.ui.button);

</script>



<!-- AdminLTE for demo purposes -->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>





<?php

$this->load->view($folder_member.'template/foot');

?>

