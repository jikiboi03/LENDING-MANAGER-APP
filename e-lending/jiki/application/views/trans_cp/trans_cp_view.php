<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title . ' &nbsp; ' . $client->lname . ', ' . $client->fname; ?></h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('client-portal-page/' . $client->client_id);?>">Client Portal</a></li>
        <li class="active">Loan Details</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
    <!--Page content-->
    <!--===================================================-->
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-passport"></i>&nbsp; 
                        Loan Details
                        <span style="float:right;">
                            <button type="button" class="btn btn-default" onclick="cancel_cp_trans()"><i class="fas fa-backspace"></i> &nbsp;
                                Back to Client Portal
                            </button>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">
                    <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                    <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/>
                    <div class="form-body">
                        <label class="control-label col-md-6">
                            Loan ID & status
                            <h3 style="color: darkblue;">
                                <i class="fas fa-money-check"></i>&nbsp; 
                                <?php echo 'L' . $loan->loan_id . ' | '; ?>
                                <?php if ($loan->status == 1){ echo '<b style="color:green;">NEW LOAN TRANSACTION</b>'; } 
                                        else if ($loan->status == 2){ echo '<b style="color:yellowgreen;">ONGOING LOAN TRANSACTION</b>'; } 
                                        else { echo '<b style="color:gray;">CLEARED LOAN TRANSACTION</b>'; }?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Total Paid
                            <h3 style="color: red;">
                                <i class="fas fa-money-check-alt"></i>&nbsp; ₱ <?php echo number_format($loan->paid, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Current balance
                            <h3 style="color: green;">
                                <i class="fas fa-money-check-alt"></i>&nbsp; ₱ <?php echo number_format($loan->balance, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <!-- ============================================================ LOAN HISTORY ==================================== -->
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Transaction Logs Table</h3>    
            </div>
            <div class="panel-body">
                <label class="control-label col-md-12">Scroll Right &nbsp;<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></label>
                <table id="client-portal-transactions-table" class="table display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width:60px;">Trans ID</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Interest</th>
                            <th>Balance</th>
                            <th>Remarks</th>
                            <th>Encoded</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
                <!-- End Striped Table -->
            </div>
            <div class="legend-container">
                <span class="bg-color-neumorph">
                    <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; Trans. start &nbsp; | &nbsp; 
                    <i style="color: #ccff99;" class="fa fa-square"></i>&nbsp; Paid partial &nbsp; | &nbsp; 
                    <i style="color: #cccccc;" class="fa fa-square"></i>&nbsp; Paid full &nbsp; | &nbsp; 
                    <i style="color: #99ffff;" class="fa fa-square"></i>&nbsp; Add interest &nbsp; | &nbsp; 
                    <i style="color: #99cccc;" class="fa fa-square"></i>&nbsp; Add amount &nbsp; | &nbsp; 
                    <i style="color: #ffcc99;" class="fa fa-square"></i>&nbsp; Discount amount
                </span>
            </div>
            <br />
        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
<input type="hidden" value="" name="trans_id"/>
<input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
<input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>