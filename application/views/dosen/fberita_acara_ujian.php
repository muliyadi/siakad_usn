<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pengaturan Kertas</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>dosen/berita_acara_final" method="post" class="form-user form-horizontal" id="lap_registrasi">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>

    
   <input type="hidden" name="kd_jadwal" value="<?php echo $kd_jadwal?>" class="form-control" readonly="on"> 
   

    
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jenis Kertas</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="kertas" value="A4" class="form-control" readonly="on">
    

          </div>
    </div>
   
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jarak Antar Baris</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="jarak_antar_baris" value="7" class="form-control" >
    

          </div>
    </div>
    
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">UTS/UAS</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="jujian" id="jujian" class="form-control"  >
  

 <option value="uts">Ujian Tengah Semeser</option>
    <option value="uas">Ujian Akhir Semester</option>

   

</select>

          </div>
    </div>
    
<button type="submit">Preview</button>
</form>
</div>
</div>