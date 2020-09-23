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
            <h4>Invoice Payment</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Invoice Payment Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Invoice #</th>
                    <th>Client</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">Amount</th>
                    <th>Payment Method</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <!-- <tbody>
                    <?php if(isset($expense_list)){
                     $i=0; foreach ($expense_list as $list) { $i++;
                       $expense_type_info = $this->Master_Model->get_info_arr_fields3('expense_type_name', '', 'expense_type_id', $list->expense_type_id, '', '', '', '', 'smm_expense_type');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-expense">
                          <a href="<?php echo base_url() ?>Finance/edit_expense/<?php echo $list->expense_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Finance/delete_expense/<?php echo $list->expense_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Invoice Payment Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->expense_name; ?></td>
                      <td><?php if($expense_type_info) { echo $expense_type_info[0]['expense_type_name']; } ?></td>
                      <td><?php echo $list->expense_amount; ?></td>
                      <td>
                        <?php if($list->expense_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td>
                    </tr>
                  <?php } } ?>
                  </tbody> -->
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
