            <!-- <script src="<?php echo base_url();?>assets/plugins/highcharts/code/highcharts.js">
            </script> -->
            <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
            <script src="https://code.highcharts.com/js/highcharts.js"></script>
            <!-- <script src="<?php echo base_url();?>assets/plugins/highcharts/code/highcharts-3d.js">
            </script>
            <script src="<?php echo base_url();?>assets/plugins/highcharts/code/highcharts-more.js">
            </script> -->
            <!-- <script src="<?php echo base_url();?>assets/plugins/highcharts/code/modules/exporting.js">
            </script> -->
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">
                    <h1 class="page-header text-overflow"><img src="assets/img/jikiapps.png" style="width: 10%; margin-top: 0%; margin-right: 1%;"> [ e-Lending ] Lending Manager App </h1>


                    <!--Searchbox-->
                    <!-- <div class="searchbox">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..">
                            <span class="input-group-btn">
                                <button class="text-muted" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div> -->
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->

                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!-- <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol> -->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                <div id="page-content" class="panel panel-light panel-colorful">
                
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class='fa fa-line-chart'></i>&nbsp; e-Lending Statistics / Charts</h3>
                    </div>
                    <br>

                    <div id="container-interests" style="min-width: 80%; height: 400px; margin: 0 auto"></div>

                    <hr style="background-color: lightgray; height: 1px;">
                    
                    <!-- Get all past years data (line chart) START -->
                    <h3 class="panel-title">Previous years</h3>
                    
                    <ul class="nav nav-tabs">
                    <?php
                        $year_index = 0;
                        foreach ($prev_year as $value):
                    ?>
                        <li class=<?php if ($year_index == 0) echo "'active'"; ?>><a data-toggle="tab" href=<?php echo "'#" . $value . "'"; ?>><?php echo $value; ?></a></li>
                    <?php
                        $year_index++;
                        endforeach; 
                    ?>
                    </ul>

                    <div class="tab-content">
                    <?php
                        $year_index = 0;
                        foreach ($prev_year as $value):
                    ?>
                            <input type="hidden" value=<?php echo "'" . $prev_year[$year_index] . "'"; ?> name=<?php echo "'prev_year" . $year_index . "'"; ?>/>

                            <input type="hidden" value=<?php echo "'" . $prev_jan[$year_index] . "'"; ?> name=<?php echo "'prev_jan" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_feb[$year_index] . "'"; ?> name=<?php echo "'prev_feb" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_mar[$year_index] . "'"; ?> name=<?php echo "'prev_mar" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_apr[$year_index] . "'"; ?> name=<?php echo "'prev_apr" . $year_index . "'"; ?>/>

                            <input type="hidden" value=<?php echo "'" . $prev_may[$year_index] . "'"; ?> name=<?php echo "'prev_may" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_jun[$year_index] . "'"; ?> name=<?php echo "'prev_jun" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_jul[$year_index] . "'"; ?> name=<?php echo "'prev_jul" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_aug[$year_index] . "'"; ?> name=<?php echo "'prev_aug" . $year_index . "'"; ?>/>

                            <input type="hidden" value=<?php echo "'" . $prev_sep[$year_index] . "'"; ?> name=<?php echo "'prev_sep" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_oct[$year_index] . "'"; ?> name=<?php echo "'prev_oct" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_nov[$year_index] . "'"; ?> name=<?php echo "'prev_nov" . $year_index . "'"; ?>/>
                            <input type="hidden" value=<?php echo "'" . $prev_dec[$year_index] . "'"; ?> name=<?php echo "'prev_dec" . $year_index . "'"; ?>/>

                            <input type="hidden" value=<?php echo "'" . number_format($prev_year_total[$year_index], 2, '.', ',') . "'"; ?> name=<?php echo "'prev_year_total" . $year_index . "'"; ?>/>

                            <div id=<?php echo "'" . $prev_year[$year_index] . "'"; ?> class=<?php if ($year_index == 0) echo "'tab-pane fade in active'"; else echo "'tab-pane fade'"; ?>>
                                <br />
                                <div id=<?php echo "'container-interests-prev" . $year_index . "'"; ?> style="min-width: 80%; height: 400px; margin: 0 auto"></div>
                            </div>
                    <?php
                        $year_index++;
                        endforeach; 
                    ?>
                    </div>
                    <input type="hidden" value=<?php echo "'" . $year_index . "'"; ?> name="years_count"/>
                    <!-- Get all past years data (line chart) END -->

                    <hr style="background-color: lightgray; height: 40px;">
                    

                    <!-- Basic Data Tables -->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class='fa fa-trophy'></i>&nbsp; Top Clients - Total Loans Information Table</h3>
                        </div>
                        <div class="panel-body">
                            
                            <table id="top-clients-list-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">Client ID</th>
                                        <th>Name</th>
                                        <th>Total Loans *</th>
                                        <th>Total Paid</th>
                                        <th>Total Balance</th>
                                        <th>Total Interest</th>
                                        <th style="width:10px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!-- End Striped Table -->
                    <span>Legend: [ &nbsp; <i style = "color: #ffff66;" class="fa fa-square"></i> - Has Current Balance &nbsp; | &nbsp; <i style = "color: #ffffff;" class="fa fa-square"></i> - No Current Balance &nbsp; ]</span>
                    <br><br><br>
                </div>

                        


                    <!-- Hidden input files to be fetched by charts (MONTHLY REGISTRATION LINE CHART)-->

                    <input type="hidden" value=<?php echo "'" . $current_year . "'"; ?> name="current_year"/>

                    <input type="hidden" value=<?php echo "'" . $jan . "'"; ?> name="jan"/>
                    <input type="hidden" value=<?php echo "'" . $feb . "'"; ?> name="feb"/>
                    <input type="hidden" value=<?php echo "'" . $mar . "'"; ?> name="mar"/>
                    <input type="hidden" value=<?php echo "'" . $apr . "'"; ?> name="apr"/>

                    <input type="hidden" value=<?php echo "'" . $may . "'"; ?> name="may"/>
                    <input type="hidden" value=<?php echo "'" . $jun . "'"; ?> name="jun"/>
                    <input type="hidden" value=<?php echo "'" . $jul . "'"; ?> name="jul"/>
                    <input type="hidden" value=<?php echo "'" . $aug . "'"; ?> name="aug"/>

                    <input type="hidden" value=<?php echo "'" . $sep . "'"; ?> name="sep"/>
                    <input type="hidden" value=<?php echo "'" . $oct . "'"; ?> name="oct"/>
                    <input type="hidden" value=<?php echo "'" . $nov . "'"; ?> name="nov"/>
                    <input type="hidden" value=<?php echo "'" . $dec . "'"; ?> name="dec"/>

                    <input type="hidden" value=<?php echo "'" . $year_total . "'"; ?> name="year_total"/>


                    










                
                <!--===================================================-->
                <!--End page content-->

            </div>
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
        