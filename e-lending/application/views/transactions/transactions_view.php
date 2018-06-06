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
                    <li><a href="<?php echo base_url('clients-page');?>">Clients List</a></li>
                    <li class="active">Client Profile</li>

                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel" style="height: 3000px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><?php echo 'Loan ID: L' . $loan->loan_id ?></b></h3>
                        </div>
                        <br>

                        

                        <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                        <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/>

                        <div class="form-body">
                        <div class="form-group">

                            <label class="control-label col-md-9">Client: <h4><?php echo ' C' . $client->client_id 
                            . ': ' . $client->lname . ', ' . $client->fname ?></h4></label>

                            <div align="right" style="margin-right: 3%">
                                
                                <button type="button" class="btn btn-danger"  onclick="cancel_trans()"><i class="fa fa-times"></i> &nbsp;Back to Profile</button>
                            </div>                

                            <label class="control-label col-md-6">Loan Status: <h4><?php if ($loan->status == 1){ echo '<b style="color:green;">NEW LOAN TRANSACTION</b>'; } else if ($loan->status == 2){ echo '<b style="color:orange;">ONGOING LOAN TRANSACTION</b>'; } else { echo '<b style="color:gray;">CLEARED LOAN TRANSACTION</b>'; }?></h4></label>

                            <label class="control-label col-md-3">Total Paid: <h4>₱ <?php echo number_format($loan->paid, 2, '.', ','); ?></h4></label>
                            <label class="control-label col-md-3">Total Balance: <h4>₱ <?php echo number_format($loan->balance, 2, '.', ','); ?></h4></label>
                            
                            
                            
                        </div>   
                        </div>
                        <br><br><br><br>
                        <hr style="background-color: #ccccff; height: 2px;">




<!-- ============================================================ LOAN HISTORY ==================================== -->
                        



                        <div class="panel-heading">
                            <h3 class="panel-title">Transaction Logs Table</h3>    
                        </div>

                        <div class="panel-body">
                            <button class="btn btn-success" onclick="add_payment()"><i class="fa fa-plus-square"></i> &nbsp;Add Payment</button>
                            <button class="btn btn-info" onclick="add_interest()"><i class="fa fa-plus-square"></i> &nbsp;Add Interest</button>
                            <button class="btn btn-warning" onclick="adjust_loan()"><i class="fa fa-plus-square"></i> &nbsp;Adjust Loan</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
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

                            <!-- End Striped Table -->
                            <span>Legend: [ &nbsp; <i style = "color: #99ff99;" class="fa fa-square"></i> - Trans. Start &nbsp; | &nbsp; <i style = "color: #ccff99;" class="fa fa-square"></i> - Paid Partial &nbsp; | &nbsp; <i style = "color: #cccccc;" class="fa fa-square"></i> - Paid Full &nbsp; | &nbsp; <i style = "color: #99ffff;" class="fa fa-square"></i> - Add Interest &nbsp; | &nbsp; <i style = "color: #99cccc;" class="fa fa-square"></i> - Add Amount &nbsp; | &nbsp; <i style = "color: #ffcc99;" class="fa fa-square"></i> - Discount Amount &nbsp; ]</span>

                        
                    
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

        <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form_add_payment" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Add Payment Transaction Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form_add_payment" class="form-horizontal">

                                <input type="hidden" value="" name="trans_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Payment Amount :</label>
                                        <div class="col-md-9">
                                            <input id="amount_payment" name="amount" placeholder="Payment Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Balance :</label>
                                        <div class="col-md-9">
                                            <input id="total" name="total" placeholder="Total Balance" class="form-control" type="number" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
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
                            <h3 class="modal-title">Add Interest Transaction Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form_add_interest" class="form-horizontal">

                                <input type="hidden" value="" name="trans_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Int. Percentage :</label>
                                        <div class="col-md-9">
                                            <select id="percentage_trans" name="percentage" class="form-control" style="background-color: lightblue;">
                                                <option value="0">Custom Amount</option>
                                                <option value=".05">5 %</option>
                                                <option value=".07">7 %</option>
                                                <option value=".10">10 %</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Interest Amount :</label>
                                        <div class="col-md-9">
                                            <input id="interest_amount" name="interest" placeholder="Interest Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Balance :</label>
                                        <div class="col-md-9">
                                            <input id="total" name="total" placeholder="Total Balance" class="form-control" type="number" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
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
            <div class="modal fade" id="modal_form_adjust_loan" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Add Payment Transaction Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form_adjust_loan" class="form-horizontal">

                                <input type="hidden" value="" name="trans_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->loan_id . "'"; ?> name="loan_id"/>
                                <input type="hidden" value=<?php echo "'" . $loan->balance . "'"; ?> name="total_balance"/>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Adjustment Amount :</label>
                                        <div class="col-md-9">
                                            <input id="adjustment_amount" name="adjustment_amount" placeholder="Adjustment Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Balance :</label>
                                        <div class="col-md-9">
                                            <input id="total" name="total" placeholder="Total Balance" class="form-control" type="number" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
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
                                        <label class="control-label col-md-3">Transaction Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Transaction Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Trans. Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Transaction Remarks" class="form-control"></textarea>
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