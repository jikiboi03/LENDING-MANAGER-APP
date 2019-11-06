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
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
                    <li><a href="<?php echo base_url('clients-page');?>">Clients list</a></li>
                    <li class="active">Client profile</li>

                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo 'L' . $loan->loan_id ?></b><span style="float:right;"><button type="button" style="width: 100%;" class="btn btn-dark"  onclick="cancel_trans()"><i class="fa fa-sign-out"></i> &nbsp;Back to profile</button></span></h3>
                        </div>

                        <div class="panel-body">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                            <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/>
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="form-group">

                                        <label class="control-label col-md-12">Client: <h4><?php echo $client->lname . ', ' . $client->fname ?></h4><hr></label>

                                        <label class="control-label col-md-6">Loan status: <h4><?php if ($loan->status == 1){ echo '<b style="color:green;">NEW LOAN TRANSACTION</b>'; } else if ($loan->status == 2){ echo '<b style="color:orange;">ONGOING LOAN TRANSACTION</b>'; } else { echo '<b style="color:gray;">CLEARED LOAN TRANSACTION</b>'; }?></h4></label>

                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Total paid: <h4>₱ <?php echo number_format($loan->paid, 2, '.', ','); ?></h4></label>
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Total balance: <h4>₱ <?php echo number_format($loan->balance, 2, '.', ','); ?></h4></label>
                                        
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>





<!-- ============================================================ LOAN HISTORY ==================================== -->
                        

                    <div class="panel col-md-12">

                        <div class="panel-heading">
                            <h3 class="panel-title">Transaction logs table</h3>    
                        </div>

                        <div class="panel-body">
                            <?php if ($loan->status != 3){ ?>
                                <button class="btn btn-success col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="add_payment()"><i class="fa fa-plus-square"></i> &nbsp;Add payment</button>
                                <button class="btn btn-info col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="add_interest()"><i class="fa fa-plus-square"></i> &nbsp;Add interest</button>
                                <button class="btn btn-warning col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="adjust_loan()"><i class="fa fa-plus-square"></i> &nbsp;Adjust loan</button>
                                <button class="btn btn-default col-xs-6 col-sm-4 col-md-2 custom-button-margin" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                                <button class="btn btn-primary col-xs-6 col-sm-8 col-md-2 custom-button-margin" onclick="fix_bal_paid_calculation()"><i class="fa fa-wrench"></i> &nbsp;Fix</button>
                                <br><br>
                            <?php } ?>

                            <table id="transactions-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                            <br>
                            <!-- End Striped Table -->
                            <span>Legend: [ &nbsp; <i style = "color: #99ff99;" class="fa fa-square"></i> - Trans. start &nbsp; | &nbsp; <i style = "color: #ccff99;" class="fa fa-square"></i> - Paid partial &nbsp; | &nbsp; <i style = "color: #cccccc;" class="fa fa-square"></i> - Paid full &nbsp; | &nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Add interest &nbsp; | &nbsp; <i style = "color: #99cccc;" class="fa fa-square"></i> - Add amount &nbsp; | &nbsp; <i style = "color: #ffcc99;" class="fa fa-square"></i> - Discount amount &nbsp; ]</span>
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
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span class="badge badge-success"><h3 class="modal-title">Add Payment</h3></span>
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

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Amount :</label>
                                        <div class="col-xs-8 col-sm-8 col-md-6">
                                            <input id="amount_payment" name="amount" placeholder="Payment Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                        <button class="btn btn-success col-xs-4 col-sm-4 col-md-2" id="exact_amt" onclick="full_cash_input_payment()">FULL AMT.</button>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Remarks :</label>
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <input id="total" name="total" placeholder="Total balance" class="form-control" type="number" style="color: green; font-size: 20px;" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->

            <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form_add_interest" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span class="badge badge-info"><h3 class="modal-title">Add Interest</h3></span>
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

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Interest amt :</label>
                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <input id="interest_amount" name="interest" placeholder="Interest Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <select id="percentage_trans" name="percentage" class="form-control" style="background-color: lightblue;">
                                                <option value="0">Custom Amount</option>
                                                <option value=".05">5 %</option>
                                                <option value=".07">7 %</option>
                                                <option value=".08">8 %</option>
                                                <option value=".09">9 %</option>
                                                <option value=".10">10 %</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Remarks :</label>
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <input id="total" name="total" placeholder="Total balance" class="form-control" type="number" style="color: green; font-size: 20px;" readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->

            <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form_adjust_loan" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span class="badge badge-warning"><h3 class="modal-title">Adjust Loan</h3></span>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form_adjust_loan" class="form-horizontal">

                                <input type="hidden" value="" name="trans_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Adjustment Amount :</label>
                                        <div class="col-md-9">
                                            <input id="adjustment_amount" name="adjustment_amount" placeholder="Adjustment Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Total balance :</label>
                                        <div class="col-md-9">
                                            <input id="total" name="total" placeholder="Total balance" class="form-control" type="number" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
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
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-12 col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btnSave btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> &nbsp;Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->