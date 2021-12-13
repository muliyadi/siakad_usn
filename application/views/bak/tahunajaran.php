<!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>TAHUN AKADEMIK BARU</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Bak/ata" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<table class='table table-bordered'>
		
		<tr><td>TAHUN KADEMIK<?php echo form_error('tahun_ajaran') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="tahun_ajaran" value="<?php echo $tahun_ajaran; ?>"  />
            </td>
		</tr>
        <tr><td>SEMESTER<?php echo form_error('semester') ?></td>
			<td><select name="semester" class="form-control">
                    <?php
                        if($semester=="GENAP")
                        {
                            ?>
                            <option value="GENAP" selected="selected">GENAP</option>
                            <option value="GANJIL">GANJIL</option>
                            <?php
                        }
                        else if($semester=="GANJIL")
                        {
                            ?>
                            <option value="GENAP">GENAP</option>
                            <option value="GANJIL" selected="selected">GANJIL</option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="-" selected="selected">- Pilih -</option>
                            <option value="GENAP">GENAP</option>
                            <option value="GANJIL">GANJIL</option>
                            <?php
                        }
                    ?>
                </select>
			</td>
		</tr>
		<tr><td>Deskripsi<?php echo form_error('keterangan') ?></td>
			<td><input type="text" autofocus="true" class="form-control" name="keterangan" id="keterangan" placeholder="Deskripsi" value="<?php echo $keterangan; ?>"  />
            </td>
		</tr>
		<tr><td colspan='2'><button type="submit" class="btn btn-primary">Simpan</button> 
				<a href="<?php base_url() ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</form>
</div >
</div >



                        
 