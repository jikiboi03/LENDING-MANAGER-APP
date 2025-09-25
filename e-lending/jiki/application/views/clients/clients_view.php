<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Clients</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="add_client()"><i class="fas fa-plus-circle"></i> &nbsp;Create</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="clients-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Name</th>
                                <th style="width:80px;">Balance</th>
                                <th>PIN</th>
                                <th>Contact</th>
                                <th>ATM Bank</th>
                                <th>Company</th>
                                <th style="width:110px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #bededc;" class="fa fa-square"></i>&nbsp; Has active transaction &nbsp; | &nbsp;
                        <i style="color: #ccccff;" class="fa fa-square"></i>&nbsp; Male &nbsp; | &nbsp;
                        <i style="color: #ffcccc;" class="fa fa-square"></i>&nbsp; Female
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
                <h3 class="modal-title">Clients Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="client_id" />
                    <input type="hidden" value="" name="current_name" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Name *</label>
                            <div class="col-md-4">
                                <input name="lname" placeholder="Enter last name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="fname" placeholder="Enter first name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact *</label>
                            <div class="col-md-4">
                                <input name="contact" placeholder="Enter contact" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <select name="sex" class="form-control">
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address *</label>
                            <div class="col-md-8">
                                <textarea name="address" placeholder="Enter address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Job info *</label>
                            <div class="col-md-4">
                                <select name="comp_id" class="form-control">
                                    <option value="">Select company</option>
                                    <?php
                                    foreach ($companies as $row) {
                                        echo '<option value="' . $row->comp_id . '">' . $row->name . '</option>';
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="job" placeholder="Enter position" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Salary info *</label>
                            <div class="col-md-4">
                                <select name="atm_id" class="form-control">
                                    <option value="">Select bank</option>
                                    <?php
                                    foreach ($atm as $row) {
                                        echo '<option value="' . $row->atm_id . '">' . $row->name . '</option>';
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="salary" placeholder="Enter salary" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ATM info *</label>
                            <div class="col-md-4">
                                <select name="atm_type" class="form-control">
                                    <option value="">Select type</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Checking">Checking</option>
                                    <option value="Cash Card">Cash Card</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="pin" placeholder="Enter PIN" class="form-control" type="number">
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