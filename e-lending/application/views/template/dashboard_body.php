            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><img src="assets/img/jikiapps.png" style="width: 12%; margin-top: 0%; margin-right: 1%;">e - L e n d i n g | Lending Manager App </h1>

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
                <!--===================================================-->
                <div id="page-content">
                
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

                            </div>                
                        </div>
                    </div>
                    
                    



                    
















                </div>
                <!--===================================================-->
                <!--End page content-->
                <hr style="background-color: #cccccc; height:1px;">
                <hr>
                <hr>

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
        