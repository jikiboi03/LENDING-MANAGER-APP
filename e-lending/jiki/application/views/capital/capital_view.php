<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Capital</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-body">
                        <label class="control-label col-md-6">
                            Current capital
                            <h3 style="color: darkblue;">
                                <i class="fas fa-coins"></i>&nbsp; ₱ <?php echo number_format($total_capital, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Total additions ( + values )
                            <h3 style="color: green;">
                                <i class="fas fa-caret-up"></i>&nbsp; ₱ <?php echo number_format($total_additions, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Total deductions ( - values )
                            <h3 style="color: red;">
                                <i class="fas fa-caret-down"></i>&nbsp; ₱ <?php echo number_format($total_deductions, 2, '.', ','); ?>
                            </h3>
                        </label>
                    </div>
                </div>
                <div class="panel-body legend-container">
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Total interest / Net profit <h4>₱ <?php echo number_format($total_interests, 2, '.', ','); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Gross capital (coh + cr) <h4>₱ <?php echo number_format($gross_capital, 2, '.', ','); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Cash receivable <h4>₱ <?php echo number_format($cash_receivable, 2, '.', ','); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Cash on hand (ctc - cr + ti) <h4>₱ <?php echo number_format($cash_on_hand, 2, '.', ','); ?></h4>
                        </label>
                    </div>
                </div>
                <br />
            </div>
        </div>
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Adjustments</h3>
                </div>
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="adjust_capital()"><i class="fas fa-adjust"></i> &nbsp;Adjust</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="capital-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th>Remarks</th>
                                <th>Encoded</th>
                                <th style="width:20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #99cccc;" class="fa fa-square"></i>&nbsp; Addition &nbsp; | &nbsp;
                        <i style="color: #ffcc99;" class="fa fa-square"></i>&nbsp; Deduction
                    </span>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Capital Adjustment Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="capital_id" />
                    <input type="hidden" value=<?php echo "'" . $total_capital . "'"; ?> name="total_capital" />
                    <input type="hidden" value=<?php echo "'" . $total_interests . "'"; ?> name="total_interest" />
                    <input type="hidden" value=<?php echo "'" . $cash_receivable . "'"; ?> name="cash_receivable" />
                    <input type="hidden" value=<?php echo "'" . $cash_on_hand . "'"; ?> name="cash_on_hand" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Amount *</label>
                            <div class="col-md-8">
                                <input id="amount_capital" name="amount" placeholder="Enter adjustment amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-8">
                                <input name="date" placeholder="Date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Capital</label>
                            <div class="col-md-8">
                                <input name="total" type="hidden">
                                <input id="total_display" name="total_display" placeholder="Display total capital" class="form-control" type="text" style="color: black; font-size: 20px; text-align: center;" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-8">
                                <textarea name="remarks" placeholder="Enter remarks" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_form_edit_date_remarks" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Date/Remarks Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_edit_date_remarks" class="form-horizontal">
                    <input type="hidden" value="" name="capital_id" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-8">
                                <input name="date" placeholder="Date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-8">
                                <textarea name="remarks" placeholder="Enter remarks" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>