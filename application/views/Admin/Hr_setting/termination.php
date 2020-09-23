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
            <h4>Termination</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Termination</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/termination" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                            <label>Employee Terminated</label>
                            <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                              <option value="">Select Employee</option>
                              <?php if(isset($employee_list)){ foreach ($employee_list as $list) { ?>
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($termination_info) && $termination_info['employee_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Notice Date</label>
                            <input type="text" class="form-control form-control-sm" name="termination_notice_date" value="<?php if(isset($termination_info)){ echo $termination_info['termination_notice_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Notice Date" required>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Termination Date</label>
                            <input type="text" class="form-control form-control-sm" name="termination_date" value="<?php if(isset($termination_info)){ echo $termination_info['termination_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Termination Date" required>
                          </div>

                          <div class="form-group col-md-12 select_sm">
                            <label>Termination Type</label>
                            <select class="form-control select2 form-control-sm" name="termination_type_id" id="termination_type_id" data-placeholder="Select Termination Type" required>
                              <option value="">Select Termination Type</option>
                              <?php if(isset($termination_type_list)){ foreach ($termination_type_list as $list) { ?>
                              <option value="<?php echo $list->termination_type_id; ?>" <?php if(isset($termination_info) && $termination_info['termination_type_id'] == $list->termination_type_id){ echo 'selected'; } if($list->termination_type_status == '0'){ echo 'disabled'; } ?>><?php echo $list->termination_type_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>

                          <div class="form-group col-md-8">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="termination_image" id="termination_image">
                            <label>.jpg/.png/.jpeg file & size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-4">
                          <?php if(isset($termination_info) && $termination_info['termination_image']){ ?>
                            <input type="hidden" name="old_termination_image" value="<?php echo $termination_info['termination_image']; ?>">
                            <img width="100px" src="<?php echo base_url(); ?>assets/images/termination/<?php echo $termination_info['termination_image']; ?>" alt="">
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="termination_descr" id="termination_descr" rows="8"><?php if(isset($termination_info)){ echo $termination_info['termination_descr']; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="termination_status" id="termination_status" value="0" <?php if(isset($termination_info) && $termination_info['termination_status'] == 0){ echo 'checked'; } ?>>
                            <label for="termination_status" class="custom-control-label">Disable This Termination</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/termination" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Termination Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="wt_75">Notice Date</th>
                    <th class="wt_75">Termination Date</th>
                    <th>Type</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($termination_list)){
                     $i=0; foreach ($termination_list as $list) { $i++;
                       $termination_type_info = $this->Master_Model->get_info_arr_fields3('termination_type_name', '', 'termination_type_id', $list->termination_type_id, '', '', '', '', 'smm_termination_type');
                       $user_info = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->employee_id, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_termination/<?php echo $list->termination_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_termination/<?php echo $list->termination_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Termination Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($user_info) { echo $user_info[0]['user_name'].' '.$user_info[0]['user_lname']; } ?></td>
                      <td><?php echo $list->termination_notice_date; ?></td>
                      <td><?php echo $list->termination_date; ?></td>
                      <td><?php if($termination_type_info) { echo $termination_type_info[0]['termination_type_name']; } ?></td>
                      <!-- <td>
                        <?php if($list->termination_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
