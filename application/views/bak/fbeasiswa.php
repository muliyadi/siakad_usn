<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM BEASISWA</h3>
</div >
<div class="panel-body">
<form accept-charset="utf-8" action="<?php echo base_url();?>bak/lbeasiswa" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table class="table">
<tr>
<td width="100">JENIS BEASISWA </td>
<td><select name="jns_beasiswa" id="jns_beasiswa" class="form-control"  >
  
<?php
	
    foreach($lbs as $bs)
    {

    ?>

    <option value="<?php echo $bs->jns_beasiswa; ?>" ><?php echo $bs->jns_beasiswa?></option>

    <?php
    }
?>

</select></td>
</tr>
<tr>
<td width="100">TAHUN AKADEMIK</td>
<td><select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($ta as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select></td>
</tr>
</table>
<button type="submit">Preview</button>
</form>
</div>
</div>