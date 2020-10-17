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
            <h4>Documents</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Documents</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">

                    <div class="form-group col-md-6 select_sm" data-select2-id="14">
                      <label>Document</label>
                      <select class="form-control select2 form-control-sm " name="document_type_id" id="document_type_id" data-placeholder="Select Document" required="" >
                        <option value="" >Select Document</option>
                        <?php if(isset($document_type_list)){ foreach ($document_type_list as $list) { ?>
                        <option value="<?php echo $list->document_type_id; ?>" <?php if(isset($employee_doc_info) && $employee_doc_info['document_type_id'] == $list->document_type_id){ echo 'selected'; } if($list->document_type_status == 0){ echo 'disabled'; } ?> ><?php echo $list->document_type_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                      <div class="form-group col-md-6 ">
                            <label>Date Of Expiry</label>
                            <input type="text" class="form-control form-control-sm" name="employee_doc_exp_date" value="<?php if(isset($employee_doc_info)){ echo $employee_doc_info['employee_doc_exp_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Date Of Expiry" required>
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Document Title</label>
                            <input type="text" class="form-control form-control-sm" name="employee_doc_title" id="employee_doc_title" value="<?php if(isset($employee_doc_info)){ echo $employee_doc_info['employee_doc_title']; } ?>" placeholder="Document Title" required>
                          </div>

                          <div class="form-group col-md-6 ">
                            <label>Notification Email</label>
                            <input type="email" class="form-control form-control-sm email" name="employee_doc_email" id="employee_doc_email" value="<?php if(isset($employee_doc_info)){ echo $employee_doc_info['employee_doc_email']; } ?>" placeholder="Notification Email">
                          </div>

                           <div class="form-group col-md-12 ">
                            <label>Description</label>
                            <input type="text" class="form-control form-control-sm" name="employee_doc_descr" id="employee_doc_descr" value="<?php if(isset($employee_doc_info)){ echo $employee_doc_info['employee_doc_descr']; } ?>" placeholder="Description">
                          </div>

                          <div class="form-group col-md-6">
                            <label>Documents File</label>
                            <input type="file" class="form-control form-control-sm valid_image" name="employee_doc_image" id="employee_doc_image">
                            <label>.jpg/.png/.jpeg file &amp; size less than 500kb.</label>
                          </div>
                          <div class="form-group col-md-6">
                            <?php if(isset($employee_doc_info) && $employee_doc_info['employee_doc_image']){ ?>
                              <img width="150px" src="<?php echo base_url() ?>assets/images/employee_doc/<?php echo $employee_doc_info['employee_doc_image'];  ?>" alt="Document Image">
                              <input type="hidden" name="old_employee_doc_image" value="<?php echo $employee_doc_info['employee_doc_image']; ?>">
                            <?php } ?>
                          </div>

                          <div class="form-group col-md-6 select_sm" data-select2-id="14">
                            <label>Send Notification Mail When Expired</label>
                            <select class="form-control select2 form-control-sm " name="employee_doc_notify" id="employee_doc_notify" data-placeholder="Select" required>
                              <option value="1" <?php if(isset($employee_doc_info) && $employee_doc_info['employee_doc_notify'] == '1'){ echo 'selected'; } ?>>Yes</option>
                              <option value="0" <?php if(isset($employee_doc_info) && $employee_doc_info['employee_doc_notify'] == '0'){ echo 'selected'; } ?> >No</option>
                            </select>
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
                    <th>Document Title</th>
                    <th class="wt_50">Expiry Date </th>
                    <th>Decsription</th>
                    <th class="wt_50">Notification</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($employee_doc_list as $list) { $i++;
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/edit_employee_doc/<?php echo $list->employee_doc_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/delete_employee_doc/<?php echo $list->employee_doc_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Document');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->employee_doc_title; ?></td>
                        <td><?php echo $list->employee_doc_exp_date; ?></td>
                        <td><?php echo $list->employee_doc_descr; ?></td>
                        <td><?php if($list->employee_doc_notify == 0){ echo 'No'; } else{ echo 'Yes'; } ?></td>
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
