<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM USER</h3>
    </div >
    <div class="panel-body">
       <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>admin/auser" method="post" class="form-user form-horizontal" id="fuser">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <input type="hidden" value="<?php echo $aksi ?>" name="aksi">
            <div class="form-group">
                <label for="userid" class="col-sm-2">User ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="userid"  name="userid" value="<?php echo $userid ?>"  placeholder="User ID">
                </div>
            </div>
			<div class="form-group">
                <label for="nama" class="col-sm-2">Nama User</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="nama" name="nama" value="<?php echo $nama ?>"  placeholder="Nama User">
                </div>
            </div>
			<div class="form-group">
                <label for="userid" class="col-sm-2">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control required" id="password"  name="password" value="<?php echo $password ?>"  placeholder="Password">
                </div>
            </div>
			<div class="form-group">
                <label for="userid" class="col-sm-2">Retype Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control required" id="repassword"  name="repassword" placeholder="Ulang Password">
                </div>
            </div>
			<div class="form-group">
    <label for="level" class="col-md-2" >Level Akses</label>
    <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
	<select name="level" id="level" class="form-control required"  >

	<?php
	foreach($listlevel as $d)
    {
		$selected = '';
		if($level==$d->kd_level_akses){
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $d->kd_level_akses; ?>" <?php echo $selected; ?>><?php echo $d->nm_level_akses?></option>
	
    <?php
    }
?>

</select>
          </div>
    </div>
	<div class="form-group">
	<label for="home_base" class="col-md-2" >Home Base</label>
    <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
	<select name="home_base" id="home_base" class="form-control required"  >
	<option></option>
	<?php
	foreach($listhomebase as $d)
    {
		$selected = '';
		if($home_base==$d->kd_homebase){
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $d->kd_homebase; ?>" <?php echo $selected; ?>><?php echo $d->nm_homebase?></option>
	
    <?php
    }
?>

</select>
          </div>
    </div>
	<div class="form-group">
                <label for="aktif" class="col-md-2" >Status</label>
                <div class="col-sm-10">
                    <select name="aktif" class="form-control required">
					
                        <?php
                        if ($aktif == "Ya") {
                            ?>
                            <option value="Ya" selected="selected">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <?php
                        } else if ($aktif == "Tidak") {
                            ?>
                            <option value="Tidak" selected="selected">Tidak</option>
                            <option value="Ya">Ya</option>
                            <?php
                        } else {
                            ?>
                           
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            

            <button class="btn btn-primary">Simpan</button>
        </form>

    </div >
</div >


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>



<script>
    $('#notifications').slideDown('slow').delay(1200).slideUp('slow');
</script>
<script type="text/javascript">
       $(document).ready(function(){
          $("#fuser").validate();
       });
    </script>