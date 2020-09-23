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
            <h1>Timesheet Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Timesheet Summary</h4>
        <div class="row">

          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Attendance Status
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
                  Overtime Request Status
                </h3>
              </div>
              <div class="card-body">
                <canvas id="pie-chart2" width="800" height="450"></canvas>
              </div>
            </div>
          </div>

        </div>
        <hr>

      </div>
    </section>
  </div>

  <script type="text/javascript">
    new Chart(document.getElementById("pie-chart"), {
      type: 'pie',
      data: {
        labels: ["Absent", "Present"],
        datasets: [{
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2"],
          data: [2,7]
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
        labels: ["Approved", "Pending", "Rejected"],
        datasets: [{
          label: "Population (millions)",
          backgroundColor: ["green","orange","red"],
          data: [2,5,4]
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
