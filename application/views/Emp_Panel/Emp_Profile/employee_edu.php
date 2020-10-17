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
            <h4>Qualification</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Qualification</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">

                    <div class="form-group col-md-12 ">
                      <label>Title </label>
                      <input type="text" class="form-control form-control-sm" name="employee_edu_title" id="employee_edu_title" value="<?php if(isset($employee_edu_info)){ echo $employee_edu_info['employee_edu_title']; } ?>" placeholder="Enter Qualification Title" required>
                    </div>
                     <div class="form-group col-md-6 ">
                      <label>School / University </label>
                      <input type="text" class="form-control form-control-sm" name="employee_edu_university" id="employee_edu_university" value="<?php if(isset($employee_edu_info)){ echo $employee_edu_info['employee_edu_university']; } ?>" placeholder="School / University " required>
                    </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Education Level</label>
                        <select class="form-control select2 form-control-sm " name="education_info_id" id="education_info_id" data-placeholder="Select Education Level" required>
                          <option value="" >Select Education Level</option>
                          <?php if(isset($education_info_list)){ foreach ($education_info_list as $list) { ?>
                          <option value="<?php echo $list->education_info_id; ?>" <?php if(isset($employee_edu_info) && $employee_edu_info['education_info_id'] == $list->education_info_id){ echo 'selected'; } if($list->education_info_status == 0){ echo 'disabled'; } ?> ><?php echo $list->education_info_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Time Period From </label>
                        <input type="text" class="form-control form-control-sm" name="employee_edu_start" value="<?php if(isset($employee_edu_info)){ echo $employee_edu_info['employee_edu_start']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Time Period From " required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>To </label>
                        <input type="text" class="form-control form-control-sm" name="employee_edu_end" value="<?php if(isset($employee_edu_info)){ echo $employee_edu_info['employee_edu_end']; } ?>"  id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="To" required>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Language</label>
                        <select class="form-control select2 form-control-sm " name="language_id" id="language_id" data-placeholder="Select Language" required>
                          <option value="">Select Language</option>
                          <?php if(isset($language_list)){ foreach ($language_list as $list) { ?>
                          <option value="<?php echo $list->language_id; ?>" <?php if(isset($employee_edu_info) && $employee_edu_info['language_id'] == $list->language_id){ echo 'selected'; } if($list->language_status == 0){ echo ' disabled'; } ?> ><?php echo $list->language_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Professional Courses (If Any)</label>
                        <select class="form-control select2 form-control-sm " name="prof_course_id" id="prof_course_id" data-placeholder="Select Prfessional Courses" >
                          <option value="" >Select Professional Courses</option>
                          <?php if(isset($prof_course_list)){ foreach ($prof_course_list as $list) { ?>
                          <option value="<?php echo $list->prof_course_id; ?>" <?php if(isset($employee_edu_info) && $employee_edu_info['prof_course_id'] == $list->prof_course_id){ echo 'selected'; } if($list->prof_course_status == 0){ echo ' disabled'; } ?> ><?php echo $list->prof_course_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea class="form-control form-control-sm" name="employee_edu_descr" id="employee_edu_descr" rows="3" placeholder="Description"><?php if(isset($employee_edu_info)){ echo $employee_edu_info['employee_edu_descr']; } ?></textarea>
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
            <!-- general form elements -->
            <div class="card">

            <div class="card-body">
                <hr>
                <table id="example1" class="table table-bordered table-striped scroll" >
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action </th>
                    <th>Qualification Title</th>
                    <th class="wt_50">From Date </th>
                    <th class="wt_50">To Date</th>
                    <th class="wt_50">Language</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($employee_edu_list as $list) { $i++;
                      $language_details = $this->Master_Model->get_info_arr_fields('language_name','language_id', $list->language_id, 'smm_language');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/edit_employee_edu/<?php echo $list->employee_edu_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/delete_employee_edu/<?php echo $list->employee_edu_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Qualification');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->employee_edu_title; ?></td>
                        <td><?php echo $list->employee_edu_start; ?></td>
                        <td><?php echo $list->employee_edu_end; ?></td>
                        <td><?php if($language_details){ echo $language_details[0]['language_name']; } ?></td>
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
