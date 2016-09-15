<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="UTF-8" />
    <title><?php echo $info_default['title'] ?>
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/css/login.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>library_add/admin/plugins/magic/magic.css" />
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body >
    <!-- PAGE CONTENT --> 
    <div class="container">
      <div class="text-center">
        <img src="<?php echo base_url();?>library_add/admin/img/logo.png" id="logoimg" alt=" Logo" />
      </div>

      <div class="tab-content">
        <div id="login" class="tab-pane active">
          <form action="/admin/admin_login" class="form-signin" method="POST">
            <?php if($this->session->flashdata('item')) {?>
               <?php $view_message = $this->session->flashdata('item') ;?>
               <div class="<?php echo $view_message['class'] ;?> ">
                  <strong><?php echo $view_message['message'] ;?></strong>
               </div>
            <?php } ?>
            <p class="text-muted text-center btn-block btn btn-primary btn-rect">
              Nhập Tài Khoản Và Mật Khẩu Của Bạn
            </p>
            <input type="text" placeholder="Username" class="form-control" name="username"/>
            <input type="password" placeholder="Password" class="form-control" name="password"/>
            <button class="btn text-muted text-center btn-danger" type="submit">Đăng nhập
            </button>
          </form>
        </div>
        <?php /* ?>
        <div id="forgot" class="tab-pane">
          <form action="index.html" class="form-signin">
            <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail
            </p>
            <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
            <br />
            <button class="btn text-muted text-center btn-success" type="submit">Recover Password
            </button>
          </form>
        </div>
        <div id="signup" class="tab-pane">
          <form action="index.html" class="form-signin">
            <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register
            </p>
            <input type="text" placeholder="First Name" class="form-control" />
            <input type="text" placeholder="Last Name" class="form-control" />
            <input type="text" placeholder="Username" class="form-control" />
            <input type="email" placeholder="Your E-mail" class="form-control" />
            <input type="password" placeholder="password" class="form-control" />
            <input type="password" placeholder="Re type password" class="form-control" />
            <button class="btn text-muted text-center btn-success" type="submit">Register
            </button>
          </form>
        </div>
        <?php */ ?>
      </div>
      <?php /* ?>
      <div class="text-center">
        <ul class="list-inline">
          <li>
            <a class="text-muted" href="#login" data-toggle="tab">Login
            </a>
          </li>
          <li>
            <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password
            </a>
          </li>
          <li>
            <a class="text-muted" href="#signup" data-toggle="tab">Da
            </a>
          </li>
        </ul>
      </div>
      <?php */ ?>
    </div>
    <!--END PAGE CONTENT -->     
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url();?>library_add/admin/plugins/jquery-2.0.3.min.js">
    </script>
    <script src="<?php echo base_url();?>library_add/admin/plugins/bootstrap/js/bootstrap.js">
    </script>
    <script src="<?php echo base_url();?>library_add/admin/js/login.js">
    </script>
    <!--END PAGE LEVEL SCRIPTS -->
  </body>
  <!-- END BODY -->
</html>
