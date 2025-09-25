<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Users</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="add_user()"><i class="fas fa-plus-circle"></i> &nbsp;Create</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="users-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Type</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Client ID</th>
                                <th>Encoded</th>
                                <th style="width:117px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #cccccc;" class="fa fa-square"></i>&nbsp; Client user &nbsp; | &nbsp;
                        <i style="color: #66ffff;" class="fa fa-square"></i>&nbsp; Administrator &nbsp; | &nbsp;
                        <i style="color: #ffff66;" class="fa fa-square"></i>&nbsp; Super admin
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
                <h3 class="modal-title">Users Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="user_id" />
                    <input type="hidden" value="" name="current_username" />
                    <input type="hidden" value="" name="current_name" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Username *</label>
                            <div class="col-md-8">
                                <input name="username" placeholder="Enter username" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password *</label>
                            <div class="col-md-4">
                                <input name="password" placeholder="Enter password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="repassword" placeholder="Re-enter password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3">Name *</label>
                            <div class="col-md-4">
                                <input name="lastname" placeholder="Enter last name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="firstname" placeholder="Enter first name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact</label>
                            <div class="col-md-4">
                                <input name="contact" placeholder="Enter contact" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="email" placeholder="Enter email" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-8">
                                <textarea name="address" placeholder="Enter address" class="form-control"></textarea>
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
<div class="modal fade" id="modal_form_privileges" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Users Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_privileges" class="form-horizontal">
                    <input type="hidden" value="" name="user_id" />
                    <input type="hidden" value="" name="current_administrator" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Administrator</label>
                            <div class="col-md-8">
                                <select name="administrator" class="form-control">
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
                <button type="button" id="btnSave" onclick="save()" class="btn btn-info"><i class="far fa-hdd"></i> &nbsp;Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>