<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LAPORAN REGISTRASI MAHASISWA PER SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>Laporan/plap1" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table class="table">


<tr>
<td width="100">TAHUN AKADEMIK </td>
<td>
	<SELECT name='kd_tahun_ajaran' class="form-control" >
	<?php
	
    foreach($listthnajaran as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>
					
	</SELECT>
</td>
</tr>
<tr>
    <td>JENIS REGISTRASI PEMBAYARAN</td><td><select name="kd_registrasi" id="kd_registrasi" class="form-control"  >
 

 
<?php
    
	foreach($listjns_registrasi as $jns_reg)
	{
   
   
    ?>

     <option value="<?php echo $jns_reg->kd_registrasi; ?>" ><?php echo $jns_reg->nm_registrasi?></option>

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