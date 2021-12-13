<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pilih Tahun Akademik</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>prodi/setta" method="post" class="form-user form-horizontal" id="aktifta">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Tahun Akademik</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($list as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select>

          </div>
    </div>
    <div class="form-group">
    <label for="jenis_registrasi" class="col-sm-2">Jenis Registrasi</label>
   <div id="combo_jenis_registtrasi" class="col-sm-10">
    	<select name='jenis_registrasi' >
		<option value='SPP'>SPP</option>
		<option value='CUTI'>CUTI</option>
		<option value='SKRIPSI'>SKRIPSI</option>
		<option value='HASIL'>HASIL</option>
		<option value='HASIL'>PROPOSAL</option>
	    </select>
	    
          </div>
    </div>
    
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Status</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="status" id="status" class="form-control"  >

    <option value="sudah">Sudah</option>
        <option value="belum">Belum</option>

    

</select>

          </div>
    </div>
    
<button type="submit">Pilih</button>
</form>
</div>
</div>