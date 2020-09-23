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
            <h4>Client</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Client</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="<?php base_url(); ?>Project/client" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-6 select_sm">
                      <label>Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" data-placeholder="Select Branch" required>
                        <option value="">Select Branch</option>
                        <?php if(isset($branch_list)){ foreach ($branch_list as $list) { ?>
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($client_info) && $client_info['branch_id'] == $list->branch_id){ echo 'selected'; } if($list->branch_status == 0){ echo 'disabled'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Name of Client/Company</label>
                      <input type="text" class="form-control form-control-sm" name="client_name" id="client_name" value="<?php if(isset($client_info)){ echo $client_info['client_name']; } ?>"  placeholder="Enter Name of Client/Company" required >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" rows="3" name="client_address" id="client_address" placeholder="Enter Company Address" required><?php if(isset($client_info)){ echo $client_info['client_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($client_info) && $client_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($client_info) && $client_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($client_info) && $client_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Pincode/Zipcode</label>
                      <input type="number" min="111111" max="999999" step="1" class="form-control form-control-sm" name="client_pincode" id="client_pincode" value="<?php if(isset($client_info)){ echo $client_info['client_pincode']; } ?>" placeholder="Enter Pincode/Zipcode" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label>Mobile No. 1</label>
                      <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="client_mobile" id="client_mobile" value="<?php if(isset($client_info)){ echo $client_info['client_mobile']; } ?>" placeholder="Enter Mobile No. 1" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mobile No. 2 / Landline No.</label>
                      <input type="number" min="5000000000" step="1" class="form-control form-control-sm" name="client_mobile2" id="client_mobile2" value="<?php if(isset($client_info)){ echo $client_info['client_mobile2']; } ?>" placeholder="Enter Mobile No. 2">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="client_email" id="client_email" value="<?php if(isset($client_info)){ echo $client_info['client_email']; } ?>" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website</label>
                      <input type="text" class="form-control form-control-sm" name="client_website" id="client_website" value="<?php if(isset($client_info)){ echo $client_info['client_website']; } ?>" placeholder="Website">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Client Password</label>
                      <input type="password" class="form-control form-control-sm" name="client_password" id="client_password" value="<?php if(isset($client_info)){ echo $client_info['client_password']; } ?>" placeholder="Enter Client Password" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Client Confirm Password</label>
                      <input type="password" class="form-control form-control-sm" id="client_c_password" value="<?php if(isset($client_info)){ echo $client_info['client_password']; } ?>" placeholder="Enter Client Password" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>GST No.</label>
                      <input type="text" class="form-control form-control-sm" name="client_gst_no" id="client_gst_no" value="<?php if(isset($client_info)){ echo $client_info['client_gst_no']; } ?>" placeholder="GST No.">
                    </div>
                    <div class="form-group col-md-6">
                      <label>PAN No.</label>
                      <input type="text" class="form-control form-control-sm" name="client_pan_no" id="client_pan_no" value="<?php if(isset($client_info)){ echo $client_info['client_pan_no']; } ?>" placeholder="Pan No.">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Opening Balance</label>
                      <input type="number" class="form-control form-control-sm" name="client_op_crd_balance" id="client_op_crd_balance" value="<?php if(isset($client_info)){ echo $client_info['client_op_crd_balance']; } ?>" placeholder="Enter Opening Balance">
                    </div>
                    <div class="form-group col-md-6">
                    </div>

                    <div class="form-group col-md-4">
                      <label>Client Image</label>
                      <input type="file" class="form-control form-control-sm" name="client_logo" id="client_logo">
                      <label>Select .jpg/.png/.jpeg file. size is less than 500kb</label>
                    </div>
                    <div class="form-group col-md-4">
                      <?php if(isset($client_info) && $client_info['client_logo']){ ?>
                        <input type="hidden" name="old_client_logo" value="<?php echo $client_info['client_logo']; ?>">
                        <img width="150px" src="<?php echo base_url(); ?>assets/images/client/<?php echo $client_info['client_logo']; ?>" alt="">
                      <?php } ?>
                    </div>

                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="client_status" id="client_status" value="0" <?php if(isset($client_info) && $client_info['client_status'] == 0){ echo 'checked'; } ?>>
                          <label for="client_status" class="custom-control-label">Disable This Client</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Project/client" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Client</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Client Name</th>
                    <th class="wt_75">Mobile No.</th>
                    <th class="wt_125">Email</th>
                    <th class="wt_100">City</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($client_list)){
                      $i=0; foreach ($client_list as $list) { $i++;
                        $city_info = $this->Master_Model->get_info_arr_fields3('city_name', '', 'city_id', $list->city_id, '', '', '', '', 'city');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Project/edit_client/<?php echo $list->client_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Project/delete_client/<?php echo $list->client_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Client');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->client_name; ?></td>
                        <td><?php echo $list->client_mobile; ?></td>
                        <td><?php echo $list->client_email; ?></td>
                        <td><?php if($city_info){ echo $city_info[0]['city_name']; } ?></td>
                        <td><img width="50px" src="<?php echo base_url() ?>assets/images/client/<?php echo $list->client_logo;  ?>" alt="Group Image">
                        <td>
                          <?php if($list->client_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
  var client_mobile1 = $('#client_mobile').val();
  $('#client_mobile').on('change',function(){
    var client_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"client_mobile",
             "column_val":client_mobile,
             "table_name":"smm_client"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#client_mobile').val(client_mobile1);
          toastr.error(client_mobile+' Mobile No Exist.');
        }
      }
    });
  });

  // Check Email Duplication..
  var client_email1 = $('#client_email').val();
  $('#client_email').on('change',function(){
    var client_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"client_email",
             "column_val":client_email,
             "table_name":"smm_client"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#client_email').val(client_email1);
          toastr.error(client_email+' Email No Exist.');
        }
      }
    });
  });

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

  $('#client_password, #client_c_password').on('change',function(){
    var client_password = $('#client_password').val();
    var client_c_password = $('#client_c_password').val();
    if(client_password != client_c_password){
      toastr.error('Password and Confirm Password must be same');
      $('#client_c_password').val('');
    }
  });
</script>
