<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR MAHASISWA SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>laporan/plap52" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
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
<td>SEMESTER </td>
<td>
	<input type="text" name="semester" >
</td>


</tr>

</table>
<button type="submit">Preview</button>
</form>
</div>
</div>