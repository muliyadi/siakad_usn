<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIAKAD USN KOLAKA</title>
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
	<p class="heading" align="center">FORM REGISTRASI EMAIL</p>
	</div>
    <div class="panel-body" align="center">
        <img src="<?php echo base_url(); ?>assets/image/usnx.gif" alt="..." height="40%" width="40%" > 
        <form   action="<?php echo base_url();?>Bismillah/registrasi_akun" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">USER ID</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="userid" readonly required value="<?php echo $userid?>" name="userid" placeholder="USER ID">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NAMA AKUN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nama"  readonly value="<?php echo $nama?>" name="nama" placeholder="NAMA USER">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">EMAIL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email" required  value="<?php echo $email?>" name="email" placeholder="EMAIL VERIFIKASI">
    </div>
    </div>
    <button id="simpan" class="btn btn-primary">Submit</button>

</form>
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


