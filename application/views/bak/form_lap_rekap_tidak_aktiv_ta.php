<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM REPORT MAHASISWA TIDAK REGISTRASI / SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>bak/preview_lihst_mhs_tidak_aktif_ta" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table class="table">

<tr>
<td width="100">KODE TAHUN AJARAN </td>
<td><input type="text" name="kd_tahun_ajaran" value="<?php echo $kd_tahun_ajaran?>"></td>
</tr>
</table>
<button type="submit">Preview</button>
</form>
</div>
</div>