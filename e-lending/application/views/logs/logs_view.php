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

    <input type="hidden" id="logs_type" value=<?php echo $type; ?> name="logs_type"/>

    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
        <li class="active">System Logs</li>
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
                    <h3 class="panel-title"><i class="far fa-list-alt"></i>&nbsp; System Logs Information Table</h3>
                </div>
                <div class="panel-body">
                    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-sync-alt"></i> &nbsp;Reload</button>
                    <br><br>
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
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <?php if ($type == "access") { ?>
                            <i style = "color: #ffffff;" class="fa fa-square"></i>&nbsp; Login &nbsp; | &nbsp; 
                            <i style = "color: #cccccc;" class="fa fa-square"></i>&nbsp; Logout
                        <?php } else { ?> 
                            <i style = "color: #99ff99;" class="fa fa-square"></i>&nbsp; Add &nbsp; | &nbsp; 
                            <i style = "color: #99ffff;" class="fa fa-square"></i>&nbsp; Update &nbsp; | &nbsp;
                            <i style = "color: #ffcc99;" class="fa fa-square"></i>&nbsp; Delete
                        <?php } ?>    
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
