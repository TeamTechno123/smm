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
            <h4>Work Experience</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <?php include('profile_menu.php'); ?>
          </div>
          <div class="col-md-9">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Experience</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <div class="card-body px-0 py-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">
                    <div class="form-group col-md-6 ">
                      <label>Company</label>
                      <input type="text" class="form-control form-control-sm" name="employee_experience_company" id="employee_experience_company" value="<?php if(isset($employee_experience_info)){ echo $employee_experience_info['employee_experience_company']; } ?>" placeholder="Company">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Post</label>
                      <input type="text" class="form-control form-control-sm" name="employee_experience_post" id="employee_experience_post" value="<?php if(isset($employee_experience_info)){ echo $employee_experience_info['employee_experience_post']; } ?>" placeholder="Post">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Time Period From </label>
                      <input type="text" class="form-control form-control-sm" name="employee_experience_from" value="<?php if(isset($employee_experience_info)){ echo $employee_experience_info['employee_experience_from']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="From ">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>To </label>
                      <input type="text" class="form-control form-control-sm" name="employee_experience_to" value="<?php if(isset($employee_experience_info)){ echo $employee_experience_info['employee_experience_to']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="To">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Description</label>
                      <textarea class="form-control form-control-sm" name="employee_experience_descr" id="employee_experience_descr" rows="3" placeholder="Description"><?php if(isset($employee_experience_info)){ echo $employee_experience_info['employee_experience_descr']; } ?></textarea>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">

                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Emp_Panel/Emp_User/dashboard" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
            <div class="card-body">
                <hr>
                <table id="example1" class="table table-bordered table-striped scroll" >
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action </th>
                    <th>Company</th>
                    <th>Post </th>
                    <th class="wt_50">From Date</th>
                    <th class="wt_50">To Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($employee_experience_list as $list) { $i++;
                      // $language_details = $this->Master_Model->get_info_arr_fields('language_name','language_id', $list->language_id, 'smm_language');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/edit_employee_experience/<?php echo $list->employee_experience_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/delete_employee_experience/<?php echo $list->employee_experience_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Experience Information');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->employee_experience_company; ?></td>
                        <td><?php echo $list->employee_experience_post; ?></td>
                        <td><?php echo $list->employee_experience_from; ?></td>
                        <td><?php echo $list->employee_experience_to; ?></td>
                        <!-- <td><?php if($language_details){ echo $language_details[0]['language_name']; } ?></td> -->
                      </tr>
                    <?php } ?>
                  </tbody>

                </table>
                <br>
            </div>
          </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
