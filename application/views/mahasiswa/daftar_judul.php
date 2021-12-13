<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR USULAN JUDUL SKRIPSI</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>mahasiswa/ajudul" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<input type="hidden" name="aksi" value="<?php echo $aksi?>" />

<div class="form-group">
<label for="tgl_reg_bank" class="col-md-2">NO DAFTAR</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="no_daftar" id="no_daftar" placeholder="No Daftar" value="<?php echo $daftar_judul->no_daftar; ?>" />
			</div>
			</div>

<div class="form-group">
<label for="tgl_reg_bank" class="col-md-2">TGL DAFTAR</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="tgl_daftar" id="tgl_daftar" placeholder="Tgl Daftar" value="<?php echo  $daftar_judul->tgl_daftar; ?>" />
			</div>
			</div>
<div class="form-group">
    <label for="NIM" class="col-md-2" >MAHASISWA</label>
    <div class="col-md-2">
        <input type="text"  data-toggle="modal"  class="form-control required" value="<?php echo  $daftar_judul->nim ?>"  id="nim" name="nim" placeholder="NIM">
    </div>
    
</div>
<div class="form-group">
<label for="judul" class="col-md-2">JUDUL PENELITIAN</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="judul" id="judul" placeholder="Judul Penelitian" value="<?php echo  $daftar_judul->judul; ?>" />
			</div>
			</div>
<button type="submit">Simpan</button>
</div>
</div>
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

           
          

