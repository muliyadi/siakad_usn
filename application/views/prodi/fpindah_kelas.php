<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Pindah Kelas Mahasiswa</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>prodi/pindah_kelas" method="post" class="form-user form-horizontal" id="aktifta">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" class="form-control" id="kd_jadwal_asal"  value="<?php echo $mtk->kd_jadwal ?>" name="kd_jadwal_asal" placeholder="NIM">
		<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">NIM</label>
     <div class="col-sm-10">
        <input type="text" class="form-control" id="nim"  value="<?php echo $mhs->nim ?>" name="nim" placeholder="NIM">
                </div>
    </div>
		<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">NAMA MAHASISWA</label>
     <div class="col-sm-10">
        <input type="text" class="form-control" id="nm_mahasiswa"  value="<?php echo $mhs->nm_mahasiswa ?>" name="nm_mahasiswa" placeholder="NIM">
                </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">KELAS ASAL</label>
     <div class="col-sm-8">
        <input type="text" class="form-control" id="kd_mtk"  value="<?php echo $mtk->kd_mtk ?>" name="kd_mtk" placeholder="NIM">
                </div>
                <div class="col-sm-2">
        <input type="text" class="form-control" id="kelas"  value="<?php echo $mtk->kelas ?>" name="kelas" placeholder="NIM">
                </div>
    </div>
	
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Pilih Kelas Tujuan</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_kelas_tujuan" id="kd_kelas_tujuan" class="form-control"  >
  
<?php
	
    foreach($listkelas as $kelas)
    {

    ?>

    <option value="<?php echo $kelas->kd_jadwal; ?>" ><?php echo $kelas->kd_mtk.'->Kelas: '.$kelas->kelas?></option>

    <?php
    }
?>

</select>

          </div>
    </div>
<button type="submit">Pilih</button>
</form>
</div>
</div>