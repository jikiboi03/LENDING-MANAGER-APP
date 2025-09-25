<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $title; ?></h1>
    </div>
    <input type="hidden" id="logs_type" value=<?php echo $type; ?> name="logs_type" />
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Logs</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-zero">
                    <div class="table-btn">
                        <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    <br />
                    <table id="logs-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Type</th>
                                <th>Details</th>
                                <th>User</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <?php if ($type == "access") { ?>
                            <i style="color: #ffffff;" class="fa fa-square"></i>&nbsp; Login &nbsp; | &nbsp;
                            <i style="color: #cccccc;" class="fa fa-square"></i>&nbsp; Logout &nbsp; | &nbsp;
                            <i style="color: #ccff99;" class="fa fa-square"></i>&nbsp; Report
                        <?php } else { ?>
                            <i style="color: #99ff99;" class="fa fa-square"></i>&nbsp; Add &nbsp; | &nbsp;
                            <i style="color: #99ffff;" class="fa fa-square"></i>&nbsp; Update &nbsp; | &nbsp;
                            <i style="color: #ffcc99;" class="fa fa-square"></i>&nbsp; Delete
                        <?php } ?>
                    </span>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>