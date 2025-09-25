<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-Lending | Lending Manager App
  </title>
  <!--STYLESHEET-->
  <!--=================================================-->
  <!--Font Awesome [ OPTIONAL ]-->
  <script src="https://kit.fontawesome.com/c0c51e8ea8.js" crossorigin="anonymous"></script>
  <!-- favicon -->
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  <!--Open Sans Font [ OPTIONAL ] -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
  <!--Bootstrap Stylesheet [ REQUIRED ]-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <!--Nifty Stylesheet [ REQUIRED ]-->
  <link href="<?php echo base_url(); ?>assets/css/nifty.min.css" rel="stylesheet">
  <!--Demo script [ DEMONSTRATION ]-->
  <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo.min.css" rel="stylesheet">
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <!-- Confirm JS for Custom Alert Boxes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <!--SCRIPT-->
  <!--=================================================-->
  <!--Page Load Progress Bar [ OPTIONAL ]-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-minimal.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
  </script>
  <script>
    const BASE_URL = "<?= base_url(); ?>";
  </script>
  <!--
REQUIRED
You must include this in your project.
RECOMMENDED
This category must be included but you may modify which plugins or components which should be included in your project.
OPTIONAL
Optional plugins. You may choose whether to include it in your project or not.
DEMONSTRATION
This is to be removed, used for demonstration purposes only. This category must not be included in your project.
SAMPLE
Some script samples which explain how to initialize plugins or components. This category should not be included in your project.
Detailed information and more samples can be found in the document.
-->
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
  <?php if ($title == 'Transaction Page') : ?>
    <div id="container" class="effect mainnav-sm">
    <?php else : ?>
      <div id="container" class="effect mainnav-lg">
      <?php endif; ?>
      <!--NAVBAR-->
      <!--===================================================-->
      <header id="navbar">
        <div id="navbar-container" class="boxed">
          <!--Brand logo & name-->
          <!--================================-->
          <div class="navbar-header">
            <a href="<?php echo base_url(); ?>dashboard" class="navbar-brand">
              <img src="<?php echo base_url(); ?>assets/img/header_logo25.png" alt="e-Lending" style="width: 45px;
    margin: 2px 5px;" class="brand-icon">
              <div class="brand-title">
                <span class="brand-text" style="margin-left: 15px;">e-Lending App
                </span>
              </div>
            </a>
          </div>

          <!--================================-->
          <!--End brand logo & name-->
          <!--Navbar Dropdown-->
          <!--================================-->
          <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
              <!--Navigation toogle button-->
              <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
              <li class="tgl-menu-btn">
                <a class="mainnav-toggle" href="#">
                  <i class="fa fa-navicon fa-lg">
                  </i>
                </a>
              </li>
            </ul>
            <ul class="nav navbar-top-links pull-right">
              <!--User dropdown-->
              <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
              <li id="dropdown-user" class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">

                  <span class="pull-right">
                    <img class="img-circle img-user media-object" src="<?php echo base_url(); ?>assets/img/av1.png" alt="Profile Picture">
                  </span>
                  <div class="username hidden-xs">
                    <?php echo $this->session->userdata('username') ?>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right with-arrow panel-default">
                  <!-- Dropdown heading  -->
                  <div class="pad-all bord-btm">
                    <p class="text-lg text-muted text-thin mar-btm">
                      <strong>
                        <?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?>
                      </strong>
                    </p>
                  </div>
                  <!-- Dropdown footer -->
                  <div class="pad-all text-right">
                    <a href="<?php echo base_url('user-logout'); ?>" class="btn btn-dark">
                      <i class="fas fa-power-off"></i>&nbsp; Logout
                    </a>
                  </div>
                </div>
              </li>
              <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
              <!--End user dropdown-->
            </ul>
          </div>
          <!--================================-->
          <!--End Navbar Dropdown-->
        </div>
      </header>
      <!--===================================================-->
      <!--END NAVBAR-->
      <div class="boxed">

        <!-- For alert and notifications assets/js/demo/nifty-demo.js-->
        <input type="hidden" value=<?php echo "'" . $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname') . "'"; ?> name="user_fullname" />

        <input type="hidden" value=<?php echo "'" . date('l, F j, Y', strtotime(date('Y-m-d'))) . "'"; ?> name="current_date" />