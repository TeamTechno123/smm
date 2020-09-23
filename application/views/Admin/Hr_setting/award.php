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
            <h4>Award</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Award</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Hr_setting/award" type="button" class="btn btn-xs btn-outline-info" >Cancel Edit</a>';
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
                              <option value="<?php echo $list->user_id; ?>" <?php if(isset($award_info) && $award_info['employee_id'] == $list->user_id){ echo 'selected'; } if($list->user_status == '0'){ echo 'disabled'; } ?>><?php echo $list->user_name.' '.$list->user_lname; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 select_sm">
                            <label>Award Type</label>
                            <select class="form-control select2 form-control-sm" name="award_type_id" id="award_type_id" data-placeholder="Select Award Type" required>
                              <option value="">Select Award Type</option>
                              <?php if(isset($award_type_list)){ foreach ($award_type_list as $list) { ?>
                              <option value="<?php echo $list->award_type_id; ?>" <?php if(isset($award_info) && $award_info['award_type_id'] == $list->award_type_id){ echo 'selected'; } if($list->award_type_status == '0'){ echo 'disabled'; } ?>><?php echo $list->award_type_name; ?></option>
                              <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6 ">
                            <label>Date</label>
                            <input type="text" class="form-control form-control-sm" name="award_date" value="<?php if(isset($award_info)){ echo $award_info['award_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Date" required>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Gift</label>
                            <input type="text" class="form-control form-control-sm" name="award_gift" id="award_gift" value="<?php if(isset($award_info)){ echo $award_info['award_gift']; } ?>" placeholder="Enter Gift" required>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Cash</label>
                            <input type="number" min="0" class="form-control form-control-sm" name="award_cash" id="award_cash" value="<?php if(isset($award_info)){ echo $award_info['award_cash']; } ?>" placeholder="Enter Cash">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <textarea class=" form-control form-control-sm" name="award_descr" id="award_descr" rows="4"><?php if(isset($award_info)){ echo $award_info['award_descr']; } ?></textarea>
                          </div>
                          <div class="form-group col-md-12 ">
                            <label>Month & Year</label>
                            <input type="text" class="form-control form-control-sm" name="award_month_year" value="<?php if(isset($award_info)){ echo $award_info['award_month_year']; } ?>" id="monthyear1" data-target="#monthyear1" data-toggle="datetimepicker" placeholder="Enter Month & Year" required>
                          </div>
                          <div class="form-group col-md-8">
                            <label>Attach File</label>
                            <input type="file" class="form-control form-control-sm" name="award_image" id="award_image">
                            <label>.jpg/.png/.jpeg file & size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-4">
                          <?php if(isset($award_info) && $award_info['award_image']){ ?>
                            <input type="hidden" name="old_award_image" value="<?php echo $award_info['award_image']; ?>">
                            <img width="100px" src="<?php echo base_url(); ?>assets/images/award/<?php echo $award_info['award_image']; ?>" alt="">
                          <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Award Information</label>
                        <textarea class=" form-control form-control-sm" name="award_info" id="award_info" rows="4"><?php if(isset($award_info)){ echo $award_info['award_info']; } ?></textarea>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="award_status" id="award_status" value="0" <?php if(isset($award_info) && $award_info['award_status'] == 0){ echo 'checked'; } ?>>
                            <label for="award_status" class="custom-control-label">Disable This Award</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Hr_setting/award" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Award Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Employee</th>
                    <th class="">Award Type</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($award_list)){
                     $i=0; foreach ($award_list as $list) { $i++;
                       $award_type_info = $this->Master_Model->get_info_arr_fields3('award_type_name', '', 'award_type_id', $list->award_type_id, '', '', '', '', 'smm_award_type');
                       $user_info = $this->Master_Model->get_info_arr_fields3('user_name,user_lname', '', 'user_id', $list->employee_id, '', '', '', '', 'user');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-award">
                          <a href="<?php echo base_url() ?>Hr_setting/edit_award/<?php echo $list->award_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Hr_setting/delete_award/<?php echo $list->award_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Award Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php if($user_info) { echo $user_info[0]['user_name'].' '.$user_info[0]['user_lname']; } ?></td>
                      <td><?php if($award_type_info) { echo $award_type_info[0]['award_type_name']; } ?></td>
                      <td><?php echo $list->award_date; ?></td>
                      <td><img width="50px" src="<?php echo base_url() ?>assets/images/award/<?php echo $list->award_image;  ?>" alt="Award Image">
                      <td>
                        <?php if($list->award_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
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
