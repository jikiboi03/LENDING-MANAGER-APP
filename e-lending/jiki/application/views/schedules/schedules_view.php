<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Schedules</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="add_schedule()"><i class="fas fa-plus-circle"></i> &nbsp;Create</button>
                        <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="schedules-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Remarks</th>
                                <th>User</th>
                                <th>Status</th>
                                <th style="width:110px;">Encoded</th>
                                <th style="width:65px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; Today &nbsp; | &nbsp;
                        <i style="color: #cccccc;" class="fa fa-square"></i>&nbsp; Ended &nbsp; | &nbsp;
                        <i style="color: #ffffff;" class="fa fa-square"></i>&nbsp; Incoming
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
                <h3 class="modal-title">Schedule Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="sched_id" />
                    <div class="form-body">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3">Title *</label>
                            <div class="col-md-8">
                                <input name="title" placeholder="Enter schedule title" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date *</label>
                            <div class="col-md-8">
                                <input name="date" placeholder="Schedule date" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Time</label>
                            <div class="col-md-8">
                                <input name="time" placeholder="Enter schedule time" class="form-control" type="text">
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