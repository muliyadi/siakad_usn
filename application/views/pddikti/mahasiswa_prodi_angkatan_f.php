<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM EXPORT DATA MAHASISWA ALL PRODI</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>pddikti/mahasiswa_prodi_angkatan" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">
<label for="kd_prodi" class="col-md-2" >ANGKATAN </label>
<div class="col-md-9">
<select name="angkatan" id="angkatan" class="form-control">
<?php
	foreach($listangkatan as $angkatan)
	{
    ?>
     <option value="<?php echo $angkatan->tahun; ?>" ><?php echo $angkatan->tahun?></option>
    <?php
    }
?>  
</select>
</div>
</div>
<button type="submit">Export</button>
</form>
</div>
</div>