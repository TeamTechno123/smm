<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Project</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update) || !isset($from_order)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Project</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="<?php base_url(); ?>Project/project" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update) || isset($from_order)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="col-md-6 row px-0 py-0">

                      <div class="form-group col-md-6 select_sm">
                        <label>Project No.</label>
                        <input type="number" class="form-control form-control-sm" name="project_no" id="project_no" value="<?php if(isset($project_info)){ echo $project_info['project_no']; } elseif(isset($project_no)){ echo $project_no; } ?>"  placeholder="Enter Project No." required readonly>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Project Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_date" value="<?php if(isset($project_info)){ echo $project_info['project_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Project Date" required >
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Project Name</label>
                        <input type="text" class="form-control form-control-sm" name="project_name" id="project_name" value="<?php if(isset($project_info)){ echo $project_info['project_name']; } ?>"  placeholder="Enter Name of Project" required >
                      </div>
                      <!-- <div class="form-group col-md-6 select_sm">
                        <label>P. O. No.</label>
                        <input type="number" class="form-control form-control-sm" name="project_po_no" id="project_po_no" value="<?php if(isset($project_info)){ echo $project_info['project_po_no']; } ?>"  placeholder="Enter P. O. No." required >
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Phase No. </label>
                        <input type="number" class="form-control form-control-sm" name="project_phase_no" id="project_phase_no" value="<?php if(isset($project_info)){ echo $project_info['project_phase_no']; } ?>"  placeholder="Phase No." required>
                      </div> -->
                      <div class="form-group col-md-12 select_sm">
                        <label>Client(Customer)</label>
                        <select class="form-control select2" name="client_id" id="client_id" data-placeholder="Client(Customer)">
                          <option value="">Select Client(Customer)</option>
                          <?php if(isset($reseller_list)){ foreach ($reseller_list as $list) { ?>
                          <option value="<?php echo $list->reseller_id; ?>" <?php if(isset($project_info) && $project_info['client_id'] == $list->reseller_id){ echo 'selected'; } ?>><?php echo $list->reseller_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Start Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_start_date" value="<?php if(isset($project_info)){ echo $project_info['project_start_date']; } elseif(isset($from_order)){ echo $start_date; } ?>" id="date3" data-target="#date3" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Start Date" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>End Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_end_date" value="<?php if(isset($project_info)){ echo $project_info['project_end_date']; } elseif(isset($from_order)){ echo $end_date; } ?> ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="End Date" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Budget Hours</label>
                        <input type="number" min="0" class="form-control form-control-sm" name="project_budget_hours" id="project_budget_hours" value="<?php if(isset($project_info)){ echo $project_info['project_budget_hours']; } ?>"  placeholder="Budget Hours" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Budget Amount</label>
                        <input type="number" min="0" class="form-control form-control-sm" name="project_budget_amount" id="project_budget_amount" value="<?php if(isset($project_info)){ echo $project_info['project_budget_amount']; } elseif(isset($from_order)){ echo $budget_amount; } ?>"  placeholder="Budget Amount" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Priority</label>
                        <select class="form-control select2" name="project_piority" id="project_piority" data-placeholder="Priority">
                          <option value="">Priority</option>
                          <option value="Low" <?php if(isset($project_info) && $project_info['project_piority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                          <option value="Medium" <?php if(isset($project_info) && $project_info['project_piority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                          <option value="High" <?php if(isset($project_info) && $project_info['project_piority'] == 'High'){ echo 'selected'; } ?>>High</option>
                          <option value="Highest" <?php if(isset($project_info) && $project_info['project_piority'] == 'Highest'){ echo 'selected'; } ?>>Highest</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Project Members</label>
                        <select class="form-control select2" multiple name="project_member[]" id="project_member[]" data-placeholder="Select Project Members">
                          <option value="">Select Project Members</option>
                          <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                          <option value="<?php echo $list->employee_id; ?>" <?php if(isset($project_info)){
                            $project_member_arr =  $project_info['project_member'];
                            $project_member_arr = explode(',',$project_member_arr);
                            foreach ($project_member_arr as $project_member) {
                              if($project_member == $list->employee_id){
                                echo 'selected';
                              }
                            }
                          } if($list->employee_status == 0){ echo ' disabled'; } ?>><?php echo $list->employee_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Revisions</label>
                        <input type="number" min="0" step="1" class="form-control form-control-sm" name="project_revisions" id="project_revisions" value="<?php if(isset($project_info)){ echo $project_info['project_revisions']; } elseif(isset($from_order)){ echo $revisions; } ?>"  placeholder="Enter Revisions" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Progress (%)</label>
                        <input type="number" min="0" max="100" step="1" class="form-control form-control-sm" name="project_progress" id="project_progress" value="<?php if(isset($project_info)){ echo $project_info['project_progress']; } ?>"  placeholder="Enter Progress" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Status</label>
                        <select class="form-control select2" name="project_status" id="project_status" data-placeholder="Select Status">
                          <option value="">Select Status</option>
                          <option value="0" <?php if(isset($project_info) && $project_info['project_status'] == '0'){ echo 'selected'; } ?>>Not Started</option>
                          <option value="1" <?php if(isset($project_info) && $project_info['project_status'] == '1'){ echo 'selected'; } ?>>In Progress</option>
                          <option value="2" <?php if(isset($project_info) && $project_info['project_status'] == '2'){ echo 'selected'; } ?>>Completed</option>
                          <option value="3" <?php if(isset($project_info) && $project_info['project_status'] == '3'){ echo 'selected'; } ?>>Cancelled</option>
                          <option value="4" <?php if(isset($project_info) && $project_info['project_status'] == '4'){ echo 'selected'; } ?>>On Hold</option>
                        </select>
                      </div>


                    </div>
                    <div class="col-md-6 px-0 py-0">
                      <div class="form-group col-md-12 select_sm">
                        <style media="screen">
                        .note-editing-area {
                          height: 351px !important;
                        }
                        </style>
                        <label>Description</label>
                        <textarea class="textarea form-control form-control-sm" name="project_descr" id="project_descr" placeholder="Place some text here" rows="12"><?php if(isset($project_info)){ echo $project_info['project_descr']; } elseif(isset($from_order)){ echo $descr; } ?></textarea>
                      </div>
                      <!-- <div class="form-group col-md-12 select_sm">
                        <label>Summary</label>
                        <textarea class="form-control form-control-sm" name="project_summery" id="project_summery" rows="2"><?php if(isset($project_info)){ echo $project_info['project_summery']; } ?></textarea>
                      </div> -->
                    </div>

                  </div>

                  <div class="form-group col-md-12">
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Project File</h5>
                      </div>
                      <div class="col-md-6 text-right">
                        <button type="button" id="add_row" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="" style="overflow-x:auto;">
                      <table id="myTable" class="table table-bordered tbl_list">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th class="wt_250">File</th>
                          <th class="wt_50"></th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($project_file_list)){ $i = 0; foreach ($project_file_list as $list) { ?>
                            <!-- <input type="hidden" name="input[<?php echo $i; ?>][project_file_id]" value="<?php echo $list->project_file_id; ?>"> -->
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="project_file_name[]" value="<?php echo $list->project_file_name; ?>" disabled>
                              </td>
                              <td class="wt_250">
                                <a target="_blank" href="<?php echo base_url() ?>assets/images/project/<?php echo $list->project_file_image; ?>"><?php echo $list->project_file_image; ?></a>
                              </td>
                              <td class="wt_50">
                                <input type="hidden" class="project_file_id" value="<?php echo $list->project_file_id; ?>">
                                <a class="rem_row"><i class="fa fa-trash text-danger"></i></a>
                              </td>
                            </tr>
                          <?php $i++;  } } else{ ?>
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="project_file_name[]" required>
                              </td>
                              <td class="wt_250">
                                <input type="file"  class="form-control form-control-sm" name="project_file_image[]" required>
                              </td>
                              <td class="wt_50"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Delivery Phase</h5>
                      </div>
                      <div class="col-md-6 text-right">
                        <button type="button" id="add_row2" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="" style="overflow-x:auto;">
                      <table id="myTable2" class="table table-bordered tbl_list">
                        <thead>
                        <tr>
                          <th>Delivery Phase Details</th>
                          <th class="">Delivery Date</th>
                          <th class="">Payment Amount</th>
                          <th class="wt_50"></th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($project_del_phase_list)){ $k = 0; foreach ($project_del_phase_list as $list) { ?>
                            <input type="hidden" name="input[<?php echo $k; ?>][project_del_phase_id]" value="<?php echo $list->project_del_phase_id; ?>">
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="input[<?php echo $k; ?>][project_del_phase_descr]" value="<?php echo $list->project_del_phase_descr; ?>" required>
                              </td>
                              <td>
                                <input type="date" class="form-control form-control-sm" name="input[<?php echo $k; ?>][project_del_phase_date]" value="<?php echo $list->project_del_phase_date; ?>" required>
                              </td>
                              <td>
                                <input type="number" min="0" class="form-control form-control-sm  project_del_phase_amount" name="input[<?php echo $k; ?>][project_del_phase_amount]" value="<?php echo $list->project_del_phase_amount; ?>" required>
                              </td>
                              <td class="wt_50">
                                <!-- <input type="hidden" class="project_del_phase_id" value="<?php echo $list->project_del_phase_id; ?>"> -->
                                <?php if($k > 0){ ?><a class="rem_row"><i class="fa fa-trash text-danger"></i></a><?php } ?>
                              </td>
                            </tr>
                          <?php $k++;  } } else{ ?>
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="input[0][project_del_phase_descr]" value="" required>
                              </td>
                              <td>
                                <input type="date" class="form-control form-control-sm" name="input[0][project_del_phase_date]" value="" required>
                              </td>
                              <td>
                                <input type="number" min="0" class="form-control form-control-sm  project_del_phase_amount" name="input[0][project_del_phase_amount]" value="" required>
                              </td>
                              <td class="wt_50"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="project_status" id="project_status" value="0" <?php if(isset($project_info) && $project_info['project_status'] == 0){ echo 'checked'; } ?>>
                          <label for="project_status" class="custom-control-label">Disable This Project</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Project/project" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          echo '<button type="submit" class="btn btn-sm btn-success float-right px-4">Save</button>';
                        } ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">List All Project</h3>
              </div>
              <div class="card-body p-2" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_30">Action</th>
                    <th>Project Name</th>
                    <th class="wt_100">Members</th>
                    <th class="wt_100">Client</th>
                    <th class="wt_30">Priority</th>
                    <th class="wt_50">Start Date</th>
                    <th class="wt_50">End Date</th>
                    <th class="wt_50">Complete</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($project_list)){
                    $i=0; foreach ($project_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Project/edit_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Project/delete_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Project');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td>
                          <a href="<?php echo base_url() ?>Project/set_project_session/<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></a>
                        </td>
                        <td class="wt_100">
                          <div class="row px-1">
                            <?php
                              $project_member = $list->project_member;
                              $project_member = explode(',',$project_member);
                              $i=0;
                              $employee_list = array();
                              foreach ($project_member as $project_member_id) {
                                $employee_info = $this->Master_Model->get_info_arr_fields('*', 'employee_id', $project_member_id, 'smm_employee');
                            ?>
                            <div class="col-4 p-0">
                              <img style="border-radius:50%;" width="30px" src="<?php echo base_url(); ?>assets/images/employee/<?php echo $employee_info[0]['employee_image']; ?>" alt="">
                            </div>
                            <?php  } ?>
                          </div>
                        </td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php echo $list->project_piority; ?></td>
                        <td><?php echo $list->project_start_date; ?></td>
                        <td><?php echo $list->project_end_date; ?></td>
                        <td>
                          <span class="f-12">Complete: <?php echo $list->project_progress; ?>%</span>
                           <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $list->project_progress; ?>%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"><?php echo $list->project_progress; ?>%</div>
                           </div>
                        </td>
                        <td>
                          <?php if($list->project_status == 0){ echo '<span class="text-warning"><b>Not Started</b></span>'; }
                            elseif($list->project_status == 1){ echo '<span class="text-primary"><b>In Progress</b></span>'; }
                            elseif($list->project_status == 2){ echo '<span class="text-success"><b>Completed</b></span>'; }
                            elseif($list->project_status == 3){ echo '<span class="text-danger"><b>Cancelled</b></span>'; }
                            elseif($list->project_status == 4){ echo '<span class="text-info"><b>On Hold</b></span>'; } ?>
                        </td>
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>

<script type="text/javascript">

  // $(document).on('change','#project_budget_amount',function(){
  //   var project_budget_amount = parseFloat($('#project_budget_amount').val());
  //   var sum = 0;
  //   $(".project_del_phase_amount").each(function(){
  //     var amt = parseFloat($(this).val());
  //       sum += +amt;
  //   });
  // });
  //
  // $(document).on('change','.project_del_phase_amount',function(){
  //   var project_budget_amount = parseFloat($('#project_budget_amount').val());
  //
  //   var sum = 0;
  //   $(".project_del_phase_amount").each(function(){
  //     var amt = parseFloat($(this).val());
  //       sum += amt;
  //   });
  //   if(project_budget_amount != sum){
  //     $(this).val('');
  //     $(this).focus();
  //     toastr.error('Total Phase Amount is must be equal to Total Budget Amount');
  //   }
  // });




  // Add Row...
  <?php if(isset($update)){ ?>
  var i = <?php echo $i-1; ?>
  <?php } else { ?>
  var i = 0;
  <?php } ?>

  $('#add_row').click(function(){
    i++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<input type="text" class="form-control form-control-sm" name="project_file_name[]" required>'+
      '</td>'+
      '<td class="wt_250">'+
        '<input type="file"  class="form-control form-control-sm" name="project_file_image[]" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
    var project_file_id = $(this).closest('tr').find('.project_file_id').val();
    $.ajax({
      url:'<?php echo base_url(); ?>Project/delete_project_file',
      type: 'POST',
      data: {"project_file_id":project_file_id},
      context: this,
      success: function(result){
        toastr.error('File Deleted successfully');
      }
    });
  });
</script>

<script type="text/javascript">

  // Add Row...
  <?php if(isset($update)){ ?>
  var k = <?php echo $k-1; ?>
  <?php } else { ?>
  var k = 0;
  <?php } ?>

  // $('#add_row2').click(function(){
  $(document).on('click','#add_row2',function(){
    k++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<input type="text" class="form-control form-control-sm" name="input['+k+'][project_del_phase_descr]" value="" required>'+
      '</td>'+
      '<td>'+
        '<input type="date" class="form-control form-control-sm" name="input['+k+'][project_del_phase_date]" value="" required>'+
      '</td>'+
      '<td>'+
        '<input type="number" min="0" class="form-control form-control-sm project_del_phase_amount" name="input['+k+'][project_del_phase_amount]" value="" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable2').append(row).html();
  });

  $('#myTable2').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
  });

</script>
