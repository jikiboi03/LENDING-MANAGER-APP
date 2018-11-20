
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-4" data-content="Additional Sidebar">
                                <a id="demo-toggle-aside" class="shortcut-grid" href="#">
                                    <i class="fa fa-magic"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Notification">
                                <a id="demo-alert" class="shortcut-grid" href="#">
                                    <i class="fa fa-bullhorn"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Page Alerts">
                                <a id="demo-page-alert" class="shortcut-grid" href="#">
                                    <i class="fa fa-bell"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content" style="font-size: 13px;">
                                <ul id="mainnav-menu" class="list-group">
                        
                                    <!--Category name-->
                                    <li class="list-header">Navigation</li>
                        
                                    <!--Menu list item-->
                                    <?php if($this->uri->segment(1) == 'dashboard'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url('dashboard');?>">
                                            <i class="fa fa-dashboard"></i>
                                            <span class="menu-title">
                                                <strong>Dashboard</strong>
                                                <span class="label label-success pull-right">Top</span>
                                            </span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url('dashboard');?>">
                                            <i class="fa fa-dashboard"></i>
                                            <span class="menu-title">
                                                Dashboard
                                                <span class="label label-success pull-right">Top</span>
                                            </span>
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <!--Menu list item-->
                                    <?php if($this->uri->segment(1) == 'statistics-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url('statistics-page');?>">
                                            <i class="fa fa-area-chart"></i>
                                            <span class="menu-title">
                                                <strong>Statistics / Charts</strong>
                                            </span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url('statistics-page');?>">
                                            <i class="fa fa-area-chart"></i>
                                            <span class="menu-title">
                                                Statistics / Charts
                                            </span>
                                        </a>
                                    </li>

                                    <?php } ?>


                        
                                    <li class="list-divider"></li>
                        
                                    <!--Category name-->
                                    
                                    <li class="list-header">Operations</li>
                                    
                                    <!--Menu list item-->
                        
<!-- ================================================== E-LENDING CODES ================================================== -->
                                    

                                    <!--Menu list item-->
                                    
                                    <?php if($this->session->userdata('administrator') == '1'): ?>

                                    <?php if($this->uri->segment(1) == 'companies-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>companies-page">
                                            <i class="fa fa-building"></i>
                                            <strong><span class="menu-title">Companies</span></strong>
                                            
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>companies-page">
                                            <i class="fa fa-building"></i>
                                            <span class="menu-title">Companies</span>
                                            
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>

                                    <!--Menu list item-->


                                    <!--Menu list item-->
                                    
                                    <?php if($this->session->userdata('administrator') == '1'): ?>

                                    <?php if($this->uri->segment(1) == 'atm-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>atm-page">
                                            <i class="fa fa-university"></i>
                                            <strong><span class="menu-title">ATM Banks</span></strong>
                                            
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>atm-page">
                                            <i class="fa fa-university"></i>
                                            <span class="menu-title">ATM Banks</span>
                                            
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>

                                    <!--Menu list item-->  


                                    <!--Menu list item-->
                                    
                                    <?php if($this->session->userdata('administrator') == '1'): ?>

                                    <?php if($this->uri->segment(1) == 'clients-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>clients-page">
                                            <i class="fa fa-users"></i>
                                            <strong><span class="menu-title">Clients</span></strong>
                                            
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>clients-page">
                                            <i class="fa fa-users"></i>
                                            <span class="menu-title">Clients</span>
                                            
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>

                                    <!--Menu list item-->       


                                    <!--Menu list item-->
                                    
                                    <?php if($this->session->userdata('administrator') == '1'): ?>

                                    <?php if($this->uri->segment(1) == 'capital-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>capital-page">
                                            <i class="fa fa-money"></i>
                                            <strong><span class="menu-title">Capital</span></strong>
                                            <span class="label label-danger pull-right">sudo</span>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>capital-page">
                                            <i class="fa fa-money"></i>
                                            <span class="menu-title">Capital</span>
                                            <span class="label label-danger pull-right">sudo</span>
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>

                                    <!--Menu list item-->                     



<!-- ================================================== MISCELLANEOUS ================================================ -->
    

                        
                                    
                                    <li class="list-divider"></li>
                        
                                    <!--Category name-->
                                    <li class="list-header">Miscellaneous</li>
                        
                                    
                                    <!--Menu list item-->
                        
                                    <!--Menu list item-->
                                    <?php if($this->session->userdata('administrator') == "1"): ?>

                                    <?php if($this->uri->segment(1) == 'users-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>users-page">
                                            <i class="fa fa-user-circle"></i>
                                            <strong><span class="menu-title">Users</span></strong>
                                            <span class="label label-danger pull-right">sudo</span>
                                            
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>users-page">
                                            <i class="fa fa-user-circle"></i>
                                            <span class="menu-title">Users</span>
                                            <span class="label label-danger pull-right">sudo</span>
                                            
                                        </a>
                                    </li>

                                    <?php } ?>

                                    <?php endif ?>



                                    <!--Menu list item-->

                                    <?php if($this->uri->segment(1) == 'logs-page'){ ?>

                                    <li class="active-link">
                                        <a href="#">
                                            <i class="fa fa-history"></i>
                                            <strong><span class="menu-title">System Logs</span></strong>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>logs-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-history"></i>
                                            <span class="menu-title">System Logs</span>
                                            <i class="arrow"></i>
                                        </a>
                                    
                                        <!--Submenu-->
                                        <ul class="collapse">
                                            <li><a href="<?php echo base_url();?>logs-page">Show List</a></li>
                                        </ul>
                                    </li>

                                    <?php } ?>


                                    <!--Menu list item-->
                                    
                                    <!-- REPORTS -->



                                    <!--Menu list item-->

                                    <?php if($this->uri->segment(1) == 'schedules-page'){ ?>

                                    <li class="active-link">
                                        <a href="<?php echo base_url();?>schedules-page">
                                            <i class="fa fa-clock-o"></i>
                                            <strong><span class="menu-title">Schedules</span></strong>
                                        </a>
                                    </li>

                                    <?php }else{ ?>

                                    <li>
                                        <a href="<?php echo base_url();?>schedules-page">
                                            <i class="fa fa-clock-o"></i>
                                            <span class="menu-title">Schedules</span>
                                        </a>
                                    </li>

                                    <?php } ?>

                                    

                                    <!--Menu list item-->
                                    
                                    <!-- NOTIFICATIONS -->
                                    


                                </ul>

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>
