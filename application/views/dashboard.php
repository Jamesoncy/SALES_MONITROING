<!DOCTYPE html>
<?php 
$CI = & get_instance();
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRS | Reports</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
 <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/AdminLTE.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('asset/plugins/datatables/dataTables.bootstrap.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/skins/_all-skins.min.css'); ?>">
  
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>RS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Main</b>Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
       
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url("welcome/logout");?>"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <ul class="sidebar-menu">
        <!-- <li><a href="<?php echo base_url("Dashboard/main_page");?>"><i class="fa fa-info-circle"></i> <span>Sales Monitoring</span></a></li> -->
        <?php 
            foreach($links as $link){
                if(!isset($link["child"])) echo '<li> <a href = "'.base_url($link["url"]).'" ><i class="fa '.$link["icon"].'"></i> <span>'.$link["text"].'</span></a> </li>';
            }
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if($this->session->userdata("message")) {
            $message = $this->session->userdata("message");
            $this->session->unset_userdata("message");
          ?>
      <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php  echo $message; ?>
              </div>
           <?php }?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> <h1>
            <?php echo $form_title; ?>
          </h1></h3>
             <div class="box-body">
                  <?php echo $content;?>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
 
<script src="<?php echo base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>

<script src="<?php echo base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('asset/dist/js/app.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/dist/js/demo.js'); ?>"></script>


<script src="<?php echo base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('asset/plugins/datatables/bootbox.min.js'); ?> "></script>
<script>

$(document).ready(function() {
  <?php
      echo "var baseUrl ='".base_url("")."';"; 
      if(isset($use_js)) $this->load->view($use_js);
  ?>
  

});

</script>
</body>
</html>
