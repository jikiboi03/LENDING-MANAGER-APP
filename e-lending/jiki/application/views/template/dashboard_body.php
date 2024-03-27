<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow col-md-3">
            <br /><br />
            <i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard
        </h1>
        <h1 class="page-header text-overflow col-md-9" style="text-align: right; padding-right: 43px;">
            <img src="assets/img/jikiapps.png" style="height: 90px; margin-right: 20px;">
            <span class="bg-color-neumorph">e-Lending | Lending Manager App </span>
        </h1>
        <input type="hidden" id="schedules_today_str" value=<?php echo "'" . $schedules_today_str . "'"; ?> name="schedules_today_str"/>
        <input type="hidden" id="near_due_date_str" value=<?php echo "'" . $near_due_date_str . "'"; ?> name="near_due_date_str"/>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li class="active">Dashboard</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
    <!--Page content-->

    <!--===================================================-->
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <!--Tiles - Bright Version-->
        <!--===================================================-->

        <!--===================================================-->
        <!--End Tiles - Bright Version-->               
        <div class="row">
            <div class="col-lg-12">                  
                <div class="row">
                    <!--Large tile (Visit Today)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <div class="col-sm-6 col-md-3 dashboard-tablets">
                        <div class="panel panel-dark panel-colorful">
                            <div class="panel-body text-center dark-tablet-text">
                                <p class="text-uppercase mar-btm text-sm">Total Clients Registered</p>
                                <i class="fas fa-users fa-5x dark-tablet-text"></i>
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
                    <div class="col-sm-6 col-md-3 dashboard-tablets">
                        <div class="panel panel-danger panel-colorful">
                            <div class="panel-body text-center danger-tablet-text">
                                <p class="text-uppercase mar-btm text-sm">Total Cash Receivable</p>
                                <i class="fas fa-money-bill-wave fa-5x danger-tablet-text"></i>
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
                    <div class="col-sm-6 col-md-3 dashboard-tablets">
                        <div class="panel panel-warning panel-colorful">
                            <div class="panel-body text-center warning-tablet-text">
                                <p class="text-uppercase mar-btm text-sm">Total Interest / Net Profit</p>
                                <i class="fas fa-chart-line fa-5x warning-tablet-text"></i>
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
                    <div class="col-sm-6 col-md-3 dashboard-tablets">
                        <div class="panel panel-success panel-colorful">
                            <div class="panel-body text-center success-tablet-text">
                                <p class="text-uppercase mar-btm text-sm">Cleared Loan Transactions</p>
                                <i class="fas fa-check-circle fa-5x success-tablet-text"></i>
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
                    <div class="col-sm-6 col-md-6 dashboard-tablets">
                        <div class="panel panel-info panel-colorful">
                            <div class="panel-body text-center info-tablet-text">GROSS CAPITAL
                                <p class="h1 text-thin">
                                    <i class="fas fa-chart-bar fa-1x info-tablet-text"></i>
                                        ₱ <?php echo number_format($gross_capital, 2, '.', ','); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Large tile (New orders)-->

                    <!--Large tile (New orders)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="col-sm-6 col-md-6 dashboard-tablets">
                        <div class="panel panel-primary panel-colorful">
                            <div class="panel-body text-center primary-tablet-text">CASH ON HAND
                                <p class="h1 text-thin">
                                    <i class="fas fa-hand-sparkles fa-1x primary-tablet-text"></i>
                                        ₱ <?php echo number_format($cash_on_hand, 2, '.', ','); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Large tile (New orders)-->

                </div>                
            </div>
        </div>
    </div>

    <br><br>
    <div class="col-md-9"></div>
    <div class="col-md-3" style="padding-right: 43px;">
        <button class="control-label col-md-12 btn bg-color-neumorph" onclick="back_up_db()" style="font-size: 14px;">
            <i class="fa fa-database"></i> &nbsp;Backup Database
        </button>
    <br><br><br>
    </div>


    
</div>
<div class="col-md-9">
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->




