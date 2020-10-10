<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Email Setting</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Email Setting</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'User/dashboard" type="button" class="btn btn-sm btn-outline-info">Cancel</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0 needs-validation" novalidate id="form_action" office_shift="form" action="" method="post">
                  <div class="row p-4">
                    <div class="form-group col-md-6">
                      <label>Mail Driver</label>
                      <div class="row">
                        <div class="custom-control custom-radio col-6">
                          <input class="custom-control-input" type="radio" id="mail_setting_type1" name="mail_setting_type" value="1" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_type'] == '1'){ echo 'checked'; } ?> >
                          <label for="mail_setting_type1" class="custom-control-label">Mail</label>
                        </div>
                        <div class="custom-control custom-radio col-6">
                          <input class="custom-control-input" type="radio" id="mail_setting_type2" name="mail_setting_type" value="2" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_type'] == '2'){ echo 'checked'; } ?>>
                          <label for="mail_setting_type2" class="custom-control-label">SMTP</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      </div>

                    <div class="form-group col-md-6">
                      <label>Mail Host</label>
                      <input type="text" class="form-control form-control-sm" name="mail_setting_host" id="mail_setting_host" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_host']; } ?>"  placeholder="eg. smtp.gmail.com" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail Port</label>
                      <input type="number" class="form-control form-control-sm" name="mail_setting_port" id="mail_setting_port" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_port']; } ?>"  placeholder="eg. 465" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail Username</label>
                      <input type="text" class="form-control form-control-sm" name="mail_setting_username" id="mail_setting_username" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_username']; } ?>"  placeholder="eg. myemail@gmail.com" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail Password</label>
                      <input type="password" class="form-control form-control-sm" name="mail_setting_password" id="mail_setting_password" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_password']; } ?>"  placeholder="" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail Encryption</label>
                      <select class="form-control form-control-sm" name="mail_setting_encryption" id="mail_setting_encryption">
                        <option value="0" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_encryption'] == '0'){ echo 'selected'; } ?>>none</option>
                        <option value="1" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_encryption'] == '1'){ echo 'selected'; } ?>>tls</option>
                        <option value="2" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_encryption'] == '2'){ echo 'selected'; } ?>>ssl</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail From Name</label>
                      <input type="text" class="form-control form-control-sm" name="mail_setting_from_name" id="mail_setting_from_name" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_from_name']; } ?>"  placeholder="" required >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mail From Email</label>
                      <input type="text" class="form-control form-control-sm" name="mail_setting_from_email" id="mail_setting_from_email" value="<?php if(isset($mail_setting_info)){ echo $mail_setting_info['mail_setting_from_email']; } ?>"  placeholder="" required >
                    </div>


                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="mail_setting_status" id="mail_setting_status" value="0" <?php if(isset($mail_setting_info) && $mail_setting_info['mail_setting_status'] == 0){ echo 'checked'; } ?>>
                          <label for="mail_setting_status" class="custom-control-label">Disable This Email Setting</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>User/dashboard" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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


          <!-- <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Email Setting</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Mail Driver</th>
                    <th class="wt_75">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($mail_setting_list)){
                       $i=0; foreach ($mail_setting_list as $list) { $i++;
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Company/edit_mail_setting/<?php echo $list->mail_setting_id; ?>" type="button" class="btn btn-sm btn-default"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Company/delete_mail_setting/<?php echo $list->mail_setting_id; ?>" type="button" class="btn btn-sm btn-default red-tooltip"  data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Delete this Email Setting');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->mail_setting_name; ?></td>
                        <td>
                          <?php if($list->mail_setting_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                            else{ echo '<span class="text-success">Active</span>'; } ?>
                        </td>
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> -->

        </div>
      </div>
    </section>
  </div>

</body>
</html>
