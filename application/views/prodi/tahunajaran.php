<!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>TAHUN AJARAN BARUx</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>prodi/ata" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<table class='table table-bordered'>
		
		<tr><td>KODE TAHUN AKADEMIK<?php echo form_error('tahun_ajaran') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="kd_tahun_ajaran" id="kd_tahun_ajaran" placeholder="kd_tahun_ajaran" value="<?php echo $kd_tahun_ajaran; ?>"  />
            </td>
		</tr>
        <tr><td>Aktif<?php echo form_error('aktif') ?></td>
			<td><select name="aktif" class="form-control">
                    <?php
                        if($aktif=="Ya")
                        {
                            ?>
                            <option value="Ya" selected="selected">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <?php
                        }
                        else if($aktif=="Tidak")
                        {
                            ?>
                            <option value="Ya">Ya</option>
                            <option value="Tidak" selected="Tidak">Tidak</option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="-" selected="selected">- Pilih -</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <?php
                        }
                    ?>
                </select>
			</td>
		</tr>

		<tr><td colspan='2'><button type="submit" class="btn btn-primary">Simpan</button> 
				<a href="<?php base_url() ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</form>
</div >
</div >



                        
 