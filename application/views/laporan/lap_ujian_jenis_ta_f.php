<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM LAPORAN UJIAN MAHASISWA PADA TAHUN AKADEMIK</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>prodi/get_lap_ujian_ta" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Tahun Akademik</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($listta as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select>

          </div>
    </div>
<div class="form-group">

 <label for="jenis_ujian" class="col-md-2" >Jenis Ujian </label>
<div class="col-md-9">
	 <select name="jenis_ujian" id="jenis_ujian" class="form-control"  >
     <option value="0">Proposal</option>
     <option value="1">Hasil</option>
     <option value="2">Skripsi</option>

</select>
</div>

</div>
<button type="submit">Preview</button>
</form>
</div>
</div>