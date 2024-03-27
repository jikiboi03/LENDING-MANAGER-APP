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
        <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
        <li><a href="<?php echo base_url('clients-page');?>">Clients</a></li>
        <li><a href="<?php echo base_url('profiles-page/' . $client->client_id);?>">Client Profile</a></li>
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
                            <button type="button" class="btn btn-default" onclick="cancel_trans()"><i class="fas fa-backspace"></i> &nbsp;
                                Back to Profile
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
                <div class="panel-body trans-details-container">
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Company <h4><?php echo $this->companies->get_company_name($client->comp_id); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Job <h4><?php echo $client->job; ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Total paid <h4>₱ <?php echo number_format($loan->paid, 2, '.', ','); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Current balance <h4>₱ <?php echo number_format($loan->balance, 2, '.', ','); ?></h4>
                        </label>  
                    </div>
                </div>
                <br />
            </div>
        </div>
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Transaction Logs Table</h3>    
                </div>
                <div class="panel-body">
                    <?php if ($loan->status != 3){ ?>
                        <button class="btn btn-success col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="add_payment()"><i class="fas fa-plus-circle"></i> &nbsp;Add Payment</button>
                        <button class="btn btn-info col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="add_interest()"><i class="fas fa-plus-circle"></i> &nbsp;Add Interest</button>
                        <button class="btn btn-warning col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="adjust_loan()"><i class="fas fa-plus-circle"></i> &nbsp;Adjust Loan</button>
                        <button class="btn btn-default col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="reload_table()"><i class="fas fa-sync-alt"></i> &nbsp;Reload</button>
                        <button class="btn btn-primary col-xs-6 col-sm-8 col-md-2 custom-button-margin" onclick="fix_bal_paid_calculation()"><i class="fas fa-wrench"></i> &nbsp;Fix</button>
                    <?php } ?>
                </div>
                <div class="panel-body">
                    <table id="transactions-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:60px;">Trans ID</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Interest</th>
                                <th>Balance</th>
                                <th>Remarks</th>
                                <th style="width:20px;">Action</th>
                                <th>Encoded</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_add_payment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Payment</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add_payment" class="form-horizontal">

                    <input type="hidden" value="" name="trans_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                    <div class="form-body">

                        <div id="cash_buttons">
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1" onclick="add_cash_input_payment(1)">1</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_5" onclick="add_cash_input_payment(5)">5</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_10" onclick="add_cash_input_payment(10)">10</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_20" onclick="add_cash_input_payment(20)">20</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_50" onclick="add_cash_input_payment(50)">50</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input_payment(100)">100</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_200" onclick="add_cash_input_payment(200)">200</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input_payment(500)">500</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input_payment(1000)">1,000</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input_payment(2000)">2,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input_payment(5000)">5,000</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input_payment(10000)">10,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-warning col-xs-5 col-sm-5 col-md-5" id="cash_clear" onclick="clear_cash_input_payment()">CLEAR</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="control-label col-md-3">Amount</label>
                            <div class="col-xs-8 col-sm-8 col-md-6">
                                <input id="amount_payment" name="amount" placeholder="Enter payment amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                            <button class="btn btn-success col-xs-4 col-sm-4 col-md-2" id="exact_amt" onclick="full_cash_input_payment()">FULL AMT.</button>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-4">
                                <input name="date" placeholder="Enter date start" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total due</label>
                            <div class="col-md-9">
                                <input id="total" name="total" placeholder="Display total due" class="form-control" type="number" style="color: green; font-size: 20px; text-align: center;" readonly>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_add_interest" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Interest</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add_interest" class="form-horizontal">

                    <input type="hidden" value="" name="trans_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                    <div class="form-body">

                        <div id="cash_buttons">
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1" onclick="add_cash_input_interest(1)">1</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_5" onclick="add_cash_input_interest(5)">5</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_10" onclick="add_cash_input_interest(10)">10</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_20" onclick="add_cash_input_interest(20)">20</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_50" onclick="add_cash_input_interest(50)">50</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input_interest(100)">100</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_200" onclick="add_cash_input_interest(200)">200</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input_interest(500)">500</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input_interest(1000)">1,000</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input_interest(2000)">2,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input_interest(5000)">5,000</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input_interest(10000)">10,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-warning col-xs-5 col-sm-5 col-md-5" id="cash_clear" onclick="clear_cash_input_interest()">CLEAR</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="control-label col-md-3">Amount</label>
                            <div class="col-md-4">
                                <input id="interest_amount" name="interest" placeholder="Enter interest amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <select id="percentage_trans" name="percentage" class="form-control" style="background-color: lightblue;">
                                    <option value="0">Custom amount</option>
                                    <option value=".05">5 %</option>
                                    <option value=".07">7 %</option>
                                    <option value=".08">8 %</option>
                                    <option value=".09">9 %</option>
                                    <option value=".10">10 %</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-4">
                                <input name="date" placeholder="Enter transaction date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total due</label>
                            <div class="col-md-9">
                                <input id="total" name="total" placeholder="Display total due" class="form-control" type="number" style="color: green; font-size: 20px; text-align: center;" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_adjust_loan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Adjust Loan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_adjust_loan" class="form-horizontal">

                    <input type="hidden" value="" name="trans_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Amount</label>
                            <div class="col-md-9">
                                <input id="adjustment_amount" name="adjustment_amount" placeholder="Enter adjustment amount ( + / - )" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-4">
                                <input name="date" placeholder="Enter transaction date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Total due</label>
                            <div class="col-md-9">
                                <input id="total" name="total" placeholder="Display total due" class="form-control" type="number" style="color: green; font-size: 20px; text-align: center;" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_edit_date_remarks" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Date/Remarks Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_edit_date_remarks" class="form-horizontal">

                    <input type="hidden" value="" name="trans_id"/>
                    <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                    <input type="hidden" value="" name="total"/>
                    
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-12 col-md-3">Transaction Date</label>
                            <div class="col-md-9">
                                <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-12 col-md-3">Trans. Remarks</label>
                            <div class="col-md-9">
                                <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->