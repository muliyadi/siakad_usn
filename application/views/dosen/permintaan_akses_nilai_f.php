<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Pengajuan Akseks Input/Edit Nilai</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url().'dosen/save_permintaan_akses_nilai'?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" class="form-control" id="kd_jadwal"  value="<?php echo $jadwal->kd_jadwal?>" name="kd_jadwal" placeholder="KODE JADWAL">
   
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">Matakuliah</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nm_mtk"  value="<?php echo $jadwal->nm_mtk?>" readonly="true" name="nm_mtk" placeholder="MATAKULIAH">
    </div>
    </div>
    <div class="form-group">
    <label for="sks" class="col-sm-2">SKS</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="sks"  value="<?php echo $jadwal->sks?>" name="sks" readonly="true" placeholder="SKS">
    </div>
    </div>
    <div class="form-group">
    <label for="kelas" class="col-sm-2">Kelas</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="kelas"  value="<?php echo $jadwal->kelas?>" name="hari" readonly="true" placeholder="KELAS">
    </div>
    </div>
    <div class="form-group">
    <label for="penjelasan" class="col-sm-2">Penjelasan</label>
   <div id="penjelasan" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="penjelasan" autofocus class="form-control">
    

          </div>
    </div>

    <button id="simpan" class="btn btn-primary">Ajukan</button>

</form>

</div >
</div >
                
                <!--batas akhir modal -->
                
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/angular.js')?>"></script>
                <script src="<?php echo base_url('assets/js/app.js')?>"></script>


