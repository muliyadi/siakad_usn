<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'> DETAIL RENCANA PEMBELAJARAN</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Prodi/adetail_matakuliah" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
  <input type="hidden" name='kd_mtk' value="<?php echo $kd_mtk?>"/>
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">PERTEMUAN KE</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="pertemuan" readonly  name="pertemuan" value="<?php echo $pertemuan?>"  placeholder="PERTEMUAN">
    </div>
    </div>
        <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">CP MATAKULIAH</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="sub_cp_mk" autofocus name="sub_cp_mk"><?php echo $sub_cp_mk?></textarea>
       
    </div>
    </div>
        <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >MATERI PEMBELAJARAN [WAKTU]</label>
    <div class="col-md-10">
        
        <textarea class="form-control" id="materi_pembelajaran" name="materi_pembelajaran"   ><?php echo $materi_pembelajaran?></textarea>
    </div>
    </div>
    	
	<div class="form-group">
    <label for="nm_dosen" class="col-md-2" >METODE PEMBELAJARAN</label>
    <div class="col-md-10">
        
        <textarea class="form-control" id="metode_pembelajaran" name="metode_pembelajaran" ><?php echo $metode_pembelajaran?></textarea>
    </div>
    </div>
    <div class="form-group">
    <label for="indikator" class="col-md-2" >INDIKATOR</label>
    <div class="col-md-10">
        
        <textarea class="form-control" id="indikator" name="indikator" autofocus placeholder="INDIKATOR"><?php echo $indikator?></textarea>
    </div>
    </div>
	<div class="form-group">
    <label for="nm_dosen" class="col-md-2" >KRITERIA PENILAIAN</label>
    <div class="col-md-10">
       
         <textarea class="form-control" id="kriteria_bentuk_penilaian" name="kriteria_bentuk_penilaian" placeholder="KRITERIA PENILAIAN"><?php echo $kriteria_bentuk_penilaian?></textarea>
    </div>
    </div>


    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >BOBOT PENILAIAN [    %]</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="bobot_penilaian" name="bobot_penilaian"    value="<?php echo $bobot_penilaian?>" placeholder="BOBOT PENILAIAN">
    </div>
    </div>
	
<button class="btn btn-primary">Simpan</button>
	</form>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

               
				