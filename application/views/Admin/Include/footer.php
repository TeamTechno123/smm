<?php
  $smm_user_id = $this->session->userdata('smm_user_id');
  $smm_company_id = $this->session->userdata('smm_company_id');
  $smm_role_id = $this->session->userdata('smm_role_id');
  $company_info = $this->Master_Model->get_info_arr_fields('company_name','company_id', $smm_company_id, 'company');
?>
<footer class="main-footer">
  <strong>Copyright &copy;<?php echo date('Y'); ?>-<?php echo date('Y')+1; ?> <a href="<?php echo base_url(); ?>"><?php echo $company_info[0]['company_name']; ?></a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url(); ?>assets/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url(); ?>assets/plugins/flot-old/jquery.flot.pie.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/my_validation.js"></script>
<script type="text/javascript">
  <?php if($this->session->flashdata('save_success')){ ?>
    $(document).ready(function(){
      toastr.success('Information Saved successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('update_success')){ ?>
    $(document).ready(function(){
      toastr.info('Information Updated successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('delete_success')){ ?>
    $(document).ready(function(){
      toastr.error('Information Deleted successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('upload_success')){ ?>
    $(document).ready(function(){
      toastr.success('File Uploaded Successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('upload_error')){ ?>
    $(document).ready(function(){
      toastr.error('File Not Uploaded');
    });
  <?php } ?>
</script>



<script>

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
    //Money Euro
    $('[data-mask]').inputmask();
    $('.mfd_date').inputmask();
    // $(f).find('.mfd_date').mask('99/99/9999');
  })
</script>




<script type="text/javascript">
  var dateToday = new Date();
  $('#min_date1').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: dateToday,
  });
  $('#min_date2').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: dateToday,
  });
  $('#min_date3').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: dateToday,
  });
  $('#min_date4').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: dateToday,
  });
  $('#min_date5').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: dateToday,
  });

  $('#date1').datetimepicker({
    format: 'DD-MM-Y'
  });
  $('#date2').datetimepicker({
    format: 'DD-MM-Y'
  });
  $('#date3').datetimepicker({
    format: 'DD-MM-Y'
  })
  $('#date4').datetimepicker({
    format: 'DD-MM-Y'
  })
  $('#date5').datetimepicker({
    format: 'DD-MM-Y'
  })
  $('.date').datetimepicker({
    format: 'DD-MM-Y'
  });

  //Timepicker
  $('#time1').datetimepicker({
    format: 'LT'
  });
  $('#time2').datetimepicker({
    format: 'LT'
  });
  $('#time3').datetimepicker({
    format: 'LT'
  });
  $('#time4').datetimepicker({
    format: 'LT'
  });
  $('#time5').datetimepicker({
    format: 'LT'
  });
  $('#time6').datetimepicker({
    format: 'LT'
  });
  $('#time7').datetimepicker({
    format: 'LT'
  });
  $('#time8').datetimepicker({
    format: 'LT'
  });
  $('#time9').datetimepicker({
    format: 'LT'
  });
  $('#time10').datetimepicker({
    format: 'LT'
  });
  $('#time11').datetimepicker({
    format: 'LT'
  });
  $('#time12').datetimepicker({
    format: 'LT'
  });
  $('#time13').datetimepicker({
    format: 'LT'
  });
  $('#time14').datetimepicker({
    format: 'LT'
  });
  $('#time15').datetimepicker({
    format: 'LT'
  });
  $('#time16').datetimepicker({
    format: 'LT'
  });


  $('#datetime1').datetimepicker({
    format: 'DD-MM-Y LT'
  });
  $('#datetime2').datetimepicker({
    format: 'DD-MM-Y LT'
  });
  $('#datetime3').datetimepicker({
    format: 'DD-MM-Y LT'
  });
  $('#datetime4').datetimepicker({
    format: 'DD-MM-Y LT'
  });
  $('#datetime5').datetimepicker({
    format: 'DD-MM-Y LT'
  });

  $('#monthyear1').datetimepicker({
    format: 'MM-Y'
  });
  $('#monthyear2').datetimepicker({
    format: 'MM-Y'
  });

</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $("#example5").DataTable();
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  $(function () {
    // Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    //Initialize Select2 Elements
    $('.select2').select2();
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox();
  })
</script>

<!-- Menu Active -->
<script type="text/javascript">
  $(document).ready(function() {
    var url = window.location.href;
    var activePage = url;
    $('.nav-sidebar .nav-link').removeClass('active');
    $('.has-treeview').removeClass('menu-open');
    $('.nav-treeview').css("display", "none");
    // alert(activePage);
    $('.nav-link').each(function () {
      var linkPage = this.href;
      if (activePage == linkPage) {
          $(this).closest(".nav-link").addClass("active");
          $(this).closest(".has-treeview").addClass("menu-open");
          $(this).closest(".has-treeview").find(".nav-treeview").css("display", "block");
          $(this).closest(".has-treeview").find(".head").addClass("active");
      }
    });
  });
</script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
