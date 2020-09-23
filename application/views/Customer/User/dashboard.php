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
              <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Paid Invoices</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Unpaid Invoices</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Completed Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">In Progress Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Paid Amount</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Due Amount</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Not Started Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Deferred Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Projects</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Project Summary</th>
                      <th>Priority</th>
                      <th>End Date</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Update software</td>
                      <td><span class="badge bg-success">High</span></td>
                      <td>09-09-2020</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">My Projects</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Invoices</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Invoice#</th>
                      <th>Project</th>
                      <th>Total</th>
                      <th>Invoice Date</th>
                      <th>Due Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Update software</td>
                      <td>25000</td>
                      <td>10-09-2020</td>
                      <td>19-10-2020</td>
                      <td><span class="badge bg-success">High</span></td>
                    </tr>
                  </tbody>
                </table>
                <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">All Invoices</button>
              </div>
            </div>
          </div>

        </div>


      </div>
    </section>
  </div>

</body>
</html>
