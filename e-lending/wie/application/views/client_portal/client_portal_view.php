<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title . ' &nbsp; ' . $client->lname . ', ' . $client->fname; ?></h1>
    </div>

    <input type="hidden" id="schedules_today_str" value=<?php echo 'None'; ?> name="schedules_today_str"/> 
    <input type="hidden" id="near_due_date_str" value=<?php echo 'None'; ?> name="near_due_date_str"/>    
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li class="active">Client Portal</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
    <!--Page content-->
    <!--===================================================-->
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
        <!-- Basic Data Tables -->
        <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-passport"></i>&nbsp; 
                        Client Portal
                    </h3>
                </div>
                <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                <div class="panel-body">
                    <div class="form-body">
                        <label class="control-label col-md-6">
                            ATM bank & type
                            <h3 style="color: darkblue;">
                                <i class="far fa-credit-card"></i>&nbsp; <?php echo $this->atm->get_atm_name($client->atm_id) . ' | ' . $client->atm_type; ?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            ATM PIN
                            <h3 style="color: red;">
                                <i class="fas fa-fingerprint"></i>&nbsp; <?php echo $client->pin; ?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Overall balance
                            <h3 style="color: green;">
                                <i class="fas fa-money-check-alt"></i>&nbsp; ₱ <?php echo number_format($loan_balance, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <!-- ============================================================ LOAN HISTORY ==================================== -->
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Loans Information Table</h3>
                </div>
                <div class="panel-body">
                    <table id="client-portal-loans-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="70%">Active Loans</th>
                                <th>Remarks</th>
                                <th>Status</th>
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
                        I - Initial &nbsp; | &nbsp; 
                        <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; New &nbsp; | &nbsp; 
                        <i style="color: #ccff99;" class="fa fa-square"></i>&nbsp; Ongoing
                    </span>
                </div>
                <br />
            </div>
        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->