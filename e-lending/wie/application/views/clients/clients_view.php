<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
        <li class="active">Clients</li>
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
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Clients Information Table</h3>
                </div>
                <div class="panel-body">
                    <button class="btn btn-success" onclick="add_client()"><i class="fas fa-plus-circle"></i> &nbsp;Register</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i> &nbsp;Reload</button>
                    <br><br>
                    <table id="clients-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:60px;">Client ID</th>
                                <th>L Name</th>
                                <th>F Name</th>
                                <th>Contact</th>
                                <th>ATM Bank</th>
                                <th>Company</th>
                                <th>Balance</th>
                                <th>PIN</th>
                                <th style="width:110px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style = "color: #99ffff;" class="fa fa-square"></i>&nbsp; Has active transaction &nbsp; | &nbsp; 
                        <i style = "color: #ccccff;" class="fa fa-square"></i>&nbsp; Male &nbsp; | &nbsp; 
                        <i style = "color: #ffcccc;" class="fa fa-square"></i>&nbsp; Female
                </div>
                <br />
            </div>
            <!--===================================================-->
            <!-- End Striped Table -->
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Clients Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">

                    <input type="hidden" value="" name="client_id"/> 
                    <input type="hidden" value="" name="current_name"/>
                    
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-5">
                                <input name="lname" placeholder="Enter last name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="fname" placeholder="Enter first name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="col-md-9">
                                <select name="sex" class="form-control">
                                    <option value="">--Select gender--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Contact</label>
                            <div class="col-md-9">
                                <input name="contact" placeholder="Enter contact" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" placeholder="Enter address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Company</label>
                            <div class="col-md-9">
                                <select name="comp_id" class="form-control">
                                    <option value="">--Select company--</option>
                                    <?php 
                                        foreach($companies as $row)
                                        { 
                                            echo '<option value="'.$row->comp_id.'">'.$row->name.'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Job info</label>
                            <div class="col-md-5">
                                <input name="job" placeholder="Enter position" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="salary" placeholder="Enter salary" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">ATM info</label>
                            <div class="col-md-5">
                                <select name="atm_id" class="form-control">
                                    <option value="">--Select ATM bank--</option>
                                    <?php 
                                        foreach($atm as $row)
                                        { 
                                            echo '<option value="'.$row->atm_id.'">'.$row->name.'</option>';
                                        }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <select name="atm_type" class="form-control">
                                    <option value="">--Select ATM type--</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Checking">Checking</option>
                                    <option value="Cash Card">Cash Card</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">ATM PIN</label>
                            <div class="col-md-9">
                                <input name="pin" placeholder="Enter ATM PIN" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-9">
                                <textarea name="remarks" placeholder="Remarks" class="form-control"></textarea>
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