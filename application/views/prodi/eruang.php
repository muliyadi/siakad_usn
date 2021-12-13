<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>RUANG KULIAH</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Prodi/uruang" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
  
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">KODE RUANG</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="kd_ruang"  name="kd_ruang" value="<?php echo $kd_ruang?>" readonly placeholder="KODE RUANG">
    </div>
    </div>
        <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NAMA RUANG KULIAH</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nm_ruang" name="nm_ruang" value="<?php echo $nm_ruang?>" placeholder="NAMA RUANG KULIAH">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >KAPASITAS</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="kap_maksimal" name="kap_maksimal" value="<?php echo $kap_maksimal?>"placeholder="KAPASITAS">
    </div>
    </div>
	    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >FASILITAS</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="fasilitas" name="fasilitas"    value="<?php echo $fasilitas?>" placeholder="FASILITAS">
    </div>
    </div>
	
	
<button class="btn btn-primary">Simpan</button>
	</form>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

               
				