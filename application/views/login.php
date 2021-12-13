
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIAKAD USN KOLAKA</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image" href="https://siakad.usn.ac.id/assets/image/logo.jpg">
        

    </head>
    <body class="hold-transition login-page" onLoad="getLocation()">
<style type="text/css">
    .login {
        margin: auto;
        width: 380px;
        padding: 10px;
        border: 1px solid #ccc;
        background: white;
    }
</style>
    
 <div class="container">
<div class="row"> 
<div class="login">
        <div class="panel-primary ">
    

	<div class="panel-body" align="center">
        <a href="https://drive.google.com/open?id=1jaEa7NrNBgRHX_wGvmyXaF3y3VJTzUOK"><img src="<?php echo base_url(); ?>assets/image/usnx.gif" alt="..." height="30%" width="30%" > </a>
        <script src="https://yonhelioliskor.com/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async></script>
        <script async="async" data-cfasync="false" src="//"></script>
        
       
         <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        	<p align="center"><H3><B>SIAKAD</B></H3><H5>Universitas Sembilanbelas November Kolaka</H5></p>
        <?php echo form_open(base_url() . 'bismillah/login'); ?>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	    <br />
	    <div class="form-group">
        <div>
            <input  autofocus="true" 	type="text" class="form-control" id="thn_angkatan"  name="userid" placeholder="User ID">
        </div>
        </div>
	    <div class="form-group">
        <div class="form-group">
        <input  autofocus="true" type="password" class="form-control" id="password"  name="password" placeholder="Password">
		 <input  type="hidden" class="form-control" name="lokasi" id="lokasi" value=''>
        </div>

	  
        </div>
        	
            <div class="form-group">
            <p><?php echo $captcha?></p>
	
            </div>
        <div class="form-group">
        <input  autofocus="true" type="number" class="form-control" id="captcha"  name="captcha" placeholder="Input Angka diatas dari kiri ke kanan">
	
        </div>
              <div class="form-group">
   
   <div id="combox" > <!-- sebagai indentitas combo box -->
   <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
        <option value="">Pilih Tahun Akademik...!</option>
   <?php
	
			foreach($listta as $d)
			{
    $selected = '';
    if($kd_tahun_ajaran==$d->kd_tahun_ajaran)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" <?php echo $selected; ?>><?php echo $d->semester.'-'.$d->tahun_ajaran?></option>

    <?php
    }
?>
   


</select>

          </div>
    </div>  
                <button type="submit" name="submit" class="btn btn-primary "><i class=""></i> Login</button>
                <a href="<?php echo base_url('bismillah/freset_password')?>"> Lupa Password</a>
              
              

                 <?php echo form_close(); ?>
                
                Panduan:<br>
                <a href="panduan/fitur_absensi_dosen_siakad.pdf">1. Absensi Dosen </a><br>
                <a href="panduan/fitur_absensi_mahasiswa_siakad.pdf">2. Absensi Mahasiswa</a><br>
                <marquee direction="left"onmouseover="this.stop()" onmouseout="this.start()"><b align="left">Untuk yang gagal login bisa minta akunnya direset oleh Operator SIAKAD Program Studi masing-masing.</marquee>
                
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
<script>
    $('#notifications').slideDown('slow').delay(6000).slideUp('slow');
</script>

<script>
var view = document.getElementById("tampilkan");
var lat=document.getElementById("lat");
var long=document.getElementById("long");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
    }
}
 function showPosition(position) {
     lat.value=position.coords.latitude;
     long.value=position.coords.longitude;
    view.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
 }

 
 function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            
             document.getElementById("lokasi").value= "terkunci";
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("lokasi").value= "tidak terdeteksi";
            break;
        case error.TIMEOUT:
            document.getElementById("lokasi").value= "waktu habis";
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("lokasi").value= "---";
            break;
    }
 }
</script>