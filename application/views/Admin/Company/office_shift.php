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
            <h4>Office Shift</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Office Shift</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/office_shift" type="button" class="btn btn-sm btn-info" data-card-widget="collapse">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" office_shift="form" action="" method="post">
                  <div class="row p-4">
                    <div class="form-group col-md-8 ">
                      <label>Office Shift Name</label>
                      <input type="text" class="form-control form-control-sm" name="office_shift_name" id="office_shift_name" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_name']; } ?>"  placeholder="Enter Name of Office Shift" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Monday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_mon_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_mon_in']; } ?>" id="time1" data-target="#time1" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_mon_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_mon_out']; } ?>" id="time2" data-target="#time2" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Tuesday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_tue_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_tue_in']; } ?>" id="time3" data-target="#time3" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_tue_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_tue_out']; } ?>" id="time4" data-target="#time4" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Wednesday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_wed_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_wed_in']; } ?>" id="time5" data-target="#time5" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_wed_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_wed_out']; } ?>" id="time6" data-target="#time6" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Thursday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_thu_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_thu_in']; } ?>" id="time7" data-target="#time7" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_thu_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_thu_out']; } ?>" id="time8" data-target="#time8" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Friday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_fri_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_fri_in']; } ?>" id="time9" data-target="#time9" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_fri_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_fri_out']; } ?>" id="time10" data-target="#time10" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Saturday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_sat_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_sat_in']; } ?>" id="time11" data-target="#time11" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_sat_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_sat_out']; } ?>" id="time12" data-target="#time12" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>

                    <div class="form-group col-md-2">
                      <label>Sunday :</label>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_sun_in" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_sun_in']; } ?>" id="time13" data-target="#time13" data-toggle="datetimepicker" placeholder="In Time" required >
                    </div>
                    <div class="form-group col-md-3">
                      <input type="text" class="form-control form-control-sm" name="office_shift_sun_out" value="<?php if(isset($office_shift_info)){ echo $office_shift_info['office_shift_sun_out']; } ?>" id="time14" data-target="#time14" data-toggle="datetimepicker"  placeholder="Out Time" required >
                    </div>
                    <div class="form-group col-md-4 "></div>



                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="office_shift_status" id="office_shift_status" value="0" <?php if(isset($office_shift_info) && $office_shift_info['office_shift_status'] == 0){ echo 'checked'; } ?>>
                          <label for="office_shift_status" class="custom-control-label">Disable This Office Shift</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Company/office_shift" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Office Shift</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Office Shift Name</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($office_shift_list)){
                    $i=0; foreach ($office_shift_list as $list) { $i++; ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Company/edit_office_shift/<?php echo $list->office_shift_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Company/delete_office_shift/<?php echo $list->office_shift_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Office Shift');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->office_shift_name; ?></td>
                        <td>
                          <?php if($list->office_shift_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
