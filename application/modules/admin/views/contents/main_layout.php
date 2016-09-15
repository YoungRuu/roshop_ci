<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en"> 
  <!--<![endif]-->
  <!-- BEGIN HEAD-->
  <head>
    <meta charset="UTF-8" />
    <title>
    <?php echo $info_default['title'] ;?>
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/css/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/css/selectpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/plugins/Font-Awesome/css/font-awesome.css" />
    <?php $this->load->view($info_default['css_subview']) ;?>
    <!--END GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- END  HEAD-->
  <!-- BEGIN BODY-->
  <body class="padTop53 " >
    <!-- MAIN WRAPPER -->
    <div id="wrap">
      <!-- HEADER SECTION -->
      <div id="top">
        <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
          <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="icon-align-justify">
            </i>
          </a>
          <!-- LOGO SECTION -->
          <header class="navbar-header">
            <a href="index.html" class="navbar-brand">
              <img src="<?php echo base_url();?>library_add/admin/img/logo.png" alt="" />
            </a>
          </header>
          <!-- END LOGO SECTION -->
          <ul class="nav navbar-top-links navbar-right">
            <!-- MESSAGES SECTION -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                <span class="label label-success">2
                </span>    
                <i class="icon-envelope-alt">
                </i>&nbsp; 
                <i class="icon-chevron-down">
                </i>
              </a>
              <ul class="dropdown-menu dropdown-messages">
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <strong>John Smith
                      </strong>
                      <span class="pull-right text-muted">
                        <em>Today
                        </em>
                      </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                      <br />
                      <span class="label label-primary">Important
                      </span> 
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <strong>Raphel Jonson
                      </strong>
                      <span class="pull-right text-muted">
                        <em>Yesterday
                        </em>
                      </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                      <br />
                      <span class="label label-success"> Moderate 
                      </span> 
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <strong>Chi Ley Suk
                      </strong>
                      <span class="pull-right text-muted">
                        <em>26 Jan 2014
                        </em>
                      </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                      <br />
                      <span class="label label-danger"> Low 
                      </span> 
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a class="text-center" href="javascript:void(0)">
                    <strong>Read All Messages
                    </strong>
                    <i class="icon-angle-right">
                    </i>
                  </a>
                </li>
              </ul>
            </li>
            <!--END MESSAGES SECTION -->
            <!--TASK SECTION -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                <span class="label label-danger">5
                </span>   
                <i class="icon-tasks">
                </i>&nbsp; 
                <i class="icon-chevron-down">
                </i>
              </a>
              <ul class="dropdown-menu dropdown-tasks">
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <p>
                        <strong> Profile 
                        </strong>
                        <span class="pull-right text-muted">40% Complete
                        </span>
                      </p>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                          <span class="sr-only">40% Complete (success)
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <p>
                        <strong> Pending Tasks 
                        </strong>
                        <span class="pull-right text-muted">20% Complete
                        </span>
                      </p>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                          <span class="sr-only">20% Complete
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <p>
                        <strong> Work Completed 
                        </strong>
                        <span class="pull-right text-muted">60% Complete
                        </span>
                      </p>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                          <span class="sr-only">60% Complete (warning)
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <p>
                        <strong> Summary 
                        </strong>
                        <span class="pull-right text-muted">80% Complete
                        </span>
                      </p>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                          <span class="sr-only">80% Complete (danger)
                          </span>
                        </div>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a class="text-center" href="javascript:void(0)">
                    <strong>See All Tasks
                    </strong>
                    <i class="icon-angle-right">
                    </i>
                  </a>
                </li>
              </ul>
            </li>
            <!--END TASK SECTION -->
            <!--ALERTS SECTION -->
            <li class="chat-panel dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                <span class="label label-info">8
                </span>   
                <i class="icon-comments">
                </i>&nbsp; 
                <i class="icon-chevron-down">
                </i>
              </a>
              <ul class="dropdown-menu dropdown-alerts">
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <i class="icon-comment" >
                      </i> New Comment
                      <span class="pull-right text-muted small"> 4 minutes ago
                      </span>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <i class="icon-twitter info">
                      </i> 3 New Follower
                      <span class="pull-right text-muted small"> 9 minutes ago
                      </span>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <i class="icon-envelope">
                      </i> Message Sent
                      <span class="pull-right text-muted small" > 20 minutes ago
                      </span>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <i class="icon-tasks">
                      </i> New Task
                      <span class="pull-right text-muted small"> 1 Hour ago
                      </span>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <div>
                      <i class="icon-upload">
                      </i> Server Rebooted
                      <span class="pull-right text-muted small"> 2 Hour ago
                      </span>
                    </div>
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a class="text-center" href="javascript:void(0)">
                    <strong>See All Alerts
                    </strong>
                    <i class="icon-angle-right">
                    </i>
                  </a>
                </li>
              </ul>
            </li>
            <!-- END ALERTS SECTION -->
            <!--ADMIN SETTINGS SECTIONS -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                <i class="icon-user ">
                </i>&nbsp; 
                <i class="icon-chevron-down ">
                </i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li>
                  <a href="<?php echo base_url()?>">
                    <i class="icon-user">
                    </i> Thông tin tài khoản
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="icon-gear">
                    </i> Settings 
                  </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="/dang-xuat">
                    <i class="icon-signout">
                    </i> Logout 
                  </a>
                </li>
              </ul>
            </li>
            <!--END ADMIN SETTINGS -->
          </ul>
        </nav>
      </div>
      <!-- END HEADER SECTION -->
      <!-- MENU SECTION -->
      <div id="left">
        <div class="media user-media well-small">
          <a class="user-link" href="javascript:void(0)">
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url();?>library_add/admin/img/user.gif" />
          </a>
          <br />
          <div class="media-body">
            <h5 class="media-heading"> <?php echo $this->auth['username'] ;?>
            </h5>
            <ul class="list-unstyled user-info">
              <li>
                <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;">
                </a> Online
              </li>
            </ul>
          </div>
          <br />
        </div>
        <ul id="menu" class="collapse">
          <li class="panel">
            <a href="index.html" >
              <i class="icon-table">
              </i> Dashboard
            </a>                   
          </li>
          <li class="panel ">
            <a href="/admin/Admin_users" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
              <i class="icon-tasks"> 
              </i> Tài khoản     
            </a>
          </li>
          <li class="panel ">
            <a href="/admin/Admin_products" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
              <i class="icon-archive">
              </i> Sản phẩm
            </a>
          </li>
          <li class="panel">
            <a href="/admin/Admin_orders" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav">
              <i class="icon-reorder">
              </i> Đơn đặt hàng
            </a>
          </li>
          <li class="panel">
            <a href="/admin/Admin_categories" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav">
              <i class="icon-list-alt">
              </i> Danh mục
            </a>
          </li>
          <li class="panel">
            <a href="/admin/Admin_coupon" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav">
              <i class="icon-ticket"></i> Phiếu mua hàng
            </a>
          </li>
        </ul>
      </div>
      <!--END MENU SECTION -->
      <!--PAGE CONTENT -->
      <div id="content">
        <div class="inner" style="min-height:759px;">
          <div class="row">
            <div class="col-lg-12">
              <h2>Quản lý
              </h2>
            </div>
          </div>
          <hr />
              <?php $this->load->view($info_default['contents_subview']) ;?>
        </div>
      </div>
      <!--END PAGE CONTENT -->
    </div>
    <!--END MAIN WRAPPER -->
    <!-- FOOTER -->
    <div id="footer">
      <p>&copy;  LeAnhRo &nbsp;2016 &nbsp;
      </p>
    </div>
    <!--END FOOTER -->
    <!-- GLOBAL SCRIPTS -->
    <script src="<?php echo base_url();?>library_add/admin/plugins/jquery-2.0.3.min.js">
    </script>
    <script src="<?php echo base_url();?>library_add/admin/plugins/bootstrap/js/bootstrap.min.js">
    </script>
    <script src="<?php echo base_url();?>library_add/admin/js/selectpicker.js">
    </script>
    <script src="<?php echo base_url();?>library_add/admin/plugins/modernizr-2.6.2-respond-1.1.0.min.js">
    </script>
    <?php $this->load->view($info_default['js_subview']) ;?>
    <!-- END GLOBAL SCRIPTS -->
  </body>
  <!-- END BODY-->
</html>
