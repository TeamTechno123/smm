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
            <h4>Policy</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Policy</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Company/policy" type="button" class="btn btn-sm btn-primary" >Add New</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-12 ">
                        <label>Policy Title</label>
                        <input type="text" class="form-control form-control-sm" name="policy_name" id="policy_name" value="<?php if(isset($policy_info)){ echo $policy_info['policy_name']; } ?>" placeholder="Enter Policy Title" required>
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Discription</label>
                        <textarea class="textarea form-control form-control-sm" name="policy_desc" id="policy_desc" rows="3" required><?php if(isset($policy_info)){ echo $policy_info['policy_desc']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Policy Image</label>
                        <input type="file" class="form-control form-control-sm" name="policy_image" id="policy_image" >
                        <label>.jpg, .png, .jpeg image & size is less than 500kb</label>
                      </div>
                      <div class="form-group col-md-4">
                        <?php if(isset($policy_info) && $policy_info['policy_image']){ ?>
                          <img width="150px" src="<?php echo base_url() ?>assets/images/policy/<?php echo $policy_info['policy_image'];  ?>" alt="Slider Image">
                          <input type="hidden" name="old_policy_img" value="<?php echo $policy_info['policy_image']; ?>">
                        <?php } ?>
                      </div>
                      <!-- <div class="form-group col-md-4 ">
                        <label>Policy Time</label>
                        <input type="text" class="form-control form-control-sm" name="policy_time" value="<?php if(isset($policy_info)){ echo $policy_info['policy_time']; } ?>" id="time1" data-target="#time1" data-toggle="datetimepicker" placeholder="Enter Policy Time" required>
                      </div> -->

                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="policy_status" id="policy_status" value="0" <?php if(isset($policy_info) && $policy_info['policy_status'] == 0){ echo 'checked'; } ?>>
                            <label for="policy_status" class="custom-control-label">Disable This Policy</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Company/policy" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
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
              <div class="card-header">
                <h3 class="card-title">List All Policy Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Policy Title</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($policy_list)){
                      $i=0; foreach ($policy_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Company/edit_policy/<?php echo $list->policy_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Company/delete_policy/<?php echo $list->policy_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Policy Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->policy_name; ?></td>
                      <td class="text-center"><img width="50px" src="<?php echo base_url() ?>assets/images/policy/<?php echo $list->policy_image;  ?>" alt="Policy Image">
                      <td>
                        <?php if($list->policy_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
  $('#policy_image').bind('change', function() {
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
