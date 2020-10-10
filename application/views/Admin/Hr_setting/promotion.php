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
            <h4>Promotion</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Promotion</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/promotion" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Promotion For</label>
                            <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->employee_id; ?>" <?php if(isset($promotion_info) && $promotion_info['employee_id'] == $list->employee_id){ echo 'selected'; } if($list->employee_status == '0'){ echo 'disabled'; } ?>><?php echo $list->employee_name.' '.$list->employee_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Designation</label>
                            <select class="form-control select2 form-control-sm" name="designation_id" id="designation_id" data-placeholder="Select Designation" required>
                              <option value="">Select Designation</option>
                              <?php if(isset($designation_list)){ foreach ($designation_list as $list) { ?>
                              <option value="<?php echo $list->designation_id; ?>" <?php if(isset($promotion_info) && $promotion_info['designation_id'] == $list->designation_id){ echo 'selected'; } if($list->designation_status == '0'){ echo 'disabled'; } ?>><?php echo $list->designation_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Promotion Title</label>
                            <input type="text" class="form-control form-control-sm" name="promotion_title" id="promotion_title" value="<?php if(isset($promotion_info)){ echo $promotion_info['promotion_title']; } ?>" placeholder="Enter Promotion Title" >
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Promotion Date</label>
                            <input type="text" class="form-control form-control-sm" name="promotion_date" value="<?php if(isset($promotion_info)){ echo $promotion_info['promotion_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Promotion Date" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="promotion_descr" id="promotion_descr" rows="7"><?php if(isset($promotion_info)){ echo $promotion_info['promotion_descr']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="promotion_status" id="promotion_status" value="0" <?php if(isset($promotion_info) && $promotion_info['promotion_status'] == 0){ echo 'checked'; } ?>>
                            <label for="promotion_status" class="custom-control-label">Disable This Promotion</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/promotion" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Promotion Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th>Title</th>
                    <th class="wt_150">Designation</th>
                    <th class="wt_75">Promotion Date</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($promotion_list)){
                     $i=0; foreach ($promotion_list as $list) { $i++;
                       $designation_info = $this->Master_Model->get_info_arr_fields3('designation_name', '', 'designation_id', $list->designation_id, '', '', '', '', 'smm_designation');
                       $employee_info = $this->Master_Model->get_info_arr_fields3('employee_name,employee_lname', '', 'employee_id', $list->employee_id, '', '', '', '', 'smm_employee');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_promotion/<?php echo $list->promotion_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_promotion/<?php echo $list->promotion_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Promotion Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($employee_info) { echo $employee_info[0]['employee_name'].' '.$employee_info[0]['employee_lname']; } ?></td>
                      <td><?php echo $list->promotion_title; ?></td>
                      <td class="wt_150"><?php if($designation_info) { echo $designation_info[0]['designation_name']; } ?></td>
                      <td><?php echo $list->promotion_date; ?></td>
                      <!-- <td>
                        <?php if($list->promotion_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
