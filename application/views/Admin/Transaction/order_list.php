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
            <h4>Order List</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Order</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="wt_30">#</th>
                    <th class="wt_50">Order No</th>
                    <th class="wt_50">Invoice No</th>
                    <th class="wt_50">Date</th>
                    <th>Reseller(Client)</th>
                    <th>Referral Reseller</th>
                    <th>Package Name</th>
                    <th class="wt_50">Amount</th>
                    <th class="wt_50">Payment Status</th>
                    <th class="wt_50">Create Project</th>
                    <!-- <th class="wt_50">Cancel Order</th> -->
                    <!-- <th>Client</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($order_list)){
                    $i=0; foreach ($order_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                      $reseller_info2 = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->reseller_id, '', '', '', '', 'smm_reseller');
                      $invoice_info = $this->Master_Model->get_info_arr_fields3('invoice_id, invoice_no, invoice_no_prefix', '', 'order_id', $list->order_id, '', '', '', '', 'smm_invoice');
                      $order_date = strtotime($list->order_date);
                      $cancel_exp_date = strtotime("+7 day", $order_date);
                      $cancel_exp_date = date('d-m-Y', $cancel_exp_date);
                      $today = date('d-m-Y');
                    ?>
                      <tr>
                        <td class="wt_30"><?php echo $i; ?></td>
                        <td>ORD-00<?php echo $list->order_no; ?></td>
                        <td><?php if($invoice_info){ echo $invoice_info[0]['invoice_no_prefix'].''.$invoice_info[0]['invoice_no']; } ?></td>
                        <td><?php echo $list->order_date; ?></td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php if($reseller_info2){ echo $reseller_info2[0]['reseller_name']; }
                        elseif ($list->reseller_id == '0') { echo 'Admin'; } ?></td>
                        <td><?php echo $list->package_name; ?></td>
                        <td><?php echo $list->order_net_amount; ?></td>
                        <td>
                          <?php if($list->payment_status == 0){ echo '<span class="text-danger">UnPaid</span>'; }
                            else{ echo '<span class="text-success">Paid</span>'; } ?>
                        </td>
                        <td>
                          <?php if($list->project_id == 0){ ?>
                            <a href="<?php echo base_url(); ?>Project/project/<?php echo $list->order_id; ?>">Create</a>
                          <?php } else{ ?>
                            <a class="text-success" href="<?php echo base_url() ?>Project/set_project_session/<?php echo $list->project_id; ?>">Project</a>
                          <?php } ?>

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

  <!-- Modal -->
  <!-- <div class="modal fade" id="modal_cancel_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="<?php echo base_url(); ?>Reseller/Res_Invoice/order_cancel" method="post">
          <label class="pl-4">Do you want to camcel this order.</label>
          <div class="modal-body">
            <div class="form-input">
              <input type="hidden" id="order_id" name="order_id" value="">
              <label for="">Order No. <span id="order_no"></span> </label>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->

  <!-- <script type="text/javascript">
    $(document).on('click','.cancel_order', function(){

      var order_id = $(this).closest('td').find('.order_id').val();
      var order_no = $(this).closest('td').find('.order_no').val();
      $('#order_id').val(order_id);
      $('#order_no').text(order_no);
    });
  </script> -->
</body>
</html>
