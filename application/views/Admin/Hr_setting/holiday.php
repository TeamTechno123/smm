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
            <h4>Holiday</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Holiday</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else {
                    echo '<a href="<?php echo base_url(); ?>Hr_setting/holiday" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-12">
                      <label>Holiday Event Name</label>
                      <input type="text" class="form-control form-control-sm" name="holiday_name" id="holiday_name" value="<?php if(isset($holiday_info)){ echo $holiday_info['holiday_name']; } ?>"  placeholder="Enter Holiday Event Name" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Start Date</label>
                      <input type="text" class="form-control form-control-sm" name="holiday_start_date" value="<?php if(isset($holiday_info)){ echo $holiday_info['holiday_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Start Date" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>End Date</label>
                      <input type="text" class="form-control form-control-sm" name="holiday_end_date" value="<?php if(isset($holiday_info)){ echo $holiday_info['holiday_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter End Date" required >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Description</label>
                      <textarea class="form-control form-control-sm" name="holiday_descr" id="holiday_descr" rows="4"><?php if(isset($holiday_info)){ echo $holiday_info['holiday_descr']; } ?></textarea>
                    </div>

                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="holiday_status" id="holiday_status" value="0" <?php if(isset($holiday_info) && $holiday_info['holiday_status'] == 0){ echo 'checked'; } ?>>
                          <label for="holiday_status" class="custom-control-label">Disable This Holiday</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Hr_setting/holiday" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Holiday</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Holiday Name</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($holiday_list)){
                      $i=0; foreach ($holiday_list as $list) { $i++;
                        // $city_info = $this->Master_Model->get_info_arr_fields3('city_name', '', 'city_id', $list->city_id, '', '', '', '', 'city');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Hr_setting/edit_holiday/<?php echo $list->holiday_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Hr_setting/delete_holiday/<?php echo $list->holiday_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Holiday');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->holiday_name; ?></td>
                        <td><?php echo $list->holiday_start_date; ?></td>
                        <td><?php echo $list->holiday_end_date; ?></td>
                        <td>
                          <?php if($list->holiday_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
