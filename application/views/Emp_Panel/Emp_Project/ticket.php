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
            <h4>Ticket</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 <?php if(!isset($update)){ echo 'd-none'; } ?>">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> Ticket</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    // echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Emp_Panel/Emp_Project/ticket" class="btn btn-xs btn-outline-info">Cancel</a>';
                  } ?>
                </div>
              </div>
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                        <div class="form-group col-md-6">
                          <label>Ticket No.</label>
                          <input type="number" class="form-control form-control-sm" name="ticket_no" id="ticket_no" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_no']; } ?>"  placeholder="Enter Ticket No." required readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Ticket Date</label>
                          <input type="text" class="form-control form-control-sm " name="ticket_date" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Ticket Date" required disabled>
                        </div>
                        <div class="form-group col-md-12 select_sm">
                          <label>Project</label>
                          <select class="form-control select2 form-control-sm" name="project_id" id="project_id" data-placeholder="Select Project" required disabled>
                            <option value="">Select Project</option>
                            <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                            <option value="<?php echo $list->project_id; ?>" <?php if(isset($ticket_info) && $ticket_info['project_id'] == $list->project_id){ echo 'selected'; } ?>><?php echo $list->project_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Ticket Title</label>
                          <input type="text" class="form-control form-control-sm" name="ticket_title" id="ticket_title" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_title']; } ?>"  placeholder="Enter Ticket Title" required disabled>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Discription</label>
                          <span>
                            <?php if(isset($ticket_info)){ echo $ticket_info['ticket_descr']; } ?>
                          </span>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Attachment</label><br>
                        <?php if(isset($ticket_info) && $ticket_info['ticket_image']){ ?>
                          <a target="_blank" href="<?php echo $ticket_info['ticket_image']; ?>" > Click Here to View </a>
                          <!-- <img width="150px" src="<?php echo $ticket_info['ticket_image']; ?>" alt=""> -->
                        <?php } ?>
                        </div>
                        <!-- <div class="form-group col-md-8">
                        </div> -->

                        <div class="form-group col-md-4 select_sm">
                          <label>Status</label>
                          <select class="form-control select2 form-control-sm" name="ticket_status" id="ticket_status" data-placeholder="Select Status" required>
                            <option value="">Select Status</option>
                            <!-- <option value="1" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == "1"){ echo 'selected'; } ?>>Pending</option> -->
                            <option value="2" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == "2"){ echo 'selected'; } ?> disabled>Assigned</option>
                            <option value="3" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == "3"){ echo 'selected'; } ?>>Working</option>
                            <option value="4" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == "4"){ echo 'selected'; } ?>>Completed</option>
                          </select>
                        </div>







                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="ticket_status" id="ticket_status" value="0" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == 0){ echo 'checked'; } ?>>
                          <label for="ticket_status" class="custom-control-label">Disable This Ticket</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_Project/ticket" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          // echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
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
                <h3 class="card-title">List All Ticket</h3>
              </div>
              <div class="card-body p-2" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Ticket Title</th>
                    <th>Project</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">Added By</th>
                    <th class="wt_75">Assigned To</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($ticket_list)){
                      $i=0; foreach ($ticket_list as $list) { $i++;
                        $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name, employee_lname', '', 'employee_id', $list->ticket_assign_to, '', '', '', '', 'smm_employee');
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                        $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->ticket_addedby, '', '', '', '', 'smm_reseller');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                          <?php //if($list->ticket_addedby_type == 1){ ?>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Project/ticket/<?php echo $list->ticket_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Project/delete_ticket/<?php echo $list->ticket_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Ticket');"><i class="fa fa-trash text-danger"></i></a> -->
                          <?php //} ?>
                          </div>
                        </td>
                        <td><?php echo $list->ticket_title; ?></td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <td><?php echo $list->ticket_date; ?></td>
                        <td class="wt_50"><?php if($list->ticket_addedby_type == 1){
                          echo '<span class="text-primary"><b>Admin</b></span>';
                        } else{
                          if($reseller_info){
                            echo '<span class="text-info"><b>'.$reseller_info[0]['reseller_name'].'</b></span>';
                          }
                        } ?></td>
                        <td class="wt_75">
                          <?php if($employee_info){ echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?>
                        </td>
                        <td>
                          <?php if($list->ticket_status == 1){ echo '<span class="text-danger">Pending</span>'; }
                            elseif($list->ticket_status == 2){ echo '<span class="text-info">Assigned</span>'; }
                            elseif($list->ticket_status == 3){ echo '<span class="text-primary">Working</span>'; }
                            elseif($list->ticket_status == 3){ echo '<span class="text-success">Completed</span>'; } ?>
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

  $("#ticket_category_type").on("change", function(){
    var ticket_category_type =  $('#ticket_category_type').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Project/category_by_type',
      type: 'POST',
      data: {"ticket_category_type":ticket_category_type},
      context: this,
      success: function(result){
        $('#ticket_category_id').html(result);
      }
    });
  });
</script>
