<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Tax Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url('files/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('files/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('files/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('files/dist/css/AdminLTE.min.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body >
<div class="wrapper">
  <!-- Main content -->
  <div class="row">
    <p style="text-align:center; font-size:17px; margin-top: 3px; margin-bottom: 5px;text-transform: uppercase;"> <b>Tax Invoice</b>  </p>
  </div>
  <table class="table table-bordered mb-0 invoice-table" Width="100%">
    <style media="print">
    table{
      border-collapse: collapse;

    }
    table, td, th{
    border :1px solid #000;
    padding-left: 10px;

  }

      .invoice-table tr, td, th{
          border: 1px solid #000!important;
      }
      .invoice-table{
        margin-bottom:0px!important;
        border: 1px solid #000!important;
        padding-bottom:0px!important;
      }
      .invoice-table p{
        line-height: 15px;
      }
      .pull-right{
        float: right!important;
      }
      hr{
          border-top: 1px solid #000!important;
      }
      p{
        margin-top: 3px;
        margin-bottom: 5px;
      }
    </style>
    <style media="screen">
    table{
      border-collapse: collapse;
    }

      .invoice-table tr, td, th{
          border: 1px solid #000!important;
            padding-left: 10px;
      }
      .invoice-table{
        margin-bottom:0px!important;
        border: 1px solid #000!important;
        padding-bottom:0px!important;
      }
      .invoice-table p{
        line-height: 15px;
      }
      .pull-right{
        float: right!important;
      }
      hr{
          border-top: 1px solid #000!important;
      }
      p{
        margin-top: 3px;
        margin-bottom: 5px;
      }
    </style>
    <tr >

      <td   colspan="6" >

          <div class="" style="text-align:center;">
                          <h3 style="font-family: 'Arial Black', 'Arial Bold', Gadget, sans-serif; font-size:28px; font-weight:bold; text-transform:uppercase; margin-top:5px; margin-bottom:3px;" > SMM Resellor</h3>
                            <p style="margin-bottom:5px; line-height:20px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px; margin-top:5px;" > <b> Rajarampuri Kolhapur</p>
                            <p  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;">Mobile No: 9876543210 &nbsp; | &nbsp; Email : abc@gmail.com</p>
                            <p  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;"> GST No: ABCD1234FGHT &nbsp; | &nbsp; Website : www.abc.com </p>
        <!-- <p style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI';" >   </p> -->
            </div>
      </td>
    </tr>
    <tr>
      <td colspan="4" Width="60%" >
        <p>To</p>
        <p> <b>Swapnil Kamble</b>  </p>
        <p> <b>Address</b> : “Dhumal Niwas” Behind Kamla Nehru Hospital, Near Barne School,Pune</p>
      </td>
      <td colspan="2" Width="40%" valign="top">
        <p> <b>Invoice No</b> : 00001</p>
        <p> <b>Dated </b> : 12/03/2019</p>
        <p> <b>GSTIN</b> : 12345ASDF123 </p>
        <p><b>State Code</b> : 27 </p>
      </td>
    </tr>

  </table>

  <table class="table table-bordered invoice-tbl-2"  width="100%">
    <style media="print">
    /* @media print {
        table{
          margin: 0px;
        }
     } */
      .invoice-tbl-2{
      margin-top:0px;
      padding-top:0px;
      border-top:0px;
      border: 1px solid #000!important;
      border-top: 0px!important;
      margin-top: 0px!important;
      padding-top: 0px!important;
      vertical-align: top;
      }
      hr{
          border-top: 1px solid #000!important;
      }
        .invoice-tbl-2 tr, th, td{
          border: 1px solid #000!important;
          border-top: 0px!important;
        }
        .pull-right{
          float: right!important;
        }
    </style>
    <style media="screen">
    /* @media print {
        table{
          margin: 0px;
        }
     } */
      .invoice-tbl-2{
      margin-top:0px;
      padding-top:0px;
      border-top:0px;
      border: 1px solid #000!important;
      border-top: 0px!important;
      margin-top: 0px!important;
      padding-top: 0px!important;
      vertical-align: top;
      }
      hr{
          border-top: 1px solid #000!important;
      }
        .invoice-tbl-2 tr, th, td{
          border: 1px solid #000!important;
          border-top: 0px!important;
        }
        .pull-right{
          float: right!important;
        }
    </style>
    <tr>
      <th style="width: 10px; text-align:center;">Sr.No.</th>
      <th style="text-align:center;"> Item</th>
      <th style="text-align:center;">Tax Rate</th>
      <th style="text-align:center;" Width="9%" >QTY </th>
      <th style="text-align:center;" >Price</th>
      <th style="text-align:center;" >SUB TOTAL</th>
    </tr>
    <tr>
      <td style="text-align:center;">1</td>
      <td style="text-align:center;">abcd</td>
      <td style="text-align:center;" > 10</td>
      <td style="text-align:center;">1</td>
      <td style="text-align:center;">1500</td>
      <td style="text-align:center;">1550</td>
    </tr>
    <tr>
      <td colspan="4" rowspan=""></td>
      <td colspan="2" Width="40%" valign="top">
        <p><b>Total</b> : 1000</p> <hr style="margin-left:-10px;">
        <p><b>CGST 9% </b> : 100</p>  <hr style="margin-left:-10px;">
        <p><b>SGST 9%</b> : 100</p>  <hr style="margin-left:-10px;">
        <p><b>IGST 18%</b> : 200 </p>  <hr style="margin-left:-10px;">
        <p><b>Total Amount</b> : 1200 </p>
      </td>
    </tr>
    <tr>
      <td colspan="5">
          <p> <b>Bank Name</b> : &nbsp;ICICI Bank</p>
          <p> <b>Account No</b> : 645005002303 </p>
          <p> <b>IFSC Code </b>&nbsp; : ICIC0006450 </p>
          <p> <b>Declaration </b> : We declare that the invoice shows the actual price of the goods described and that all particulars are true and correct. </p>
      </td>
      <td colspan="1">
        <img src="<?php echo base_url() ?>assets/img/stamp.png" alt="">
      </td>
    </tr>



  </table>



  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url('files/bower_components/jquery/dist/jquery.min.js'); ?>"></script>

<script type="text/javascript">
  window.print();
</script>
</body>
</html>