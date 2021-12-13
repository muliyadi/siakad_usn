<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Cetak Berita Acara Ujian (B.A.U)</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>prodi/berita_acara_final_bau" method="post" class="form-user form-horizontal" id="lap_registrasi">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">
    <label for="jenis_registrasi" class="col-sm-2">Kode Jadwal</label>
    <div class="col-sm-10"><input type="text" name="kd_jadwal" value="<?php echo $kd_jadwal?>" class="form-control" readonly="on"> </div>
    </div>


    
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jenis Kertas</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="kertas" value="A4" class="form-control" readonly="on">
    

          </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Posisi</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="posisi" value="L" class="form-control" readonly="on">
    

          </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jarak Antar Baris</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="jarak_antar_baris" value="7" class="form-control" readonly="on">
    

          </div>
    </div>
        <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Tambahan Baris Absen</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="jumlah" value="5" class="form-control" readonly="on">
    

          </div>
    </div>
    
<button type="submit">Cetak B.A.U Final</button>
</form>
</div>
</div>