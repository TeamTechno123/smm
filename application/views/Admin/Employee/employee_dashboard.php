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
        <h4 class="mb-3">Employee Summary</h4>
        <div class="row">
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Employees</span>
                <span class="info-box-number text-dark f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Total Salaries Paid</span>
                <span class="info-box-number text-dark f-18">20000</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="fas fa-trophy"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Awards</span>
                <span class="info-box-number text-dark f-18">20000</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Leave Request</span>
                <span class="info-box-number text-dark f-18">20000</span>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Office Shift
                </h3>
              </div>
              <div class="card-body">
                <canvas id="pie-chart" width="800" height="450"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Roles
                </h3>
              </div>
              <div class="card-body">
                <canvas id="pie-chart2" width="800" height="450"></canvas>
              </div>
            </div>
          </div>


          <div class="col-md-3 col-6 pr-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fa fa-times"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>20%</b></span>
                <span class="info-box-number text-secondary f-12">Employee Absent Today</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-check-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>70%</b></span>
                <span class="info-box-number text-secondary f-12">Employee Present Today</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fab fa-buffer"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>10%</b></span>
                <span class="info-box-number text-secondary f-12">Project Status</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 pl-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fas fa-database"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>10%</b></span>
                <span class="info-box-number text-secondary f-12">Task Status</span>
              </div>
            </div>
          </div>

        </div>
        <hr>

      </div>
    </section>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    new Chart(document.getElementById("pie-chart"), {
      type: 'pie',
      data: {
        labels: ["Morning", "General", "Night"],
        datasets: [{
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2", "pink"],
          data: [2,7,3]
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Attendance Status'
        }
      }
    });

    new Chart(document.getElementById("pie-chart2"), {
      type: 'pie',
      data: {
        labels: ["Admin", "User"],
        datasets: [{
          label: "Population (millions)",
          backgroundColor: ["green","orange"],
          data: [1,5]
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Overtime Request Status'
        }
      }
    });
  </script>
</body>
</html>
