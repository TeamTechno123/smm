<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Company</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Company</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="<?php base_url(); ?>Admin/company" type="button" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-12">
                      <label>Company Name</label>
                      <input type="text" class="form-control form-control-sm" name="company_name" id="company_name" value="<?php if(isset($company_info)){ echo $company_info['company_name']; } ?>" placeholder="Enter Company Name" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Company Short Name</label>
                      <input type="text" class="form-control form-control-sm" name="company_shortname" id="company_shortname" value="<?php if(isset($company_info)){ echo $company_info['company_shortname']; } ?>" placeholder="Enter Company Short Name" required>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Type of Entity</label>
                      <select class="form-control select2" name="company_entity_id" id="company_entity_id" data-placeholder="Select Type of Entity" required>
                        <option value="">Select Type of Entity</option>
                        <?php if(isset($company_entity_list)){ foreach ($company_entity_list as $list) { ?>
                        <option value="<?php echo $list->company_entity_id; ?>" <?php if(isset($company_info) && $company_info['company_entity_id'] == $list->company_entity_id){ echo 'selected'; } if($list->company_entity_status == '0'){ echo 'disabled'; } ?>><?php echo $list->company_entity_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Legal/Trading Name</label>
                      <input type="text" class="form-control form-control-sm" name="company_leg_name" id="company_leg_name" value="<?php if(isset($company_info)){ echo $company_info['company_leg_name']; } ?>" placeholder="Enter Legal/Trading Name" required>
                    </div>

                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" rows="3" name="company_address" id="company_address" placeholder="Enter Company Address" required><?php if(isset($company_info)){ echo $company_info['company_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($company_info) && $company_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($company_info) && $company_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($company_info) && $company_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <!-- <div class="form-group col-md-4">
                      <label>Statecode</label>
                      <input type="number" class="form-control form-control-sm" name="company_statecode" id="company_statecode" value="<?php if(isset($company_info)){ echo $company_info['company_statecode']; } ?>" placeholder="Statecode">
                    </div> -->
                    <div class="form-group col-md-3">
                      <label>Pin/Zip Code</label>
                      <input type="number" min="100000" max="999999" step="1" class="form-control form-control-sm" name="company_pincode" id="company_pincode" value="<?php if(isset($company_info)){ echo $company_info['company_pincode']; } ?>" placeholder="Pin/Zip Code">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile No. 1</label>
                      <input type="number" min="5555555555" max="9999999999" step="1" class="form-control form-control-sm" name="company_mob1" id="company_mob1" value="<?php if(isset($company_info)){ echo $company_info['company_mob1']; } ?>" placeholder="Mobile No. 1" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile No. 2 / Landline No.</label>
                      <input type="number" class="form-control form-control-sm" name="company_mob2" id="company_mob2" value="<?php if(isset($company_info)){ echo $company_info['company_mob2']; } ?>" placeholder="Mobile No. 2">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="company_email" id="company_email" value="<?php if(isset($company_info)){ echo $company_info['company_email']; } ?>" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website</label>
                      <input type="text" class="form-control form-control-sm" name="company_website" id="company_website" value="<?php if(isset($company_info)){ echo $company_info['company_website']; } ?>" placeholder="Website">
                    </div>
                    <div class="form-group col-md-6">
                      <label>PAN No.</label>
                      <input type="text" class="form-control form-control-sm" name="company_pan_no" id="company_pan_no" value="<?php if(isset($company_info)){ echo $company_info['company_pan_no']; } ?>" placeholder="Pan No.">
                    </div>
                    <div class="form-group col-md-6">
                      <label>GST No.</label>
                      <input type="text" class="form-control form-control-sm" name="company_gst_no" id="company_gst_no" value="<?php if(isset($company_info)){ echo $company_info['company_gst_no']; } ?>" placeholder="GST No.">
                    </div>

                    <!-- <div class="form-group col-md-4">
                      <label>VAT No.</label>
                      <input type="text" class="form-control form-control-sm" name="company_vat_no" id="company_vat_no" value="<?php if(isset($company_info)){ echo $company_info['company_vat_no']; } ?>" placeholder="Enter VAT No.">
                    </div>
                    <div class="form-group col-md-4">
                      <label>CST No.</label>
                      <input type="text" class="form-control form-control-sm" name="company_cst_no" id="company_cst_no" value="<?php if(isset($company_info)){ echo $company_info['company_cst_no']; } ?>" placeholder="Enter CST No.">
                    </div> -->
                    <div class="form-group col-md-3">
                      <label>Registration No.</label>
                      <input type="text" class="form-control form-control-sm" name="company_reg_no" id="company_reg_no" value="<?php if(isset($company_info)){ echo $company_info['company_reg_no']; } ?>" placeholder="Enter Registration No.">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Lic No. 1</label>
                      <input type="text" class="form-control form-control-sm" name="company_dl1" id="company_dl1" value="<?php if(isset($company_info)){ echo $company_info['company_dl1']; } ?>" placeholder="Enter Lic No. 1">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Lic No. 2</label>
                      <input type="text" class="form-control form-control-sm" name="company_dl2" id="company_dl2" value="<?php if(isset($company_info)){ echo $company_info['company_dl2']; } ?>" placeholder="Enter Lic No. 2">
                    </div>
                    <div class="form-group col-md-3 select_sm">
                      <label>Select Currency</label>
                      <select class="form-control select2" name="currency_id" id="currency_id" data-placeholder="Select Currency" required>
                        <option value="">Select Currency</option>
                        <?php if(isset($currency_list)){ foreach ($currency_list as $list) { ?>
                        <option value="<?php echo $list->currency_id; ?>" <?php if(isset($company_info) && $company_info['currency_id'] == $list->currency_id){ echo 'selected'; } ?>><?php echo $list->currency_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                    <!-- <div class="form-group col-md-6">
                      <label>Financial From Date</label>
                      <input type="text" class="form-control form-control-sm" name="company_fin_from" value="<?php if(isset($company_info)){ echo $company_info['company_fin_from']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Financial From Date">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Financial To Date</label>
                      <input type="text" class="form-control form-control-sm" name="company_fin_to" value="<?php if(isset($company_info)){ echo $company_info['company_fin_to']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Financial To Date">
                    </div> -->

                    <div class="form-group col-md-4">
                      <label>Company Logo</label>
                      <input type="file" class="form-control form-control-sm" name="company_logo" id="company_logo">
                      <label>.jpg,.png,.jpeg file. Size less than 500 kb</label>
                    </div>
                    <div class="form-group col-md-2">
                      <?php if(isset($company_info) && $company_info['company_logo']){ ?>
                        <input type="hidden" name="old_company_logo" value="<?php echo $company_info['company_logo']; ?>">
                        <img class="mt-2" width="100px" src="<?php echo base_url(); ?>assets/images/master/<?php echo $company_info['company_logo']; ?>" alt="">
                      <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Company Fevicon</label>
                      <input type="file" class="form-control form-control-sm" name="company_fevicon" id="company_fevicon">
                      <label>.jpg,.png,.jpeg file. Size less than 500 kb</label>
                    </div>
                    <div class="form-group col-md-2">
                      <?php if(isset($company_info) && $company_info['company_fevicon']){ ?>
                        <input type="hidden" name="old_company_fevicon" value="<?php echo $company_info['company_fevicon']; ?>">
                        <img class="mt-2" width="100px" src="<?php echo base_url(); ?>assets/images/master/<?php echo $company_info['company_fevicon']; ?>" alt="">
                      <?php } ?>
                    </div>

                    <?php if(!isset($company_info)){ ?>
                      <div class="form-group col-md-12">
                        <hr>
                        <label>User Login Details</label>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Mobile Number</label>
                        <input type="number" min="5555555555" max="9999999999" step="1" class="form-control form-control-sm" name="user_mobile" id="user_mobile" value="" placeholder="Mobile No." required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-sm" name="user_password" id="user_password" value="" placeholder="Password" required>
                      </div>
                    <?php } ?>

                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="company_status" id="company_status" value="0" <?php if(isset($company_info) && $company_info['company_status'] == 0){ echo 'checked'; } ?>>
                          <label for="company_status" class="custom-control-label">Disable This Company</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Admin/company" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Company</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Company Name</th>
                    <th class="">Company Mobile</th>
                    <th class="">Company Email</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($company_list)){
                      $i=0; foreach ($company_list as $list) { $i++;
                      // $user_details = $this->Master_Model->get_info_arr_fields('user_name','user_id', $list->user_id, 'user');
                      // $role_details = $this->Master_Model->get_info_arr_fields('role_name','role_id', $list->role_id, 'role');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Admin/edit_company/<?php echo $list->company_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Admin/delete_company/<?php echo $list->company_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Company');"><i class="fa fa-trash text-danger"></i></a> -->
                          </div>
                        </td>
                        <td><?php echo $list->company_name; ?></td>
                        <td><?php echo $list->company_mob1; ?></td>
                        <td><?php echo $list->company_email; ?></td>

                        <td>
                          <?php if($list->company_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
<script type="text/javascript">
// Check Mobile Duplication..
  var company_mob11 = $('#company_mob1').val();
  $('#company_mob1').on('change',function(){
    var company_mob1 = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"company_mob1",
             "column_val":company_mob1,
             "table_name":"company"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#company_mob1').val(company_mob11);
          toastr.error(company_mob1+' Mobile No Exist.');
        }
      }
    });
  });

  var user_mobile1 = $('#user_mobile').val();
  $('#user_mobile').on('change',function(){
    var user_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"user_mobile",
             "column_val":user_mobile,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#user_mobile').val(user_mobile1);
          toastr.error(user_mobile+' Mobile No Exist.');
        }
      }
    });
  });
</script>

<script type="text/javascript">
  $("#country_id").on("change", function(){
    var country_id =  $('#country_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_state_by_country',
      type: 'POST',
      data: {"country_id":country_id},
      context: this,
      success: function(result){
        $('#state_id').html(result);
      }
    });
  });

  $("#state_id").on("change", function(){
    var state_id =  $('#state_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/get_city_by_state',
      type: 'POST',
      data: {"state_id":state_id},
      context: this,
      success: function(result){
        $('#city_id').html(result);
      }
    });
  });

  $('#company_logo, #company_fevicon').bind('change', function() {
    var size = this.files[0].size;
    var type = this.files[0].type;
    if(size > 561276){
      toastr.error('File size is must be less than 500kb');
      $(this).val('');
    }
    if(type != "image/jpeg" && type != "image/jpg" && type != "image/png"){
      toastr.error('Invalid File Type');
      $(this).val('');
    }
  });
</script>
