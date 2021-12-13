<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pilih Angkatan</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>prodi/lmhs" method="post" class="form-user form-horizontal" id="aktifta">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Angkatan</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="angkatan" id="angkatan" class="form-control"  >
  
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
<button type="submit">Pilih</button>
</form>
</div>
</div>