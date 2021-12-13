<!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>MASTER DATA KEGIATAN AKADEMIK</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Bak/aka" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<table class='table table-bordered'>
		<tr><td>KODE KEGIATAN <?php echo form_error('kd_kegiatan') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="kd_kegiatan" id="kd_kegiatan" placeholder="kd_kegiatan" value="<?php echo $kd_kegiatan; ?>" /></td>
		<tr><td>NAMA KEGIATAN <?php echo form_error('nm_kegiatan') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="nm_kegiatan" id="nm_kegiatan" placeholder="nm_kegiatan" value="<?php echo $nm_kegiatan; ?>"  />
            </td>
        <tr><td>DESKRIPSI KEGIATAN<?php echo form_error('deskripsi') ?></td>
			<td><input type="text" class="form-control" name="deskripsi" value="<?php echo $deskripsi; ?>" /> </td>
		<tr><td colspan='2'><button type="submit" class="btn btn-primary">Simpan</button> 
				<a href="<?php base_url() ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</form>
</div >
</div >



                        
 