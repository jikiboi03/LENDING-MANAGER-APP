    <nav id="mainnav-container">
        <div id="mainnav">
            <div id="mainnav-shortcut">
                <ul class="list-unstyled">
                    <li class="col-xs-9" data-content="Page Alerts">
                    </li>
                    <li class="col-xs-3" data-content="Page Alerts">
                        <a style="color: #7ac1ae;" id="demo-page-alert" class="shortcut-grid" href="#">
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="mainnav-menu-wrap">
                <div class="nano">
                    <div class="nano-content" style="font-size: 13px;">
                        <ul id="mainnav-menu" class="list-group">
                            <li class="list-header">Monitoring</li>
                            <?php if ($this->uri->segment(1) == 'dashboard') { ?>
                                <li class="active-link">
                                    <a href="<?php echo base_url('dashboard'); ?>">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span class="menu-title">
                                            <strong>Dashboard</strong>
                                            <span class="label label-dark pull-right">Home</span>
                                        </span>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo base_url('dashboard'); ?>">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <span class="menu-title">
                                            Dashboard
                                            <span class="label label-dark pull-right">Home</span>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($this->uri->segment(1) == 'statistics-page') { ?>
                                <li class="active-link">
                                    <a href="<?php echo base_url('statistics-page'); ?>">
                                        <i class="fas fa-chart-area"></i>
                                        <span class="menu-title">
                                            <strong>Statistics</strong>
                                        </span>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo base_url('statistics-page'); ?>">
                                        <i class="fas fa-chart-area"></i>
                                        <span class="menu-title">
                                            Statistics
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="list-divider"></li>
                            <li class="list-header">Activities</li>
                            <?php if ($this->session->userdata('administrator') == '1') : ?>
                                <?php if ($this->uri->segment(1) == 'companies-page') { ?>
                                    <li class="active-link">
                                        <a href="<?php echo base_url(); ?>companies-page">
                                            <i class="far fa-building"></i>
                                            <strong><span class="menu-title">Companies</span></strong>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>companies-page">
                                            <i class="far fa-building"></i>
                                            <span class="menu-title">Companies</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endif ?>
                            <?php if ($this->session->userdata('administrator') == '1') : ?>
                                <?php if ($this->uri->segment(1) == 'atm-page') { ?>
                                    <li class="active-link">
                                        <a href="<?php echo base_url(); ?>atm-page">
                                            <i class="fas fa-university"></i>
                                            <strong><span class="menu-title">ATM Banks</span></strong>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>atm-page">
                                            <i class="fas fa-university"></i>
                                            <span class="menu-title">ATM Banks</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endif ?>
                            <?php if ($this->session->userdata('administrator') == '1') : ?>
                                <?php if ($this->uri->segment(1) == 'clients-page' || $this->uri->segment(1) == 'profiles-page') { ?>
                                    <li class="active-link">
                                        <a href="<?php echo base_url(); ?>clients-page">
                                            <i class="fas fa-users"></i>
                                            <strong><span class="menu-title">Clients</span></strong>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>clients-page">
                                            <i class="fas fa-users"></i>
                                            <span class="menu-title">Clients</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endif ?>
                            <?php if ($this->session->userdata('administrator') == '1') : ?>
                                <?php if ($this->uri->segment(1) == 'capital-page') { ?>
                                    <li class="active-link">
                                        <a href="<?php echo base_url(); ?>capital-page">
                                            <i class="far fa-gem"></i>
                                            <strong><span class="menu-title">Capital</span></strong>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>capital-page">
                                            <i class="far fa-gem"></i>
                                            <span class="menu-title">Capital</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endif ?>
                            <?php if ($this->uri->segment(1) == 'schedules-page') { ?>

                                <li class="active-link">
                                    <a href="<?php echo base_url(); ?>schedules-page">
                                        <i class="fas fa-clipboard-list"></i>
                                        <strong><span class="menu-title">Schedules</span></strong>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>schedules-page">
                                        <i class="fas fa-clipboard-list"></i>
                                        <span class="menu-title">Schedules</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="list-divider"></li>
                            <li class="list-header">System</li>
                            <?php if ($this->session->userdata('administrator') == "1") : ?>
                                <?php if ($this->uri->segment(1) == 'users-page') { ?>
                                    <li class="active-link">
                                        <a href="<?php echo base_url(); ?>users-page">
                                            <i class="fas fa-user-shield"></i>
                                            <strong><span class="menu-title">Users</span></strong>
                                            <span class="label label-dark pull-right">Admin</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>users-page">
                                            <i class="fas fa-user-shield"></i>
                                            <span class="menu-title">Users</span>
                                            <span class="label label-dark pull-right">Admin</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php endif ?>
                            <?php if ($this->uri->segment(1) == 'logs-page-ops' || $this->uri->segment(1) == 'logs-page-access') { ?>
                                <li class="active-link">
                                    <a href="#">
                                        <i class="fas fa-laptop"></i>
                                        <strong><span class="menu-title">Logs</span></strong>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse">
                                        <li><a href="<?php echo base_url(); ?>logs-page-access">Access</a></li>
                                    </ul>
                                    <ul class="collapse">
                                        <li><a href="<?php echo base_url(); ?>logs-page-ops">Operations</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-laptop"></i>
                                        <span class="menu-title">Logs</span>
                                        <i class="arrow"></i>
                                    </a>
                                    <ul class="collapse">
                                        <li><a href="<?php echo base_url(); ?>logs-page-access">Access</a></li>
                                    </ul>
                                    <ul class="collapse">
                                        <li><a href="<?php echo base_url(); ?>logs-page-ops">Operations</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </div>