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
                <!-- <ol class="breadcrumb">\

                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel" style="height: 800px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo $client->lname . ', ' . $client->fname ?></b></h3>
                        </div>
                        <br>
                        
                        <div class="form-body">
                        <div class="form-group">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                            
                            <label class="control-label col-md-3">ATM Bank: <h4><?php echo $this->atm->get_atm_name($client->atm_id) ?></h4></label>
                            <label class="control-label col-md-3">ATM Type: <h4><?php echo $client->atm_type ?></h4></label>

                            <label class="control-label col-md-3">ATM Pin: <h4><?php echo $client->pin ?></h4></label>

                            <label class="control-label col-md-3">Total Balance: <h4> ₱ <?php echo number_format($loan_balance, 2, '.', ',') ?></h4></label>

                        </div>
                        </div>

                        <br><br><br><br>



                        <hr style="background-color: #ccccff; height: 30px;">




<!-- ============================================================ LOAN HISTORY ==================================== -->
                        



                        <div class="panel-heading">
                            <h3 class="panel-title">Active Loans Information Table</h3>    
                        </div>

                        <div class="panel-body">
                            
                            <table id="client-portal-loans-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">Loan ID</th>
                                        <th>I.Amount</th>
                                        <th>I.Interest</th>
                                        <th>I.Total Due</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Total Paid</th>
                                        <th>Balance</th>
                                        <th>Total Loan</th>
                                        <th>Remarks</th>
                                        <th>Encoded</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- End Striped Table -->
                            <span>Legend: [ I - Initial | &nbsp; <i style = "color: #99ff99;" class="fa fa-square"></i> - New &nbsp; | &nbsp; <i style = "color: #ccff99;" class="fa fa-square"></i> - Ongoing &nbsp; ]</span>

                        </div>

                    </div>
                    <!--===================================================-->
                    
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

