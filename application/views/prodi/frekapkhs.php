<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>LAPORAN DAFTAR KHS MAHASISWA</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>prodi/rekap_krs" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table >

<tr>
<td>Tahun Akademik </td>
<td>
 <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($ta as $d)
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