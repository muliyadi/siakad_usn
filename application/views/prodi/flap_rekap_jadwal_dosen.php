<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LAPORAN JADWAL MENGAJAR DOSEN</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>prodi/lap_rekap_jadwal_dosen" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table >
<tr>
<td>Tahun Akademik </td>
<td>
	<select name='kd_tahun_ajaran' >
		<option value='20171'>20171</option>
		<option value='20172'>20172</option>
		<option value='20181'>20181</option>
		<option value='20182'>20182</option>
        <option value='20191'>20191</option>
	</select>
</td>


</tr>



</table>
<button type="submit">Preview</button>
</form>
</div>
</div>