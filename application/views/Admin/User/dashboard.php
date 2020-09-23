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
        <h4 class="mb-3">Master Summary</h4>
        <div class="row">
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Employees</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Total Expenses</span>
                <span class="info-box-number text-primary f-18">20000</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Total Expenses</span>
                <span class="info-box-number text-primary f-18">20000</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Total Expenses</span>
                <span class="info-box-number text-primary f-18">20000</span>
              </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Payroll
                </h3>
              </div>
              <div class="card-body">
                <canvas id="line-chart" width="800" height="350"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Employees Department
                </h3>
              </div>
              <div class="card-body">
                <canvas id="doughnut-chart" width="800" height="450"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Employees Designation
                </h3>
              </div>
              <div class="card-body">
                <canvas id="pie-chart" width="800" height="450"></canvas>
              </div>
            </div>
          </div>




          <div class="col-md-3 col-6 pr-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>10 Projects</b></span>
                <span class="info-box-number text-secondary f-12">Completed</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>10 Task</b></span>
                <span class="info-box-number text-secondary f-12">Completed</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 px-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>2563 </b></span>
                <span class="info-box-number text-secondary f-12">Total Deposit</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 pl-0">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-dark"><b>1000 </b></span>
                <span class="info-box-number text-secondary f-12">Invoice Payment</span>
              </div>
            </div>
          </div>

        </div>
        <hr>

      </div>
    </section>
  </div>

  <script type="text/javascript">
  new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
      labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
      datasets: [
        // {
        //   data: [86,114,106,106,107,111,133,221,783,2478],
        //   label: "Africa",
        //   borderColor: "#3e95cd",
        //   fill: false
        // }, {
        //   data: [282,350,411,502,635,809,947,1402,3700,5267],
        //   label: "Asia",
        //   borderColor: "#8e5ea2",
        //   fill: false
        // }, {
        //   data: [168,170,178,190,203,276,408,547,675,734],
        //   label: "Europe",
        //   borderColor: "#3cba9f",
        //   fill: false
        // }, {
        //   data: [40,20,10,16,24,38,74,167,508,784],
        //   label: "Latin America",
        //   borderColor: "#e8c3b9",
        //   fill: false
        // }, {
        //   data: [6,3,2,2,7,26,82,172,312,433],
        //   label: "North America",
        //   borderColor: "#c45850",
        //   fill: false
        // }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Payroll'
      }
    }
  });

    new Chart(document.getElementById("doughnut-chart"), {
      type: 'doughnut',
      data: {
        labels: ["Accounts and Finances", "Marketing"],
        datasets: [
          {
            label: "Population (millions)",
            backgroundColor: ["#3e95cd", "#8e5ea2"],
            data: [2,10]
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Employees Department'
        }
      }
    });

      new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
          labels: ["Finance", "Developer"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#3cba9f","#e8c3b9"],
            data: [5,25]
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Employees Designation'
          }
        }
    });
  </script>

</body>
</html>
