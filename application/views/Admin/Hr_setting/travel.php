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
            <h4>Travel</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Travel</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/travel" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0" id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 select_sm">
                            <label>Employee</label>
                            <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->employee_id; ?>" <?php if(isset($travel_info) && $travel_info['employee_id'] == $list->employee_id){ echo 'selected'; } if($list->employee_status == '0'){ echo 'disabled'; } ?>><?php echo $list->employee_name.' '.$list->employee_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Start Date</label>
                            <input type="text" class="form-control form-control-sm" name="travel_start_date" value="<?php if(isset($travel_info)){ echo $travel_info['travel_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Start Date" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>End Date</label>
                            <input type="text" class="form-control form-control-sm" name="travel_end_date" value="<?php if(isset($travel_info)){ echo $travel_info['travel_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter End Date" required>
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Purpose of Visit</label>
                            <input type="text" class="form-control form-control-sm" name="travel_purpose" id="travel_purpose" value="<?php if(isset($travel_info)){ echo $travel_info['travel_purpose']; } ?>" placeholder="Enter Purpose of Visit" >
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Place of Visit</label>
                            <input type="text" class="form-control form-control-sm" name="travel_place" id="travel_place" value="<?php if(isset($travel_info)){ echo $travel_info['travel_place']; } ?>" placeholder="Enter Place of Visit" >
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Expected Budget</label>
                            <input type="number" min="1" step="1" class="form-control form-control-sm" name="travel_exp_budget" id="travel_exp_budget" value="<?php if(isset($travel_info)){ echo $travel_info['travel_exp_budget']; } ?>" placeholder="Enter Expected Budget" >
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Actual Budget</label>
                            <input type="number" min="1" step="1" class="form-control form-control-sm" name="travel_act_budget" id="travel_act_budget" value="<?php if(isset($travel_info)){ echo $travel_info['travel_act_budget']; } ?>" placeholder="Enter Actual Budget" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="travel_descr" id="travel_descr" rows="7"><?php if(isset($travel_info)){ echo $travel_info['travel_descr']; } ?></textarea>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Travel Mode</label>
                            <select class="form-control select2 form-control-sm" name="travel_mode" id="travel_mode" data-placeholder="Select Travel Mode" required>
                              <option value="">Select Travel Mode</option>
                              <option value="By Bus" <?php if(isset($travel_info) && $travel_info['travel_mode'] == 'By Bus'){ echo 'selected'; } ?>>By Bus</option>
                              <option value="By Train" <?php if(isset($travel_info) && $travel_info['travel_mode'] == 'By Train'){ echo 'selected'; } ?> >By Train</option>
                              <option value="By Plane" <?php if(isset($travel_info) && $travel_info['travel_mode'] == 'By Plane'){ echo 'selected'; } ?> >By Plane</option>
                              <option value="By Taxi" <?php if(isset($travel_info) && $travel_info['travel_mode'] == 'By Taxi'){ echo 'selected'; } ?> >By Taxi</option>
                              <option value="By Rental Car" <?php if(isset($travel_info) && $travel_info['travel_mode'] == 'By Rental Car'){ echo 'selected'; } ?> >By Rental Car</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Arrangement Type</label>
                            <select class="form-control select2 form-control-sm" name="travel_arr_type_id" id="travel_arr_type_id" data-placeholder="Select Arrangement Type" required>
                              <option value="">Select Arrangement Type</option>
                              <?php if(isset($travel_arr_type_list)){ foreach ($travel_arr_type_list as $list) { ?>
                              <option value="<?php echo $list->travel_arr_type_id; ?>" <?php if(isset($travel_info) && $travel_info['travel_arr_type_id'] == $list->travel_arr_type_id){ echo 'selected'; } if($list->travel_arr_type_status == '0'){ echo 'disabled'; } ?>><?php echo $list->travel_arr_type_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="travel_status" id="travel_status" value="0" <?php if(isset($travel_info) && $travel_info['travel_status'] == 0){ echo 'checked'; } ?>>
                            <label for="travel_status" class="custom-control-label">Disable This Travel</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/travel" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
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
              <div class="card-header">
                <h3 class="card-title">List All Travel Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                    <th class="wt_150">Arrangement Type</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($travel_list)){
                     $i=0; foreach ($travel_list as $list) { $i++;
                       $travel_arr_type_info = $this->Master_Model->get_info_arr_fields3('travel_arr_type_name', '', 'travel_arr_type_id', $list->travel_arr_type_id, '', '', '', '', 'smm_travel_arr_type');
                       $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_travel/<?php echo $list->travel_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_travel/<?php echo $list->travel_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Travel Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                      <td><?php echo $list->travel_start_date; ?></td>
                      <td><?php echo $list->travel_end_date; ?></td>
                      <td class="wt_150"><?php if($travel_arr_type_info) { echo $travel_arr_type_info[0]['travel_arr_type_name']; } ?></td>
                      <!-- <td>
                        <?php if($list->travel_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td> -->
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
