<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIAKAD USN KOLAKA</title>
        <script async="async" data-cfasync="false" src="//"></script>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">



        <link rel="stylesheet" href="<?php echo base_url(); ?>template/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page" >

    <div class="container">
	<div class="row">
               
    <div class="col-md-12">
    <div class="panel panel-primary col-md-4">
    <div class="panel-heading">
	<p class="heading" align="center">FORM RESET PASSWORD</p>
	</div>
    <div class="panel-body" align="center">
        <img src="<?php echo base_url(); ?>assets/image/usnx.gif" alt="..." height="60%" width="60%" > 
        <?php echo form_open(base_url() . 'bismillah/reset_password'); ?>
	    <br />
	    <div class="form-group">
        <div>
            <input  autofocus="true" 	type="text" class="form-control" id="userid"  name="userid" placeholder="User ID">
        </div>
        </div>
        <div class="form-group">
        <div>
            <input  autofocus="true" 	type="text" class="form-control" id="email"  name="email" placeholder="Email Aktif">
        </div>
        </div>
        <div class="form-group">
        <div>
            <input  autofocus="true" 	type="password" class="form-control" id="password"  name="password" placeholder=" Password Baru">
        </div>
        </div>
                <div class="form-group">
        <div>
            <input  autofocus="true" 	type="password" class="form-control" id="password"  name="password2" placeholder=" Ulang Password Baru">
        </div>
        </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block"><i class=""></i> Submit</button>
        <br>
        <p>Buka Email untuk Verifikasi permohonan Reset Password Anda...!</p>
        <?php echo form_close(); ?>
        </div>
</div>
</div>
</div>
</div>
            <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
       
	</body>
	
</html>


