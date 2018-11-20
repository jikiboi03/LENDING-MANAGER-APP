            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><img src="assets/img/jikiapps.png" style="width: 10%; margin-top: 0%; margin-right: 1%;"> [ e-Lending ] Lending Manager App </h1>

                    <!-- For alert and notifications assets/js/demo/nifty-demo.js-->

                    <input type="hidden" value=<?php echo "'" . $this->session->userdata('firstname').' '.$this->session->userdata('lastname') . "'"; ?> name="user_fullname"/>

                    <input type="hidden" value=<?php echo "'" . date('l, F j, Y', strtotime(date('Y-m-d'))) . "'"; ?> name="current_date"/>


                    <input type="hidden" id="schedules_today_str" value=<?php echo "'" . $schedules_today_str . "'"; ?> name="schedules_today_str"/>               

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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <hr>

                <!--===================================================-->
                <div id="page-content" style="background-color: white">
                
                    <!--Tiles - Bright Version-->
                    <!--===================================================-->

                    <!--===================================================-->
                    <!--End Tiles - Bright Version-->               
                    <div class="row">
                        <div class="col-lg-12">                  
                            <div class="row">
                                <!--Large tile (Visit Today)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                 <div class="col-sm-6 col-md-3">
                                    <div class="panel panel-dark panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Clients Registered / Both Active or Inactive</p>
                                            <i class="fa fa-users fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin">
                                            <?php echo $clients_count; ?>     
                                            </p>
                                            <small><span class="text-semibold" style="font-size: 11px;">With Ongoing Transactions: [ <?php echo $has_active_trans; ?> ]<br><br></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End large tile (Visit Today)-->

                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-3">
                                    <div class="panel panel-danger panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Cash Receivable / Loan Balances</p>
                                            <i class="fa fa-money fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin">₱ <?php echo number_format($total_balance, 2, '.', ','); ?> </p>
                                            <small><span class="text-semibold" style="font-size: 11px;">Total Paid: [ ₱ <?php echo number_format($total_paid, 2, '.', ','); ?> ]<br><br></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                                <!--Large tile (Comments)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-3">
                                    <div class="panel panel-warning panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Loan Interests / Business Net Profit</p>
                                            <i class="fa fa-percent fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin">₱ <?php echo number_format($total_interests, 2, '.', ','); ?> </p>
                                            <small><span class="text-bold" style="font-size: 11px;">Total Loaned Amount: [ ₱ <?php echo number_format($total_loans, 2, '.', ','); ?> ]<br><br></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--Large tile (Comments)-->

                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-3">
                                    <div class="panel panel-success panel-colorful">
                                        <div class="panel-body text-center">
                                            <p class="text-uppercase mar-btm text-sm">Total Cleared Loan Status / Paid Loan Transactions</p>
                                            <i class="fa fa-check fa-5x"></i>
                                            <hr>
                                            <p class="h1 text-thin"><?php echo $loans_cleared; ?> of <?php echo $loans_count; ?></p>
                                            <small><span class="text-semibold" style="font-size: 11px;">Ongoing Loan Transactions: [ <?php echo ($loans_count - $loans_cleared) ; ?> ]<br><br></small>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-6">
                                    <div class="panel panel-info panel-colorful">
                                        <div class="panel-body text-center">GROSS CAPITAL
                                            <p class="h1 text-thin"><i class="fa fa-signal fa-1x"></i> ₱ <?php echo number_format($gross_capital, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                                <!--Large tile (New orders)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="col-sm-6 col-md-6">
                                    <div class="panel panel-primary panel-colorful">
                                        <div class="panel-body text-center">CASH ON HAND
                                            <p class="h1 text-thin"><i class="fa fa-hand-paper-o fa-1x"></i> ₱ <?php echo number_format($cash_on_hand, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End Large tile (New orders)-->

                            </div>                
                        </div>
                    </div>
                    
                    

                    


                    
                    
















                </div>
                <!--===================================================-->
                <!--End page content-->
                <hr>

                <div class="col-md-9"></div>
                <div class="col-md-3"><button class="control-label col-md-12 btn btn-default" onclick="back_up_db()" style="font-size: 14px;"><i class="fa fa-database"></i> &nbsp;Backup Database</button><hr>
                <br><br><br><br><br><br> 
                </div>


                
            </div>
            <div class="col-md-9">
            </div>
            <div class="col-md-3">
                eLending - Lending Manager App Vv1.1 JikiApps Solutions / Jik Torres © 2018
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->



            
        