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
            <h4>Emergency Contact </h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Contact</h3>
                <div class="card-tools">
                  <!-- <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?> -->
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">
                   <div class="form-group col-md-6 select_sm">
                      <label>Select Relation</label>
                      <select class="form-control select2 form-control-sm " name="employee_contact_rel" id="employee_contact_rel" data-placeholder="Select  Relation" required="">
                        <option value="">Select  Relation</option>
                        <option value="Self" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'Self'){ echo 'selected'; } ?> >Self</option>
                        <option value="Parent" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'Parent'){ echo 'selected'; } ?> >Parent</option>
                        <option value="Spouse" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'Spouse'){ echo 'selected'; } ?> >Spouse</option>
                        <option value="Child" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'Child'){ echo 'selected'; } ?> >Child</option>
                        <option value="Sibling" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'Sibling'){ echo 'selected'; } ?> >Sibling</option>
                        <option value="In Laws" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_rel'] == 'In Laws'){ echo 'selected'; } ?> >In Laws</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Email</label>
                      <input type="text" class="form-control form-control-sm" name="employee_contact_email" id="employee_contact_email" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_email']; } ?>" placeholder="Email">
                    </div>
                    <div class="col-md-4 text-left">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="employee_contact_is_primary" id="employee_contact_is_primary" value="1" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_is_primary'] == 1){ echo 'checked'; } ?>>
                        <label for="employee_contact_is_primary" class="custom-control-label pt-1">Primary Contact</label>
                      </div>
                    </div>
                    <div class="col-md-4 text-left">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="employee_contact_is_dependant" id="employee_contact_is_dependant" value="1" <?php if(isset($employee_contact_info) && $employee_contact_info['employee_contact_is_dependant'] == 1){ echo 'checked'; } ?>>
                        <label for="employee_contact_is_dependant" class="custom-control-label pt-1">Dependant</label>
                      </div>
                    </div>
                     <div class="form-group col-md-4 ">
                      <input type="text" class="form-control form-control-sm" name="employee_contact_dependant" id="employee_contact_dependant" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_dependant']; } ?>" placeholder="dependant">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label> Name</label>
                      <input type="text" class="form-control form-control-sm" name="employee_contact_name" id="employee_contact_name" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_name']; } ?>" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Phone</label>
                      <input type="number" class="form-control form-control-sm" name="employee_contact_phone" id="employee_contact_phone" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_phone']; } ?>" placeholder="Phone">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" name="employee_contact_address" id="employee_contact_address" rows="3" placeholder="Enter Address"><?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-3 ">
                      <label>Mobile</label>
                      <input type="number" class="form-control form-control-sm" name="employee_contact_mobile" id="employee_contact_mobile" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_mobile']; } ?>" placeholder="Mobile">
                    </div>
                    <div class="form-group col-md-3 ">
                      <label>City</label>
                      <input type="text" class="form-control form-control-sm" name="employee_contact_city" id="employee_contact_city" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_city']; } ?>" placeholder="City">
                    </div>
                    <div class="form-group col-md-3 ">
                      <label>State</label>
                      <input type="text" class="form-control form-control-sm" name="employee_contact_state" id="employee_contact_state" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_state']; } ?>" placeholder="State">
                    </div>
                    <div class="form-group col-md-3 ">
                      <label>Zipcode</label>
                      <input type="number" class="form-control form-control-sm" name="employee_contact_zipcode" id="employee_contact_zipcode" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_zipcode']; } ?>" placeholder="Zipcode">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Home Number</label>
                      <input type="number" class="form-control form-control-sm" name="employee_contact_home_num" id="employee_contact_home_num" value="<?php if(isset($employee_contact_info)){ echo $employee_contact_info['employee_contact_home_num']; } ?>" placeholder="Home Number">
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Country</label>
                      <select class="form-control select2 form-control-sm " name="country_id" id="country_id" data-placeholder="Select Country" required="">
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($employee_contact_info) && $employee_contact_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
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
                    <th>Relation</th>
                    <th>Name </th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th class="wt_50">City</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($employee_contact_list as $list) { $i++;
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/edit_employee_contact/<?php echo $list->employee_contact_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Emp_Panel/Emp_Profile/delete_employee_contact/<?php echo $list->employee_contact_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Document');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->employee_contact_rel; ?></td>
                        <td><?php echo $list->employee_contact_name; ?></td>
                        <td><?php echo $list->employee_contact_mobile; ?></td>
                        <td><?php echo $list->employee_contact_email; ?></td>
                        <td><?php echo $list->employee_contact_city; ?></td>
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
