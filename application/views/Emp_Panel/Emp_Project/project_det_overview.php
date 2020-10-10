<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Overview</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
           <?php include('project_det_menu.php'); ?>
        </div>
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">  Overview</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body p-0" >
              <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                <div class="row p-4">
                  <?php
                  $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                  ?>
                  <div class="col-md-8">
                    <div class="card p-4">
                      <span>
                        <?php echo $project_info['project_descr']; ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <?php include('project_det_side_info.php'); ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</body>
</html>
