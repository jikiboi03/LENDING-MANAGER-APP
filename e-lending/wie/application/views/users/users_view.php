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
        <li class="active">Users</li>
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
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; Users Information Table</h3>
                </div>
                <div class="panel-body">
                    <button class="btn btn-success" onclick="add_user()"><i class="fas fa-plus-circle"></i> &nbsp;Register</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i> &nbsp;Reload</button>
                    <br><br>
                    <table id="users-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Type</th>
                                <th>Username</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Client ID</th>
                                <th>Encoded</th>
                                <th style="width:110px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style = "color: #cccccc;" class="fa fa-square"></i>&nbsp; Client users &nbsp; | &nbsp; 
                        <i style = "color: #66ffff;" class="fa fa-square"></i>&nbsp; Administrators &nbsp; | &nbsp; 
                        <i style = "color: #ffff66;" class="fa fa-square"></i>&nbsp; Super admin
                    </span>
                </div>
                <br />
            </div>
            <!--===================================================-->
            <!-- End Striped Table -->
        </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->

<!-- Bootstrap modal (Basic Info) -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Users Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="user_id"/> 
                    <input type="hidden" value="" name="current_username"/>
                    <input type="hidden" value="" name="current_name"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="Enter username" class="form-control" type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="Enter password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirm PW</label>
                            <div class="col-md-9">
                                <input name="repassword" placeholder="Re-enter password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <hr>                      
                        <!--Basic Info-->
                        <div class="form-group">
                            <label class="control-label col-md-3">Last name</label>
                            <div class="col-md-9">
                                <input name="lastname" placeholder="Enter last name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">First name</label>
                            <div class="col-md-9">
                                <input name="firstname" placeholder="Enter first name" class="form-control" type="text">
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
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Enter email" class="form-control" type="text">
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

<!-- Bootstrap modal (Privileges) -->
<div class="modal fade" id="modal_form_privileges" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Users Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_privileges" class="form-horizontal">
                        <input type="hidden" value="" name="user_id"/>
                        <input type="hidden" value="" name="current_administrator"/>
                        <div class="form-body">
                        <div class="form-group">   
                            <label class="control-label col-md-3">Administrator</label>
                            <div class="col-md-9">
                                <select name="administrator" class="form-control" >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
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

