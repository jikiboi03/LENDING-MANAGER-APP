<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Companies</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" title="Register" onclick="add_company()"><i class="fas fa-plus-circle"></i> &nbsp;Create</button>
                        <button class="btn btn-default" title="Reload" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="companies-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Remarks</th>
                                <th style="width:110px;">Encoded</th>
                                <th style="width:65px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                <h3 class="modal-title">Company Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="comp_id" />
                    <input type="hidden" value="" name="current_name" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Name *</label>
                            <div class="col-md-8">
                                <input name="name" placeholder="Enter company name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address * </label>
                            <div class="col-md-8">
                                <input name="address" placeholder="Enter company address" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Remarks</label>
                            <div class="col-md-8">
                                <input name="remarks" placeholder="Enter company remarks" class="form-control" type="text">
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