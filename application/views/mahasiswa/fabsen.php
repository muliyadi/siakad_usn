<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Absensi Kuliah</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url().'mahasiswa/save_absen_kuliah'?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    
        <input type="hidden" class="form-control" id="kd_jadwal"  value="<?php echo $jadwal->kd_jadwal?>" name="kd_jadwal" placeholder="Kode Jadwal">
 
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">Matakuliah</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nm_mtk"  value="<?php echo $jadwal->nm_mtk?>" name="nm_mtk" placeholder="Matakuliah">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">SKS</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="sks"  value="<?php echo $jadwal->sks?>" name="sks" placeholder="SKS">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">Kelas</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nm_mtk"  value="<?php echo $jadwal->kelas?>" name="kelas" placeholder="Kelas">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">JADWAL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="hari"  value="<?php echo $jadwal->hari.', '.$jadwal->jam ?>" name="hari" placeholder="HARI">
    </div>
        
    </div>
    <div class="form-group">
    <label for="pertemuan_ke" class="col-sm-2">PERTEMUAN KE (1,2...14)</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="pertemuan_ke" autofocus="true"  value="<?php echo $pertemuan_ke?>" name="pertemuan_ke" placeholder="Pertemuan ke: (1,2,3...14)">
    </div>
        
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Materi Pokok/Sub Materi</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="submateri" class="form-control">
    

          </div>
    </div>
    
    <button id="simpan" class="btn btn-primary">Simpan</button>

</form>

</div >
</div >
                
                <!--batas akhir modal -->
                
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/angular.js')?>"></script>
                <script src="<?php echo base_url('assets/js/app.js')?>"></script>

                <script type="text/javascript">


            $('#tmahasiswa').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });

                </script>


