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
        <li class="active">Client Profile</li>
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
                        Client Details
                        <span style="float:right;">
                            <button type="button" class="btn btn-default" onclick="clients_page()"><i class="fas fa-backspace"></i> &nbsp;
                                Back to Clients
                            </button>
                        </span>
                    </h3>
                </div>
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
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Loans Information Table</h3>
                </div>
                <div class="panel-body">
                    <button class="btn btn-success" onclick="add_loan()"><i class="fas fa-plus-circle"></i> &nbsp;Add New Loan</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i> &nbsp;Reload</button>
                    <br><br>
                    <table id="loans-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:60px;">Loan ID</th>
                                <th>I.Amount</th>
                                <th>I.Interest</th>
                                <th>I.Total Due</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Status</th>
                                <th style="width:110px;">Action</th>
                                <th>Total Paid</th>
                                <th>Balance</th>
                                <th>Total Loan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- End Striped Table -->
                </div>
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; New &nbsp; | &nbsp; 
                        <i style="color: #ccff99;" class="fa fa-square"></i>&nbsp; Ongoing &nbsp; | &nbsp; 
                        <i style="color: #cccccc;" class="fa fa-square"></i>&nbsp; Cleared
                    </span>
                </div>
                <br />
            </div>
        </div>
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                        <h3 class="panel-title"><i class="fas fa-info-circle"></i>&nbsp; Client Information</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-3 bg-color-plain" style="text-align: center;">
                        <!-- check for pic1 if empty. assign default images if empty base on sex -->
                        <?php if ($client->pic1 == ''){ ?>       
                            <?php if ($client->sex == 'Male'){ ?>
                                <img id="image1" src="../uploads/pic1/male.png" style="width:250px;">
                            <?php } else { ?>
                                <img id="image1" src="../uploads/pic1/female.png" style="width:250px;">
                            <?php } ?>
                        <?php } else { ?>
                            <img id="image1" src=<?php echo "'" . "../uploads/pic1/" . $client->pic1 . "'"; ?>  style="width:200px; max-height: 275px;">
                        <?php } ?>
                        <?php echo form_open_multipart('Profiles/Profiles_controller/do_upload');?> 
                            <form action="" method="">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/> 
                                <br />  
                                <input type="file" name="userfile1" id="userfile1" size="20" style="padding-left: 20px;"/> 
                                <br />
                                <input type="submit" value="Upload Image" class="btn btn-success col-md-12"/>
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
        <br />
        <!-- ============================================================ IMAGES ============================================ -->
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                        <h3 class="panel-title"><i class="fas fa-camera-retro"></i>&nbsp; Photos</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-3 bg-color-plain" style="text-align: center;">
                        <!-- check for pic1 if empty. assign default images if empty base on sex -->
                        <?php if ($client->pic2 == ''){ ?>
                            <img id="image2" src="../uploads/pic2/none.jpg" style="width:250px; margin-left:20px;">
                        <?php } else { ?>
                            <img id="image2" src=<?php echo "'" . "../uploads/pic2/" . $client->pic2 . "'"; ?>  style="width:250px; margin-left:20px;">
                        <?php } ?>
                        
                        <?php echo form_open_multipart('Profiles/Profiles_controller/do_upload_2');?> 
                            <form action="" method="">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/> 
                                <br />  
                                <input type="file" name="userfile2" id="userfile2" size="20" style="padding-left: 20px;"/> 
                                <br />
                                
                                <input type="submit" value="Upload Image" class="btn btn-success col-md-12"/>
                            </form>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3 bg-color-plain" style="text-align: center;">
                        <!-- check for pic1 if empty. assign default images if empty base on sex -->
                        <?php if ($client->pic3 == ''){ ?>
                            <img id="image3" src="../uploads/pic3/none.jpg" style="width:250px; margin-left:20px;">
                        <?php } else { ?>
                            <img id="image3" src=<?php echo "'" . "../uploads/pic3/" . $client->pic3 . "'"; ?>  style="width:250px; margin-left:20px;">
                        <?php } ?>
                        
                        <?php echo form_open_multipart('Profiles/Profiles_controller/do_upload_3');?> 
                            <form action="" method="">
                            <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/> 
                                <br />  
                                <input type="file" name="userfile3" id="userfile3" size="20" style="padding-left: 20px;"/> 
                                <br />
                                
                                <input type="submit" value="Upload Image" class="btn btn-success col-md-12"/>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
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
                <h3 class="modal-title">Loan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add_loan" class="form-horizontal">

                    <input type="hidden" value="" name="loan_id"/>
                    <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                    <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/> 

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
                                <button class="btn btn-warning col-xs-5 col-sm-5 col-md-5" id="cash_clear" onclick="clear_cash_input()">CLEAR</button>
                                <label class="control-label col-xs-1 col-sm-1 col-md-1"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="control-label col-md-3">Amount</label>
                            <div class="col-md-9">
                                <input id="amount" name="amount" placeholder="Enter loan amount" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Interest</label>
                            <div class="col-md-4">
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
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-4">
                                <input name="date_start" placeholder="Enter date start" class="form-control" type="date">
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
<div class="modal fade" id="modal_form_edit_date_remarks" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Loan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_edit_date_remarks" class="form-horizontal">

                    <input type="hidden" value="" name="loan_id"/>
                    <input type="hidden" value=<?php echo "'" . $client->client_id . "'"; ?> name="client_id"/>
                    <input type="hidden" value=<?php echo "'" . $client->lname . ', ' . $client->fname . "'"; ?> name="client_name"/> 

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-9">
                                <input name="date_start" placeholder="Enter date start" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-9">
                                <textarea name="remarks" placeholder="Enter remarks (optional)" class="form-control"></textarea>
                                <span class="help-block"></span>
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