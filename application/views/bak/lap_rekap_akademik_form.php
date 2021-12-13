<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LAPORAN AKADEMIK MAHASISWA</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>bak/get_rekap_akademik_mhs" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<table class="table">
<tr>
<td >PROGRAM STUDI </td>
<td> <select name="kd_prodi" id="kd_prodi" class="form-control"  >
 

 
<?php
    
	foreach($listprodi as $prodi)
	{
   
   
    ?>

     <option value="<?php echo $prodi->kd_prodi; ?>" ><?php echo $prodi->nm_prodi?></option>

    <?php
    }
?>  


</select></td>
</tr>

<tr>
<td >DARI ANGKATAN </td>
<td><select name="angkatan" id="angkatan" class="form-control"  >
 

 
<?php
    
	foreach($listangkatan as $angkatan)
	{
   
   
    ?>

     <option value="<?php echo $angkatan->tahun; ?>" ><?php echo $angkatan->tahun?></option>

    <?php
    }
?>  


</select></td>
</tr>
<td >SAMPAI ANGKATAN </td>
<td><select name="angkatan2" id="angkatan" class="form-control"  >
 

 
<?php
    
	foreach($listangkatan as $angkatan)
	{
   
   
    ?>

     <option value="<?php echo $angkatan->tahun; ?>" ><?php echo $angkatan->tahun?></option>

    <?php
    }
?>  


</select></td>
</tr>
<tr>
<td >TAHUN AKADEMIK </td>
<td> <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
 

 
<?php
    
	foreach($listta as $row1)
	{
   
   
    ?>

     <option value="<?php echo $row1->kd_tahun_ajaran; ?>" ><?php echo $row1->kd_tahun_ajaran?></option>

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