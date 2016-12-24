
<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jQuery/jQuery.min.js') ?>"></script>
<!-- Moment -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/datetimepicker/moment.js') ?>"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/app.min.js') ?>" type="text/javascript"></script>
<!-- DataTable -->
<script src='<?php echo base_url('assets/datatables2/datable.js') ?>'></script>
<!-- LAIN-LAIN -->
<script src='<?php echo base_url('assets/datatables2/jquert_datable.js') ?>'></script>
<script src="<?php echo base_url('tinymcpuk/jscripts/tiny_mce/tiny_mce.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/typeahead1.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/script.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
	$('#mytable').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "aLengthMenu": [ 10, 30, 50, 100 ],
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false
    });
    $('#mytable2').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "aLengthMenu": [ 10, 30, 50, 100 ],
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
    });
</script>
<script type="text/javascript">
    $("#id_provinsi").change(function(event) {
        var id_provinsi = $("#id_provinsi").val();
        $("#form_kabupaten").load("<?php echo base_url(); ?>" + "member/ajax_data/get_kabupaten/"+id_provinsi);
    });
</script>
<script type="text/javascript">
/** 
    AUTO COMPLETE TYPE HEAD
                            **/
    $(document).ready(function() {

        var daftar_hastag = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
             remote: {
                 url: '<?php echo base_url()?>/ajax_data/list_hastag/?query=%QUERY',
                 wildcard: '%QUERY'
             }
        });

        $('#hastag.hastag').typeahead(null, {
            id: 'hastag',
            method: 'GET',
            display: 'value',
            source: daftar_hastag,
            limit:20,
            hint: true,
            highlight: true,
            minLength: 1,
            templates: {
                suggestion: function(data){
                  return '<p> <strong> ' + data.hastag + '</strong>  ' + data.qty + ' post</p>';
                }
            }
        });

        //AUTO COMPLETE EVENT
        var daftar_event = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
             remote: {
                 url: '<?php echo base_url()?>/ajax_data/list_event/?query=%QUERY',
                 wildcard: '%QUERY'
             }
        });

        $('#hastag.event').typeahead(null, {
            //name: 'best-pictures',
            id: 'hastag',
            method: 'GET',
            display: 'value',
            source: daftar_event,
            limit:20,
            hint: true,
            highlight: true,
            minLength: 1,
            templates: {
                suggestion: function(data){
                  return '<p> <strong> ' + data.events + '</strong> </p>';
                }
            }
        });

        $('form').submit(function(){
            $(this).find(':submit').attr('disabled','disabled');
        });

    });
</script>
<script type="text/javascript">
/** PILIH HASTAG  VARIABLE_A **/
$("#pilih_VARIABLE_A").click(function(){
    var input_VARIABLE_A    = $( "#input_VARIABLE_A" ).val();
    var opsi_VARIABLE_A     = $( "#hastag").val();

    if(input_VARIABLE_A == "")
    {
        $("#input_VARIABLE_A").val(opsi_VARIABLE_A);
    }
    else{
        $("#input_VARIABLE_A").val(input_VARIABLE_A+"|"+opsi_VARIABLE_A);
    }
    var tampil_VARIABLE_A       = $( "#tampil_VARIABLE_A" ).html();
    var opsi_nama_VARIABLE_A    = $( "#hastag" ).val();
    
    if(tampil_VARIABLE_A == "")
    {
        var opsi_VARIABLE_A1 = "'"+opsi_VARIABLE_A+"'";
        $("#tampil_VARIABLE_A").html('<button type="button" id="id_data'+opsi_VARIABLE_A+'" name="GetMessage" class="btn" onclick="delete_data_VARIABLE_A('+opsi_VARIABLE_A1+')"> '+opsi_nama_VARIABLE_A +' <span class="fa fa-times-circle"> </button>  ');
    }
    else{
        var opsi_VARIABLE_A1 = "'"+opsi_VARIABLE_A+"'";
        $("#tampil_VARIABLE_A").html(tampil_VARIABLE_A+' <button type="button" id="id_data'+opsi_VARIABLE_A+'" class="btn" name="GetMessage" onclick="delete_data_VARIABLE_A('+opsi_VARIABLE_A1+')">'+opsi_nama_VARIABLE_A+' <span class=\"fa fa-times-circle\"> </button>  ');
    }

    $( "#hastag" ).val("");
});
/** END HASTAG PILIH VARIABLE_A **/

function delete_data_VARIABLE_A(opsi_VARIABLE_A){
    var input_VARIABLE_A = $( "#input_VARIABLE_A" ).val();
    var elem = document.getElementById("id_data"+opsi_VARIABLE_A);
    elem.parentElement.removeChild(elem);
    
    if (input_VARIABLE_A.indexOf("|") >= 0)
    {
        var a = input_VARIABLE_A;
        var mengsplit1 = a.split(opsi_VARIABLE_A);
        //alert(mengsplit1);
        var result1 = mengsplit1.join('QAZ|');
        //alert(result1);
        if (result1.includes("QAZ||") == true)
        {    var mengsplit2 = result1.split('QAZ||');  }
        else
        {   var mengsplit2 = result1.split('QAZ|');   }
    
        var result2 = mengsplit2.join('');
        $("#input_VARIABLE_A").val(result2);
    }
    else{
        $("#input_VARIABLE_A").val("");
    }
}

function format_rupiah(angka)
{
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
}


</script>
<!--tambahkan custom js disini, edit dan gunakan plugin yang sesaui kebutuhan-->
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/chartjs/Chart.min.js') ?>" type="text/javascript"></script>
<?php
if(isset($minDate)){ $minDate = $minDate; }else{ $minDate = "01/01/1980"; }
if(isset($maxDate)){ $maxDate = $maxDate; }else{ $maxDate = "31/12/9999"; }
?>
<script>
    $('#date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#date1').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#date2').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    
    $('#datetimepicker6').daterangepicker({
        minDate: '<?=$minDate?>',
        maxDate: '<?=$maxDate?>',
        locale: {
            format: 'YYYY/MM/DD'
        }
    });
    $('#datentime').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerIncrement: 5,
        minDate: '<?=$minDate?> 00:00',
        maxDate: '<?=$maxDate?> 23:59',
        locale: {
            format: 'YYYY/MM/DD HH:mm'
        }
    });

</script>