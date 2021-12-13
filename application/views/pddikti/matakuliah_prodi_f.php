<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DATA EXPORT MATAKULIAH </h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>pddikti/matakuliah_prodi" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>

<div class="form-group">
<label for="kd_prodi" class="col-md-2" >PROGRAM STUDI </label>
<div class="col-md-9">
<select name="kd_prodi" id="kd_prodi" class="form-control">
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


<button type="submit">Export</button>
</form>
</div>
</div>