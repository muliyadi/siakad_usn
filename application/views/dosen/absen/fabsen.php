
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Absensi Perkuliahan</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url('dosen/aabsen')?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    
        <input type="hidden" class="form-control" id="kd_jadwal"  value="<?php echo $jadwal->kd_jadwal?>" name="kd_jadwal" placeholder="Kode Jadwal">
 
 
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">MATAKULIAH</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nm_mtk"  value="<?php echo $jadwal->nm_mtk?>" name="nm_mtk" placeholder="Matakuliah" readonly="true">
    </div>
    </div>
    
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">KELAS</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nm_mtk"  value="<?php echo $jadwal->kelas?>" name="kelas" placeholder="Kelas" readonly="true">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">JADWAL KULIAH</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="hari"  value="<?php echo $jadwal->hari.', '.$jadwal->jam ?>" name="hari" placeholder="HARI" readonly="true">
    </div>
        
    </div>

    
    
    <div class="form-group">
    <label for="pertemuan_ke" class="col-sm-2">PERTEMUAN KE </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="pertemuan_ke"   value="<?php echo $pertemuan_ke?>" name="pertemuan_ke" placeholder="Pertemuan ke: (1,2,3...14)">
    </div>
        
    </div>
    <div class="form-group">
    <label for="tgl_pertemuan" class="col-sm-2">TANGGAL PERTEMUAN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="tgl_pertemuan" readonly="true"  value="<?php echo $tgl_pertemuan?>" name="tgl_pertemuan" placeholder="TGL PERTEMUAN">
    </div>
        
    </div>
    <div class="form-group">
            <label for="kd_tahun_ajaran" class="col-sm-2">DURASI WAKTU ABSEN MAHASISWA (Menit)</label>
    <div class="col-sm-9">
        <input type="number" class="form-control" id="durasi_absen"  value="15" name="durasi_absen" placeholder="ISI DURASI WAKTU ABSEN MAHASISWA (Menit)" >
    </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">MATERI PEMBELAJARAN</label>
   <div id="materi" class="col-sm-9"> <!-- sebagai indentitas combo box -->
    <input type="text" name="materi" class="form-control" value="<?php echo $materi?>" autofocus="true">
    

          </div>
    </div>
        <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">LINK KELAS ONLINE</label>
   <div id="materi" class="col-sm-9"> <!-- sebagai indentitas combo box -->
    <input type="text" name="link_kelas" class="form-control" placeholder="copy paste disini link zoom/gmeetnya" value="<?php echo $link_kelas?>" autofocus="true">
    

          </div>
    </div>
    <button id="simpan" class="btn btn-primary">Buka Absen</button>

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

