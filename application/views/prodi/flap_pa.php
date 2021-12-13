<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR MAHASISWA BIMBINGAN DOSEN PER TA</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>prodi/preview_pa" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table >
<tr>
<td>Dosen </td>
<td>
	 <select name="kd_dosen" id="kd_dosen" class="form-control"  >
  
<?php
	
    foreach($listdosen as $dosen)
    {

    ?>

    <option value="<?php echo $dosen->kd_dosen; ?>" ><?php echo $dosen->nm_dosen?></option>

    <?php
    }
?>

</select>
</td>


</tr>
<tr>
<td>Tahun Akademik </td>
<td>
 <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($listta as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select>
</td>


</tr>
<tr>
<td>Jarak Spasi Antar Baris Tabel </td>
<td>
    <input type="text" name="jarak" value="3"  class="form-control" >
</td>


</table>
<button type="submit">Preview</button>
</form>
</div>
</div>