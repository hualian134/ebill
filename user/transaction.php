<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/user.php'); 
    if ($logged==false) {
         header("Location:../index.php");
    }
?>

<style>
      /* Add some basic styling */
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
      }
      .voucher {
        border: 1px solid black;
        border-radius: 5px;
        padding: 20px;
        width: 500px;
        background-color: white;
        margin: 0 auto;
        margin-top: 2px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }
      .voucher h1 {
        text-align: center;
        color: #4a86e8;
      }
      .voucher p {
        margin-bottom: 10px;
      }
      .voucher table {
        width: 100%;
        margin-top: 20px;
      }
      .voucher th {
        text-align: right;
        padding-right: 10px;
        vertical-align: top;
        font-weight: normal;
      }
      .voucher td {
        text-align: left;
        padding-left: 10px;
        vertical-align: top;
      }
      .voucher-info {
        text-align: center;
        margin-top: 30px;
      }
    </style>
<body>

    <div id="wrapper">

       <?php 
            require_once("nav.php");
            require_once("sidebar.php");
        ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Transaction
                        </h1>
                        <ol class="breadcrumb">
                          <li>Transaction</li>
                          <li class="active">History</li>
                        </ol>
                        <!-- <h4>Transaction History</h4> -->
                       <!--  <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#history" data-toggle="pill">HISTORY</a>
                            </li>
                        </ul> -->
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Transaction No.</th>
                                        <th>Bill No</th>
                                        <th>Bill Date</th>
                                        <th>Amount</th>
                                        <!--<th>Dues (if any)</th>-->
                                        <!--<th>Final Amount Payed</th>-->
                                        <th>Transaction Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $id=$_SESSION['uid'];

                                            $user_detail=retrieve_user_details($id) ;
                                            $user=mysqli_fetch_assoc($user_detail);

                                    $query1 = "SELECT COUNT(*) FROM bill , transaction WHERE transaction.bid=bill.id AND bill.uid={$id}  ";
                                    $result1 = mysqli_query($con,$query1);
                                    $row1 = mysqli_fetch_row($result1);
                                    $numrows = $row1[0];
                                    include("paging1.php");

                                    
                                    $result = retrieve_transaction_history($_SESSION['uid'],$offset, $rowsperpage);
                                    while($row = mysqli_fetch_assoc($result)){
                                        
                                    ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    if($row['pdate']!=NULL) echo 'TRN_'.$row['id'] ;
                                                    else echo "-";
                                                 ?>
                                            </td>
                                            <!-- <?php echo $row['id'] ?></td> -->
                                            <td height="50">EBS_<?php echo $row['bid'];
                                            
                                            $billquery="SELECT * from bill Where id={$row['bid']}";
                                            $bill_detail =mysqli_query($con,$billquery);
                                            $bill=mysqli_fetch_array($bill_detail);?></td>
                                            
                                            <td height="50"><?php echo $row['bdate'] ?></td>
                                            <td><?php echo $row['amount'].' Ks' ?></td>

                                            <!--<td><?php echo $row['dues'].' Ks' ?></td>!-->
                                            <!--<td><?php echo $row['payable'].' Ks' ?></td>-->
                                            
                                            <!--<td>
                                                <?php 
                                                    if($row['pdate']!=NULL) echo $row['pdate'];
                                                    else echo "TRANSACTION PENDING";
                                                ?>
                                            </td>-->
                                            <td><button class="btn btn-primary form-control" data-toggle="modal"  data-target="#View_<?= $row['id']?>">View Detail</button>
                                                <div class="modal fade" id="View_<?= $row['id']?>" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h3 class="modal-title text-centre"><b>Bills Transaction</b></h3>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                              
                                                                <div class="voucher">
                                                                    <h1>Electricity Billing Voucher</h1>
                                                                    <p>Transaction No: <?php echo $row['id'] ?></p>
                                                                    <p>Customer Name: <?php echo $user['name']?></p>
                                                                    <p>Address: <?php echo $user['address']?></p>
                                                                    <table>
                                                                        <tr>
                                                                        <th>Current Unit:</th>
                                                                        <td><?php echo $bill['current_unit'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Previous Unit:</th>
                                                                        <td><?php echo $bill['previous_unit'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Consumed Unit:</th>
                                                                        <td><?php echo $bill['units'] ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <table>
                                                                        <tr>
                                                                        <th>Bill Amount:</th>
                                                                        <td><?php echo $row['amount'].' Ks' ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Due Date:</th>
                                                                        <td><?php echo $bill['ddate'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Pay Date:</th>
                                                                        <td><?php echo $row['pdate'] ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <div class="voucher-info">
                                                                        
                                                                        <p>Thank you for your business!</p>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php include("paging2.php");  ?>
                        </div>
                        <!-- .table-responsive -->
                    </div>
                    <!-- /.col-lg-12 -->                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-content-wrapper -->
        
        


    </div>
    <!-- /#wrapper -->

    <?php 
    require_once("footer.php");
    require_once("js.php");
    ?>
    
</body>

</html>
