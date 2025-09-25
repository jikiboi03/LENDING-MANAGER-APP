<link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
<script src="https://code.highcharts.com/js/highcharts.js"></script>
<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <i class="fas fa-chart-area"></i>&nbsp; Statistics
        </h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active">Statistics</li>
    </ol>
    <div class="dashboard-page-content" style="background-color: white">
        <br />
        <div id="page-content" class="panel panel-charts panel-light panel-colorful light-color-neumorph">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="far fa-calendar-alt"></i>&nbsp; Current Year Interest Income</h3>
            </div>
            <div id="container-interests" style="min-width: 80%; height: 400px; margin: 0 auto"></div>
        </div>
        <br />
        <div id="page-content" class="panel panel-charts panel-light panel-colorful light-color-neumorph">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="far fa-calendar-check"></i>&nbsp; Previous Years Interest Income</h3>
            </div>
            <ul class="nav nav-tabs">
                <?php
                $year_index = 0;
                foreach ($prev_year as $value) :
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
                foreach ($prev_year as $value) :
                ?>
                    <input type="hidden" value=<?php echo "'" . $prev_year[$year_index] . "'"; ?> name=<?php echo "'prev_year" . $year_index . "'"; ?> />

                    <input type="hidden" value=<?php echo "'" . $prev_jan[$year_index] . "'"; ?> name=<?php echo "'prev_jan" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_feb[$year_index] . "'"; ?> name=<?php echo "'prev_feb" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_mar[$year_index] . "'"; ?> name=<?php echo "'prev_mar" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_apr[$year_index] . "'"; ?> name=<?php echo "'prev_apr" . $year_index . "'"; ?> />

                    <input type="hidden" value=<?php echo "'" . $prev_may[$year_index] . "'"; ?> name=<?php echo "'prev_may" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_jun[$year_index] . "'"; ?> name=<?php echo "'prev_jun" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_jul[$year_index] . "'"; ?> name=<?php echo "'prev_jul" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_aug[$year_index] . "'"; ?> name=<?php echo "'prev_aug" . $year_index . "'"; ?> />

                    <input type="hidden" value=<?php echo "'" . $prev_sep[$year_index] . "'"; ?> name=<?php echo "'prev_sep" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_oct[$year_index] . "'"; ?> name=<?php echo "'prev_oct" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_nov[$year_index] . "'"; ?> name=<?php echo "'prev_nov" . $year_index . "'"; ?> />
                    <input type="hidden" value=<?php echo "'" . $prev_dec[$year_index] . "'"; ?> name=<?php echo "'prev_dec" . $year_index . "'"; ?> />

                    <input type="hidden" value=<?php echo "'" . number_format($prev_year_total[$year_index], 2, '.', ',') . "'"; ?> name=<?php echo "'prev_year_total" . $year_index . "'"; ?> />

                    <div id=<?php echo "'" . $prev_year[$year_index] . "'"; ?> class=<?php if ($year_index == 0) echo "'tab-pane fade in active'";
                                                                                        else echo "'tab-pane fade'"; ?>>
                        <div id=<?php echo "'container-interests-prev" . $year_index . "'"; ?> style="min-width: 80%; height: 400px; margin: 0 auto"></div>
                    </div>
                <?php
                    $year_index++;
                endforeach;
                ?>
            </div>
            <input type="hidden" value=<?php echo "'" . $year_index . "'"; ?> name="years_count" />
        </div>
        <br />
        <div id="page-content" class="panel panel-light panel-colorful light-color-neumorph">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-award"></i>&nbsp; Top Clients</h3>
                </div>
                <div class="panel-zero">
                    <table id="top-clients-list-table" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:40px;">ID</th>
                                <th>Name</th>
                                <th>Total Loans</th>
                                <th>Total Paid</th>
                                <th>Total Balance</th>
                                <th>Total Interest</th>
                                <th style="width:20px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="legend-container">
                    <span class="bg-color-neumorph">
                        <i style="color: #ffff66;" class="fa fa-square"></i>&nbsp; Has current balance &nbsp; | &nbsp;
                        <i style="color: #ffffff;" class="fa fa-square"></i>&nbsp; No current balance
                    </span>
                </div>
                <br />
            </div>
        </div>
        <input type="hidden" value=<?php echo "'" . $current_year . "'"; ?> name="current_year" />

        <input type="hidden" value=<?php echo "'" . $jan . "'"; ?> name="jan" />
        <input type="hidden" value=<?php echo "'" . $feb . "'"; ?> name="feb" />
        <input type="hidden" value=<?php echo "'" . $mar . "'"; ?> name="mar" />
        <input type="hidden" value=<?php echo "'" . $apr . "'"; ?> name="apr" />

        <input type="hidden" value=<?php echo "'" . $may . "'"; ?> name="may" />
        <input type="hidden" value=<?php echo "'" . $jun . "'"; ?> name="jun" />
        <input type="hidden" value=<?php echo "'" . $jul . "'"; ?> name="jul" />
        <input type="hidden" value=<?php echo "'" . $aug . "'"; ?> name="aug" />

        <input type="hidden" value=<?php echo "'" . $sep . "'"; ?> name="sep" />
        <input type="hidden" value=<?php echo "'" . $oct . "'"; ?> name="oct" />
        <input type="hidden" value=<?php echo "'" . $nov . "'"; ?> name="nov" />
        <input type="hidden" value=<?php echo "'" . $dec . "'"; ?> name="dec" />

        <input type="hidden" value=<?php echo "'" . $year_total . "'"; ?> name="year_total" />
    </div>
</div>