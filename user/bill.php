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
        margin-top: 50px;
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
                            Bills
                        </h1>

                        <!-- Pills Tabbed HISTORY | DUE -->
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#history" data-toggle="pill">History</a>
                            </li>
                            <li class=""><a href="#due" data-toggle="pill">Due</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="history">
                                <!-- <h4>{User} Bills(ALL UP TO DATE) goes here{Table form}</h4> -->
                                <!-- DB RETRIEVAL search db where id is his and status is processed -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Bill No.</th>
                                                <th>Bill Date</th>
                                                <th>Previous unit</th>
                                                <th>Current unit</th>
                                                <th>UNITS Consumed</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $id=$_SESSION['uid'];
                                            $query1 = "SELECT COUNT(*) FROM bill where uid={$id}";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging1.php");

                                            $result = retrieve_bills_history($_SESSION['uid'],$offset, $rowsperpage);
                                            // Initialising #
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td height="50"><?php echo 'EBS_'.$row['id'] ?></td>
                                                    <td height="50"><?php echo $row['bdate'] ?></td>
                                                    <td><?php echo $row['previous_unit'] ?></td>
                                                    <td><?php echo $row['current_unit'] ?></td>
                                                    <td><?php echo $row['units'] ?></td>
                                                    <td><?php echo $row['amount'].' Ks' ?></td>
                                                    <td><?php echo $row['ddate'] ?></td>
                                                    <td><?php if($row['status'] == 'PENDING') { echo'<span class="badge" style="background: red;">'.$row["status"].'</span>'; } else { echo'<span class="badge" style="background: green;">'.$row["status"].'</span>';} ?></td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>     
                                    <?php include("paging2.php");  ?>                     
                                </div>
                                <!-- .table-responsive -->
                            </div>
                            <div class="tab-pane fade" id="due">
                                <!-- <h4>{User} due bill info goes here and each linked to a transaction form </h4> -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>Bill Date</th>
                                                <th>Previous unit</th>
                                                <th>Current unit</th>
                                                <th>UNITS Consumed</th>
                                                <th>Due Date</th>
                                                <th>Amount</th>
                                                <!--<th>DUES</th>-->
                                                <!--<th>Payable</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            $id=$_SESSION['uid'];
                                            $user_detail=retrieve_user_details($id);
                                            $user=mysqli_fetch_array($user_detail);

                                            $query1 = "SELECT COUNT(*) FROM bill where uid={$id} AND status='PENDING' ";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging1.php");

                                            

                                            $result = retrieve_bills_due($_SESSION['uid'],$offset, $rowsperpage);
                                            // Initialising #
                                            $counter = 1;
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <tr>
                                                <form action="transact_bill.php" method="post">
                                                    <!-- <td height="40"><?php echo $counter ?></td> -->

                                                    <input type="hidden" name="bdate" value=<?php echo $row['bdate'] ?> >
                                                    <td td height="50"><?php echo $row['bdate'] ?></td>

                                                    <input type="hidden" name="punit" value=<?php echo $punit=$row['previous_unit'] ?> >
                                                    <td><?php echo $row['previous_unit'] ?></td>

                                                    <input type="hidden" name="cunit" value=<?php echo $row['current_unit'] ?> >
                                                    <td><?php echo $row['current_unit'] ?></td>

                                                    <input type="hidden" name="units" value=<?php echo $row['units'] ?> >
                                                    <td><?php echo $row['units'] ?></td>

                                                    <input type="hidden" name="ddate" value=<?php echo $row['ddate'] ?> >
                                                    <td><?php echo $row['ddate'] ?></td>

                                                    <input type="hidden" name="amount" value=<?php echo $row['amount'] ?> >
                                                    <td><?php echo $row['amount'].' Ks' ?></td>

                                                    <!-- <input type="hidden" name="" value=<?php echo $row[''] ?> > -->
                                                    <!--<td><?php echo $row['dues'].' Ks' ?></td>-->

                                                    <input type="hidden" name="payable" value=<?php echo $row['payable'] ?>>
                                                    <!--<td><?php echo $row['payable'].' Ks' ?></td>-->

                                                    <td>
                                                    <button class="btn btn-success form-control" data-toggle="modal"  data-target="#PAY_<?= $row['id']?>">PAY</button>
                                                    <!--TRANSACT BILL MODAL -->
                                                    <div class="modal fade" id="PAY_<?= $row['id']?>" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h3 class="modal-title text-centre"><b>Bills Transaction</b></h3>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                <div class="voucher">
                                                                    <h1>Electricity Billing Voucher</h1>
                                                                    <!--<p>Transaction No: 123456789</p>-->
                                                                    <p>Customer Name: <?php echo $user['name']?></p>
                                                                    <p>Address: <?php echo $user['address']?></p>
                                                                    <table>
                                                                        <tr>
                                                                        <th>Current Unit:</th>
                                                                        <td><?php echo $row['current_unit'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Previous Unit:</th>
                                                                        <td><?php echo $punit ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Consumed Unit:</th>
                                                                        <td><?php echo $row['units'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>One Unit:</th>
                                                                        <td><?php echo $row['units'] ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <table>
                                                                        <tr>
                                                                        <th>Bill Amount:</th>
                                                                        <td><?php echo $row['amount'].' Ks' ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <th>Due Date:</th>
                                                                        <td><?php echo $row['ddate'] ?></td>
                                                                        </tr>
                                                                    </table>
                                                                    <div class="voucher-info">
                                                                        <p>Please pay by this date to avoid any late fees.</p>
                                                                        <p>Thank you for your business!</p>
                                                                    </div>
                                                                    </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">LATER</button>
                                                                        <button type="submit" id="pay_bill" name="pay_bill" class="btn btn-success ">PAY</button>
                                                    </form> 
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                </td>
                                                </tr>
                                            <?php 
                                                $counter=$counter+1;
                                            }
                                            ?>
                                        </tbody>

                                    </table>

                                <?php include("paging2.php");  ?>

                                </div><!-- ./table-responsive -->

                            </div> <!-- .tab-pane -->
                           
                        </div><!-- .tab-content -->

                    </div><!-- /.col-lg-12 -->
                    
                </div> <!-- /.row -->
               
            </div><!-- /.container-fluid -->
            

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
