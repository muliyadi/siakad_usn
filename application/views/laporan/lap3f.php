<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR MAHASISWA SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>laporan/plap3" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table class="table">

<tr>
<td>FILTER </td>
<td>
	<select name='filter' >
		<option value='all'>ALL</option>
		<option value='fakultas'>FAKULTAS</option>
		<option value='prodi'>PRODI</option>
	</select>
	<input type="text" name="nfilter" >
</td>


</tr>
<tr>
<td>ANGKATAN </td>
<td>
	<input type="text" name="angkatan" >
</td>


</tr>
<tr>
<td>TAHUN AJARAN </td>
<td>
	<input type="text" name="kd_tahun_ajaran" >
</td>


</tr>

</table>
<button type="submit">Preview</button>
</form>
</div>
</div>