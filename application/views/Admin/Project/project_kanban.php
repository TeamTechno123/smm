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
            <h4>Projects Kanban Board</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="card card-default">
              <div class="card-header">
                Not Started
              </div>
              <?php if($project_not_started_list){ ?>
              <div class="card-body p-2">
                <?php foreach ($project_not_started_list as $list1) { ?>
                  <div class="card p-2 mt-3">
                    <p class="mb-1"><?php echo $list1->project_name; ?></p>
                    <p class="mb-0 text-secondary f-12">Completed <?php echo $list1->project_progress; ?>%</p>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $list1->project_progress; ?>%"></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-md">
            <div class="card card-default">
              <div class="card-header">
                In Process
              </div>
              <?php if($project_in_process_list){ ?>
              <div class="card-body p-2 ">
                <?php foreach ($project_in_process_list as $list1) { ?>
                  <div class="card p-2 mt-3">
                    <p class="mb-1"><?php echo $list1->project_name; ?></p>
                    <p class="mb-0 text-secondary f-12">Completed <?php echo $list1->project_progress; ?>%</p>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $list1->project_progress; ?>%"></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-md">
            <div class="card card-default">
              <div class="card-header">
                Completed
              </div>
              <?php if($project_complete_list){ ?>
              <div class="card-body p-2">
                <?php foreach ($project_complete_list as $list1) { ?>
                  <div class="card p-2 mt-3">
                    <p class="mb-1"><?php echo $list1->project_name; ?></p>
                    <p class="mb-0 text-secondary f-12">Completed <?php echo $list1->project_progress; ?>%</p>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $list1->project_progress; ?>%"></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-md">
            <div class="card card-default">
              <div class="card-header">
                Cancelled
              </div>
              <?php if($project_cancel_list){ ?>
              <div class="card-body p-2">
                <?php foreach ($project_cancel_list as $list1) { ?>
                  <div class="card p-2 mt-3">
                    <p class="mb-1"><?php echo $list1->project_name; ?></p>
                    <p class="mb-0 text-secondary f-12">Completed <?php echo $list1->project_progress; ?>%</p>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $list1->project_progress; ?>%"></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="col-md">
            <div class="card card-default">
              <div class="card-header">
                Hold
              </div>
              <?php if($project_hold_list){ ?>
              <div class="card-body p-2">
                <?php foreach ($project_hold_list as $list1) { ?>
                  <div class="card p-2 mt-3">
                    <p class="mb-1"><?php echo $list1->project_name; ?></p>
                    <p class="mb-0 text-secondary f-12">Completed <?php echo $list1->project_progress; ?>%</p>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $list1->project_progress; ?>%"></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>







        </div>
      </div>
    </section>
  </div>

</body>
</html>
