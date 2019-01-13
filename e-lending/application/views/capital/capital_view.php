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
                    <li class="active">Capital History</li>

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
                            <h3 class="panel-title"><b style="color: darkblue;"><?php echo 'Current Total Capital: ₱ ' . number_format($total_capital, 2, '.', ','); ?></b></h3>
                        </div>
                        <br>

                        <div class="form-body">
                        <div class="form-group">

                            <label class="control-label col-md-3">Total Interest / Net Profit: <h4>₱ <?php echo number_format($total_interests, 2, '.', ','); ?></h4></label>

                            <label class="control-label col-md-3">Gross Capital (coh + cr): <h4>₱ <?php echo number_format($gross_capital, 2, '.', ','); ?></h4></label>

                            <label class="control-label col-md-3">Cash Receivable: <h4>₱ <?php echo number_format($cash_receivable, 2, '.', ','); ?></h4></label>
                            
                            <label class="control-label col-md-3">Cash On Hand (ctc - cr + ti): <h4>₱ <?php echo number_format($cash_on_hand, 2, '.', ','); ?></h4></label>
                            
                            
                            
                        </div>   
                        </div>
                        <br><br><br><br>
                        <hr style="background-color: lightgray; height: 2px;">




<!-- ============================================================ LOAN HISTORY ==================================== -->
                        



                        <div class="panel-heading">
                            <h3 class="panel-title">Capital Adjustment History Table</h3>    
                        </div>

                        <div class="panel-body">
                            
                            <button class="btn btn-warning" onclick="adjust_capital()"><i class="fa fa-plus-square"></i> &nbsp;Adjust Capital</button>
                            <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> &nbsp;Reload</button>
                            <br><br>
                            <table id="capital-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">Capital ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Remarks</th>
                                        <th style="width:20px;">Action</th>
                                        <th>Encoded</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- End Striped Table -->
                            <span>Legend: [ &nbsp; <i style = "color: #99cccc;" class="fa fa-square"></i> - Capital Addition &nbsp; | &nbsp; <i style = "color: #ffcc99;" class="fa fa-square"></i> - Capital Deduction &nbsp; ]</span>

                            <br>
                            <hr style="background-color: lightgray; height: 2px;">

                            <label class="control-label col-md-3">Total Capital Additions (+ amount values): <h4 style="color: green;">₱ <?php echo number_format($total_additions, 2, '.', ','); ?></h4></label>
                            
                            <label class="control-label col-md-3">Total Capital Deductions (- amount values): <h4 style="color: red;">₱ <?php echo number_format($total_deductions, 2, '.', ','); ?></h4></label>

                        
                    
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

        <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Capital Adjustment Form</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">

                                <input type="hidden" value="" name="capital_id"/>
                                <input type="hidden" value=<?php echo "'" . $total_capital . "'"; ?> name="total_capital"/>
                                <input type="hidden" value=<?php echo "'" . $total_interests . "'"; ?> name="total_interest"/>
                                <input type="hidden" value=<?php echo "'" . $cash_receivable . "'"; ?> name="cash_receivable"/>
                                <input type="hidden" value=<?php echo "'" . $cash_on_hand . "'"; ?> name="cash_on_hand"/>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Capital Adjustment Amount :</label>
                                        <div class="col-md-9">
                                            <input id="amount_capital" name="amount" placeholder="Capital Adjustment Amount" class="form-control" type="number">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Capital :</label>
                                        <div class="col-md-9">
                                            <input id="total" name="total" placeholder="Total Capital" class="form-control" type="number" readonly>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Capital Adjustment Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Capital Adjustment Remarks" class="form-control"></textarea>
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

                                <input type="hidden" value="" name="capital_id"/>
                                
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date :</label>
                                        <div class="col-md-9">
                                            <input name="date" placeholder="Date" class="form-control" type="date">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Capital Adjustment Remarks :</label>
                                        <div class="col-md-9">
                                            <textarea name="remarks" placeholder="Capital Adjustment Remarks" class="form-control"></textarea>
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