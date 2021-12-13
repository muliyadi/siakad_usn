<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LAPORAN NILAI PROGRAM STUDI TAHUN AKADEMIK</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>pddikti/nilai_prodi_ta" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>

<div class="form-group">
<label for="kd_prodi" class="col-md-2" >PROGRAM STUDI </label>
<div class="col-md-9">
<select name="kd_prodi" id="kd_prodi" class="form-control">
    <option value="all" >ALL</option>
<?php
	foreach($listprodi as $prodi)
	{
    ?>
     <option value="<?php echo $prodi->kd_prodi; ?>" ><?php echo $prodi->nm_prodi?></option>
    <?php
    }
?>  
</select>
</div>
</div>

<div class="form-group">
<label for="kd_prodi" class="col-md-2" >TAHUN AKADEMIK </label>
<div class="col-md-9">
<select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control">
<?php
	foreach($listta as $ta)
	{
    ?>
     <option value="<?php echo $ta->kd_tahun_ajaran; ?>" ><?php echo $ta->kd_tahun_ajaran?></option>
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