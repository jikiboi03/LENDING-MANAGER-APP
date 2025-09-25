<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title . ' &nbsp; ' . $client->lname . ', ' . $client->fname; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url('clients-page'); ?>">Clients</a></li>
        <li class="active">Client Profile</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="add_loan()"><i class="fas fa-plus-circle"></i> &nbsp;Add New Loan</button>
                        <button data-toggle="tooltip" data-placement="top" title="Reload" class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                        <button data-toggle="tooltip" data-placement="top" title="Back to clients" type="button" class="btn btn-default" onclick="clients_page()"><i class="fas fa-backward"></i></button>
                    </div>
                    <br />
                    <table id="loans-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Date Start</th>
                                <th>Loan</th>
                                <th>Date End</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th style="width:150px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; New &nbsp; | &nbsp;
                        <i style="color: #ccff99;" class="fa fa-square"></i>&nbsp; Ongoing &nbsp; | &nbsp;
                        <i style="color: #f5f5f5;" class="fa fa-square"></i>&nbsp; Cleared
                    </span>
                </div>
                <br />
            </div>
        </div>
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
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
                <div class="panel-body legend-container">
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Company <h4><?php echo $this->companies->get_company_name($client->comp_id); ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Job <h4><?php echo $client->job; ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Remarks <h4><?php echo $client->remarks; ?></h4>
                        </label>
                        <label class="control-label col-md-3">
                            Salary <h4>₱ <?php echo number_format($client->salary, 2, '.', ','); ?></h4>
                        </label>
                    </div>
                </div>
                <br />
            </div>
        </div>
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-body">
                    <div class="col-md-3 bg-color-plain" style="text-align: center;">
                        <?php if ($client->pic1 == '') { ?>
                            <?php if ($client->sex == 'Male') { ?>
                                <img id="image1" src="../uploads/pic1/male.png" style="width:250px;">
                            <?php } else { ?>
                                <img id="image1" src="../uploads/pic1/female.png" style="width:250px;">
                            <?php } ?>
                        <?php } else { ?>
                            <img id="image1" src=<?php echo "'" . "../uploads/pic1/" . $client->pic1 . "'"; ?> style="width:200px; max-height: 275px;">
                        <?php } ?>
                        <?php echo form_open_multipart('Profiles/Profiles_controller/do_upload'); ?>
                        <form action="" method="">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id" />
                            <br />
                            <input type="file" name="userfile1" id="userfile1" size="20" style="padding-left: 20px;" />
                            <br />
                            <input type="submit" value="Upload Image" class="btn btn-success col-md-12" />
                        </form>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3" style="padding-left: 60px;">
                            Client ID
                            <h4>
                                &nbsp; <?php echo ' C' . $client->client_id ?>
                            </h4>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Gender
                            <h4>
                                &nbsp; <?php echo $client->sex ?>
                            </h4>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3">
                            Registered
                            <h4>
                                &nbsp; <?php echo $client->encoded ?>
                            </h4>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-9">
                            <hr />
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-3" style="padding-left: 60px;">
                            Contact
                            <h4>
                                &nbsp; <?php echo $client->contact ?>
                            </h4>
                        </label>
                    </div>
                    <div class="form-body">
                        <label class="control-label col-md-6">
                            Address
                            <h4>
                                &nbsp; <?php echo $client->address ?>
                            </h4>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Loan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add_loan" class="form-horizontal">
                    <input type="hidden" value="" name="loan_id" />
                    <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id" />
                    <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name" />
                    <div class="form-body">
                        <div id="cash_buttons">
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1" onclick="add_cash_input(1)">1</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_5" onclick="add_cash_input(5)">5</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_10" onclick="add_cash_input(10)">10</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_20" onclick="add_cash_input(20)">20</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_50" onclick="add_cash_input(50)">50</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input(100)">100</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_200" onclick="add_cash_input(200)">200</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input(500)">500</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input(1000)">1,000</button>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_1000" onclick="add_cash_input(2000)">2,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-2 col-sm-2 col-md-2" id="cash_100" onclick="add_cash_input(5000)">5,000</button>
                                <button class="btn btn-info col-xs-2 col-sm-2 col-md-2" id="cash_500" onclick="add_cash_input(10000)">10,000</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                                <button class="btn btn-default col-xs-5 col-sm-5 col-md-5" id="cash_clear" onclick="clear_cash_input()">CLEAR</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="control-label col-md-3">Amount *</label>
                            <div class="col-md-8">
                                <input id="amount" name="amount" placeholder="Enter loan amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Interest *</label>
                            <div class="col-md-3">
                                <input id="interest" name="interest" placeholder="Enter interest amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <select id="percentage" name="percentage" class="form-control" style="background-color: lightblue;">
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
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-3">
                                <input name="date_start" placeholder="Enter date start" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total due</label>
                            <div class="col-md-8">
                                <input name="total" type="hidden">
                                <input id="total_display" name="total_display" placeholder="Display total due" class="form-control" type="text" style="color: darkblue; font-size: 20px; text-align: center;" readonly>
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
                <h3 class="modal-title">Loan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_edit_date_remarks" class="form-horizontal">
                    <input type="hidden" value="" name="loan_id" />
                    <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id" />
                    <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-8">
                                <input name="date_start" placeholder="Enter date start" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-8">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
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
<div class="modal fade" id="modal_form_quick_payment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Quick Pay</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_quick_payment" class="form-horizontal">
                    <input type="hidden" value="" name="loan_id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Balance</label>
                            <div class="col-md-8">
                                <input id="total_balance" name="total_balance" class="form-control" type="text" style="color: green; font-size: 15px; text-align: center;" readonly>
                            </div>
                        </div>
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
                                <button class="btn btn-default col-xs-5 col-sm-5 col-md-5" id="cash_clear" onclick="clear_cash_input_payment()">CLEAR</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">Amount *</label>
                            <div class="col-md-5 col-sm-5">
                                <input id="amount_payment" name="amount" placeholder="Enter payment amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                            <button class="btn btn-success col-md-3 col-sm-3" id="exact_amt" onclick="full_cash_input_payment()">Full Payment</button>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-3">
                                <input name="date" placeholder="Enter date start" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total due</label>
                            <div class="col-md-8">
                                <input name="total" type="hidden">
                                <input id="total_display" name="total_display" placeholder="Display total due" class="form-control" type="text" style="color: green; font-size: 20px; text-align: center;" readonly>
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