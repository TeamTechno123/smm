<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1> Dashboard Information</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Project Summary</h4>
        <div class="row">
          <div class="col-md-3 col-6 px-0">
            <a href="<?php echo base_url(); ?>Project/project">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><b><?php echo $p_count; ?> Projects</b></span>
                <span class="info-box-number text-info f-12">Total Projects</span>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-3 col-6 px-0">
            <a href="<?php echo base_url(); ?>Project/project">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-warning"><b><?php echo $p_progress_count; ?> Projects</b></span>
                <span class="info-box-number text-warning f-12">In Progress</span>
              </div>
            </div>
          </a>
          </div>

          <div class="col-md-3 col-6 pr-0">
            <a href="<?php echo base_url(); ?>Project/project">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-success"><b><?php echo $p_complete_count; ?> Projects</b></span>
                <span class="info-box-number text-success f-12">Completed </span>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-3 col-6 pl-0">
            <a href="<?php echo base_url(); ?>Project/project">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-danger"><b><?php echo $p_cancel_count; ?> Projects</b></span>
                <span class="info-box-number text-danger f-12">Cancel</span>
              </div>
            </div>
          </div>
        </a>
        </div>
        <!-- project row end -->

          <h4 class="mb-3">Task Summary</h4>
          <div class="row">
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><b><?php echo $t_count; ?> Task</b></span>
                <span class="info-box-number text-info f-12">Total Task</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-warning"><b><?php echo $t_open_count; ?> Task</b></span>
                <span class="info-box-number text-warning f-12">Open Task</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6 pr-0">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-success"><b><?php echo $t_assign_count; ?> Task</b></span>
                <span class="info-box-number text-success f-12">Assigned Task </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 pl-0">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-danger"><b><?php echo $t_complete_count; ?> Task</b></span>
                <span class="info-box-number text-danger f-12">Completed Task</span>
              </div>
            </div>
          </div>

        </div>
        <!-- Task row end -->

          <h4 class="mb-3">Ticket Summary</h4>
          <div class="row">
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><b><?php echo $ticket_count; ?> Ticket</b></span>
                <span class="info-box-number text-info f-12">Total Ticket</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-warning"><b><?php echo $ticket_pending_count; ?> Ticket</b></span>
                <span class="info-box-number text-warning f-12">Pending Ticket</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6 pr-0">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-success"><b><?php echo $ticket_assign_count; ?> Ticket</b></span>
                <span class="info-box-number text-success f-12">Assigned Ticket </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 pl-0">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-danger"><b><?php echo $ticket_complete_count; ?> Ticket</b></span>
                <span class="info-box-number text-danger f-12">Completed Ticket</span>
              </div>
            </div>
          </div>


          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Projects Status
                </h3>
              </div>
              <div class="card-body">
                <canvas id="doughnut-chart" width="800" height="450"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Clients\Leads Status
                </h3>
              </div>
              <div class="card-body">
                <canvas id="doughnut-chart2" width="800" height="450"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Tasks Status
                </h3>
              </div>
              <div class="card-body">
                <canvas id="doughnut-chart3" width="800" height="450"></canvas>
              </div>
            </div>
          </div>

        </div>
        <hr>

      </div>
    </section>
  </div>

  <script type="text/javascript">
    new Chart(document.getElementById("doughnut-chart"), {
      type: 'doughnut',
      data: {
        labels: ["Pending", "Working", "Done"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
            data: [2,10,25]
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: ''
        }
      }
    });

    new Chart(document.getElementById("doughnut-chart2"), {
      type: 'doughnut',
      data: {
        labels: ["Clients", "Leads"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: ["green", "red"],
            data: [10,25]
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: ''
        }
      }
    });

    new Chart(document.getElementById("doughnut-chart3"), {
      type: 'doughnut',
      data: {
        labels: ["Pending", "Working", "Done"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: ["orange", "blue", "pink"],
            data: [2,10,25]
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: ''
        }
      }
    });
  </script>

</body>
</html>
