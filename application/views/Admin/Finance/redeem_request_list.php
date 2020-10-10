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
            <h4>Redeem Request List</h4>
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
                <h3 class="card-title">List All Redeem Request</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="wt_30">#</th>
                    <th class="wt_75">Date</th>
                    <th>Reseller</th>
                    <th class="wt_75">Balance Amount</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_50">Request Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($redeem_request_list)){
                    $i=0; foreach ($redeem_request_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->reseller_id, '', '', '', '', 'smm_reseller');

                    ?>
                      <tr>
                        <td class="wt_30"><?php echo $i; ?></td>
                        <td><?php echo $list->redeem_request_date; ?></td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php echo $list->redeem_request_outstanding_amt; ?></td>
                        <td><?php echo $list->redeem_request_amount; ?></td>

                        <td>
                          <?php
                            if($list->redeem_request_approve == '0'){ ?>
                              <input type="hidden" class="redeem_request_id" value="<?php echo $list->redeem_request_id; ?>">
                              <button type="button" class="btn btn-outline-primary btn-xs cancel_order" data-toggle="modal" data-target="#modal_cancel_order">
                                Pending
                              </button>
                          <?php } else if($list->redeem_request_approve == '1'){
                              echo '<span class="text-success">Approved</span>';
                            } else if($list->redeem_request_approve == '2'){
                              echo '<span class="text-danger">Rejected</span>';
                            }
                          ?>
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
        <form class="" action="<?php echo base_url(); ?>Finance/redeem_request_approve" method="post">
          <label class="pl-4"></label>
          <div class="modal-body">
            <div class="form-input select_sm">
              <input type="hidden" id="redeem_request_id" name="redeem_request_id" value="">
              <!-- <label class="mb-2" for="">Order No. <span id="order_no"></span> </label> -->

              <label class="" for="">Redeem Status</label>
              <select class="form-control select2 form-control-sm" name="redeem_request_approve" data-placeholder="Select Status" required>
                <option value="">Select Status</option>
                <option value="1">Accept</option>
                <option value="2">Reject</option>
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

      var redeem_request_id = $(this).closest('td').find('.redeem_request_id').val();
      // var order_no = $(this).closest('td').find('.order_no').val();
      $('#redeem_request_id').val(redeem_request_id);
      // $('#order_no').text('ORD-00'+order_no);
    });
  </script>
</body>
</html>
