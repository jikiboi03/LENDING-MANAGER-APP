            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?php echo $title; ?></h1>

                    <!--Searchbox-->
                    <!-- <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div> -->
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- <ol class="breadcrumb">
                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel" style="height: 1000px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo 'L' . $loan->loan_id ?></b></h3>
                        </div>
                        <br>

                        

                        <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                        <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/>
                        <div class="col-md-12">
                            <div class="form-body">
                                <div class="form-group">

                                    <label class="control-label col-md-9">Client: <h4><?php echo $client->lname . ', ' . $client->fname ?></h4></label>

                                    <div align="right" class="col-md-3">
                                        
                                        <button type="button" class="btn btn-danger"  onclick="cancel_cp_trans()"><i class="fa fa-times"></i> &nbsp;Back to Portal</button>
                                    </div>
                                    <div class="col-md-12"><hr></div>             

                                    <label class="control-label col-md-6">Loan Status: <h4><?php if ($loan->status == 1){ echo '<b style="color:green;">NEW LOAN TRANSACTION</b>'; } else if ($loan->status == 2){ echo '<b style="color:orange;">ONGOING LOAN TRANSACTION</b>'; } else { echo '<b style="color:gray;">CLEARED LOAN TRANSACTION</b>'; }?></h4></label>

                                    <label class="control-label col-md-3">Total Paid: <h4>₱ <?php echo number_format($loan->paid, 2, '.', ','); ?></h4></label>
                                    <label class="control-label col-md-3">Total Balance: <h4>₱ <?php echo number_format($loan->balance, 2, '.', ','); ?></h4></label>
                                    
                                </div>   
                            </div>
                        </div>
                        <div class="col-md-12"> <hr style="background-color: lightgray; height: 2px;"></div>




<!-- ============================================================ LOAN HISTORY ==================================== -->
                        

                        <div class="panel col-md-12">

                            <div class="panel-body">
                                <table id="client-portal-transactions-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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

                                <!-- End Striped Table -->
                                <span>Legend: [ &nbsp; <i style = "color: #99ff99;" class="fa fa-square"></i> - Trans. Start &nbsp; | &nbsp; <i style = "color: #ccff99;" class="fa fa-square"></i> - Paid Partial &nbsp; | &nbsp; <i style = "color: #cccccc;" class="fa fa-square"></i> - Paid Full &nbsp; | &nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Add Interest &nbsp; | &nbsp; <i style = "color: #99cccc;" class="fa fa-square"></i> - Add Amount &nbsp; | &nbsp; <i style = "color: #ffcc99;" class="fa fa-square"></i> - Discount Amount &nbsp; ]</span>
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