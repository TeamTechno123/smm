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
            <h4>Order Cancel Request List</h4>
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
                <h3 class="card-title">List All Order Cancel Request</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="wt_30">#</th>
                    <th class="wt_50">Order No</th>
                    <th class="wt_75">Date</th>
                    <th>Reseller</th>
                    <th>Package Name</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_50">Payment Status</th>
                    <!-- <th class="wt_50">View Invoice</th> -->
                    <!-- <th class="wt_50">Cancel Order</th> -->
                    <th class="wt_50">Request Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($order_cancel_list)){
                    $i=0; foreach ($order_cancel_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                      $invoice_info = $this->Master_Model->get_info_arr_fields3('invoice_id', '', 'order_id', $list->order_id, '', '', '', '', 'smm_invoice');
                      $order_date = strtotime($list->order_date);
                      $cancel_exp_date = strtotime("+7 day", $order_date);
                      $cancel_exp_date = date('d-m-Y', $cancel_exp_date);
                      $today = date('d-m-Y');
                    ?>
                      <tr>
                        <td class="wt_30"><?php echo $i; ?></td>
                        <td>ORD-00<?php echo $list->order_no; ?></td>
                        <td><?php echo $list->order_date; ?></td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php echo $list->package_name; ?></td>
                        <td><?php echo $list->order_net_amount; ?></td>
                        <!-- <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td> -->
                        <td>
                          <?php if($list->payment_status == 0){ echo '<span class="text-danger">UnPaid</span>'; }
                            else{ echo '<span class="text-success">Paid</span>'; } ?>
                        </td>
                        <td>
                        <?php  if ($list->order_status == '2') {
                          if($list->order_cancel_approve == '0'){ ?>
                            <input type="hidden" class="order_id" value="<?php echo $list->order_id; ?>">
                            <input type="hidden" class="order_no" value="<?php echo $list->order_no; ?>">
                            <button type="button" class="btn btn-outline-primary btn-xs cancel_order" data-toggle="modal" data-target="#modal_cancel_order">
                              Pending
                            </button>
                        <?php } else if($list->order_cancel_approve == '1'){
                            echo '<span class="text-success">Approved</span>';
                          } else if($list->order_cancel_approve == '2'){
                            echo '<span class="text-danger">Rejected</span>';
                          }
                        } ?>

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
  <div class="modal fade" id="modal_cancel_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Order Approval</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="<?php echo base_url(); ?>Transaction/cancel_order_approve" method="post">
          <label class="pl-4"></label>
          <div class="modal-body">
            <div class="form-input select_sm">
              <input type="hidden" id="order_id" name="order_id" value="">
              <label class="mb-2" for="">Order No. <span id="order_no"></span> </label>

              <label class="" for="">Order Cancel Status</label>
              <select class="form-control select2 form-control-sm" name="order_cancel_approve" data-placeholder="Select Status" required>
                <option value="">Select Status</option>
                <option value="1">Accept</option>
                <!-- <option value="2">Reject</option> -->
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).on('click','.cancel_order', function(){

      var order_id = $(this).closest('td').find('.order_id').val();
      var order_no = $(this).closest('td').find('.order_no').val();
      $('#order_id').val(order_id);
      $('#order_no').text('ORD-00'+order_no);
    });
  </script>
</body>
</html>
