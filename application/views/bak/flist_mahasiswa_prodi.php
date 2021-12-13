<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LIST MAHASISWA</h3>
</div >
<div class="panel-body">
<form accept-charset="utf-8" action="<?php echo base_url();?>bak/list_mahasiswa_angkatan" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">
			<label for="agama" class="col-md-2" ><font >Angkatan  (*)</font></label>
			<div class="col-md-10">
			<select name="angkatan" id="angkatan" class="form-control">

			<?php
			foreach($listangkatan as $angkatan)
			{

    ?>
    <option value="<?php echo $angkatan->tahun; ?>"><?php echo $angkatan->tahun?></option>

    <?php
    }
?>

</select>

     </div>
</div>

<button type="submit">Preview</button>
</form>
</div>
</div>