<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM REPORT MAHASISWA TIDAK REGISTRASI / SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>prodi/jadwal_ujianx" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">

 <label for="Tgl Ujian" class="col-md-2" >TANGGAL UJIAN </label>
<div class="col-md-9">
	 <select name="tgl_ujian" id="tgl_ujian" class="form-control"  >
 

 
<?php
    
	foreach($ltgl_ujian as $row)
	{
   
   
    ?>

     <option value="<?php echo $row->tgl_ujian; ?>" ><?php echo $row->tgl_ujian?></option>

    <?php
    }
?>  


</select>
</div>

</div>
<button type="submit">Preview</button>
</form>
</div>
</div>