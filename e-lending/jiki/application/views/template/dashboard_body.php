<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow col-md-4">
            <i class="fas fa-tachometer-alt"></i>&nbsp; Welcome <?php echo $this->session->userdata('username') ?>
        </h1>
        <input type="hidden" id="schedules_today_str" value=<?php echo "'" . $schedules_today_str . "'"; ?> name="schedules_today_str" />
        <input type="hidden" id="near_due_date_str" value=<?php echo "'" . $near_due_date_str . "'"; ?> name="near_due_date_str" />
    </div>
    <ol class="breadcrumb">
        <li class="active">Dashboard</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <!--Tiles - Bright Version-->
        <!--===================================================-->

        <!--===================================================-->
        <!--End Tiles - Bright Version-->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-sm-6 col-md-6 dashboard-tablets short-tablet">
                            <div class="panel panel-forest panel-colorful">
                                <div class="panel-zero text-center forest-tablet-text">
                                    <p class="text-uppercase mar-btm text-sm">Lending Manager App</p>
                                    <img src="assets/img/logo25.png" style="height: 90px;">
                                    <p class="h2 text-thin">
                                        e-Lending
                                    </p>
                                    <small><span class="text-semibold" style="font-size: 11px;">JikiApps Solutions LLC<br><br></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 dashboard-tablets short-tablet">
                            <div class="panel panel-dark panel-colorful">
                                <div class="panel-zero text-center dark-tablet-text">
                                    <p class="text-uppercase mar-btm text-sm">Clients Registered</p>
                                    <i class="fas fa-users fa-5x dark-tablet-text"></i>
                                    <hr>
                                    <p class="h2 text-thin">
                                        <?php echo $clients_count; ?>
                                    </p>
                                    <small><span class="text-semibold" style="font-size: 11px;">Active [ <?php echo $has_active_trans; ?> ]<br><br></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-sm-6 col-md-12 dashboard-tablets long-tablet">
                            <div class="panel panel-info panel-colorful">
                                <div class="panel-zero text-center text-sm danger-tablet-text">CASH RECEIVABLE ( Total Paid: ₱ <?php echo number_format($total_paid, 2, '.', ','); ?> )
                                    <p class="h2 text-thin">
                                        <i class="fas fa-money-bill-wave fa-1x danger-tablet-text"></i>
                                        ₱ <?php echo number_format($total_balance, 2, '.', ','); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 dashboard-tablets long-tablet">
                            <div class="panel panel-warning panel-colorful">
                                <div class="panel-zero text-center text-sm warning-tablet-text">INTEREST INCOME ( Total Loaned: ₱ <?php echo number_format($total_loans, 2, '.', ','); ?> )
                                    <p class="h2 text-thin">
                                        <i class="fas fa-chart-line fa-1x warning-tablet-text"></i>
                                        ₱ <?php echo number_format($total_interests, 2, '.', ','); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-sm-6 col-md-12 dashboard-tablets long-tablet">
                            <div class="panel panel-info panel-colorful">
                                <div class="panel-zero text-center info-tablet-text">GROSS CAPITAL
                                    <p class="h2 text-thin">
                                        <i class="fas fa-chart-bar fa-1x info-tablet-text"></i>
                                        ₱ <?php echo number_format($gross_capital, 2, '.', ','); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 dashboard-tablets long-tablet">
                            <div class="panel panel-primary panel-colorful">
                                <div class="panel-zero text-center primary-tablet-text">CASH ON HAND
                                    <p class="h2 text-thin">
                                        <i class="fas fa-hand-sparkles fa-1x primary-tablet-text"></i>
                                        ₱ <?php echo number_format($cash_on_hand, 2, '.', ','); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-sm-6 col-md-6 dashboard-tablets short-tablet">
                            <div class="panel panel-success panel-colorful">
                                <div class="panel-zero text-center success-tablet-text">
                                    <p class="text-uppercase mar-btm text-sm">Cleared Loans</p>
                                    <i class="fas fa-check-circle fa-5x success-tablet-text"></i>
                                    <hr>
                                    <p class="h2 text-thin"><?php echo $loans_cleared; ?> of <?php echo $loans_count; ?></p>
                                    <small><span class="text-semibold" style="font-size: 11px;">Ongoing Loans [ <?php echo ($loans_count - $loans_cleared); ?> ]<br><br></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 dashboard-tablets short-tablet" onclick="back_up_db()" style="cursor: pointer;">
                            <div class="panel panel-secondary panel-colorful">
                                <div class="panel-zero text-center secondary-tablet-text">
                                    <p class="text-uppercase mar-btm text-sm">Backup Database</p>
                                    <i class="fas fa-database fa-5x secondary-tablet-text"></i>
                                    <hr>
                                    <p class="h4 text-thin">Download File</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9">
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->