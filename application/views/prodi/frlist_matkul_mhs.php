<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>MATAKULIAH YANG TELAH DITAWAR MAHASISWA</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   id="fdosen"action="<?php echo base_url(); ?>Prodi/list_matkul_mhs" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
           
    <div class="form-group">
    <label for="kd_dosen" class="col-md-2" >NIM</label>
    <div class="col-md-2">
        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM">
    </div>
        <div class="col-sm-7">
        <input type="text"class="form-control" id="nm_mahasiswa"  name="nm_mahasiswa" placeholder="NAMA MAHASISWA">
    </div>
    <div class="col-md-1">
        <input type="button"value="Cari"  data-toggle="modal" data-target="#myModaldosen" class="btn btn-small btn-primary" id="kd_dosen" placeholder="KODE DOSEN">
    </div>
    </div>
		 <div class="form-group">
                <label for="angkatan" class="col-sm-2">ANGKATAN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="angkatan"  value="" name="angkatan" placeholder="ANGKATAN">
                </div>
            </div> 
			

            <button class="btn btn-primary">Lanjut</button>
        </form>

    </div >
</div >


