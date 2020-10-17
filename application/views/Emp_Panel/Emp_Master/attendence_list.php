<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
            <h4>Attendance</h4>
          </div>
          <?php include('timesheet_topbar.php'); ?>
        </div>

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">


            <div class="card-body">
              <form class="form-horizontal" autocomplete="off" method="post">
                <div class="form-group row">
                 <div class="col-md-12">
                    <label class=""> Date</label>
                 </div>
                  <div class="col-sm-8">
                    <input type="text" class="form-control from_date" name="from_date" id="date1" data-target="#date1" data-toggle="datetimepicker">
                    <label class="text-red">  </label>
                  </div>

                  <div class="col-sm-4">
                     <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="button">Get</button>
                    </div>
                  </div>

                </div>

              </form>

             <div class="row">
              <div class="col-sm-8"> <h6 class="">Daily Attendance Report</h6> </div>
               <div class="col-sm-4"> <h5> <a href="#">  <span class="badge badge-primary"> <i class="fas fa-plus ml-2 mr-2"></i> Date Wise Attendance</span></a> </h5>  </div>

             </div>

                <hr>
                <div class="" style="overflow-x:auto">
                  <table id="example1" class="table table-bordered table-striped scroll" >
                    <thead>
                    <tr>
                      <th class="d-none">#</th>
                      <th>Employee</th>
                      <!-- <th>Employee Id</th> -->
                      <th class="wt_50">Date</th>
                      <th class="wt_50">Clock In</th>
                      <th class="wt_50">Clock Out</th>
                      <th class="wt_50">Total</th>
                      <th class="wt_50">Overtime</th>
                      <th class="wt_50">Total Work </th>
                      <th class="wt_50">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($attendence_list)){
                       $i=0; foreach ($attendence_list as $list) { $i++;
                         $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname,employee_emp_id', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                      ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                        <!-- <td><?php if($employee_info) { echo $employee_info[0]['employee_emp_id']; } ?></td> -->
                        <td><?php echo $list->attendence_date; ?></td>
                        <td><?php echo $list->attendence_in_time; ?></td>
                        <td><?php echo $list->attendence_out_time; ?></td>
                        <td><?php echo $list->attendence_tot_time.' Hour'; ?></td>
                        <td><?php echo $list->overtime_tot_time.' Hour'; ?></td>
                        <td><?php echo $list->tot_present_time.' Hour'; ?></td>
                        <td>
                          <?php if($list->attendence_status == '1'){ echo '<span class="text-success">Present</span>'; }
                          elseif($list->attendence_status == '2'){ echo '<span class="text-primary">Holiday</span>'; }
                          elseif($list->attendence_status == '3'){ echo '<span class="text-primary">Leave</span>'; }
                          else{ echo '<span class="text-danger">Absent</span>'; } ?>
                        </td>
                      </tr>
                    <?php } } ?>
                    </tbody>

                  </table>
                </div>

                <br>
            </div>
          </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>


  </div>

</body>
</html>
