<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>EVALUASI KINERJA DOSEN OLEH MAHASISWA (EDOM)</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/save_quisioner" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" name="kd_jadwal" value="<?php echo $kd_jadwal?>">
   <input type="hidden" name="kd_tahun_ajaran" value="<?php echo $kd_tahun_ajaran?>">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <tr>
                    <td width="100px"><label>Nama Dosen</label></td><td>: <label><?php echo $dosen->nm_dosen?></label></td>
                </tr>
                <tr><td><label>Matakuliah</label></td><td>: <label><?php echo $matakuliah->nm_mtk?></label></td></tr>
            </table>
 <p><b>Petunjuk: <br>Berilah penilaian secara jujur, objektif, dan penuh tanggung jawab!<br> Mahasiswa yang mengisi Quisioner EDOM ini dijamin kerahasiaan datanya. </b></p>
        </div>
       
    <div class="row">
        
    <div class="col-md-3">
    <label for="nim" class="row" >1. Seberapa jelas rencana pembelajaran mata kuliah ini?</label>
    <div class="row">
       <input type="radio" id="jawab_1" name="jawab_1" value="1"> Tidak jelas / tidak pernah dijelaskan rencananya<br>
       <input type="radio" id="jawab_1" name="jawab_1" value="2"> Kurang jelas / diterangkan secara lisan <br>
       <input type="radio" id="jawab_1" name="jawab_1" value="3"> Kurang jelas / diterangkan secara lisan <br>
       <input type="radio" id="jawab_1" name="jawab_1" value="4"> Sangat jelas / diterangkan, dicetak dan dibagikan
       
    </div>
    </div>
    
    <div class="col-md-3">
    <label for="nim" class="row">2. Apakah rencana pembelajaran tersebut terlaksanan dengan baik?</label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_2" value="1"> Sangat sedikit yang terlaksanan dengan baik (<25 %).<br>
       <input type="radio" id="male" name="jawab_2" value="2"> Sedikit yang terlaksana dengan baik (>25% - 50%)<br>
       <input type="radio" id="male" name="jawab_2" value="3"> Banyak yang terlaksana dengan baik (>50%-75%)<br>
       <input type="radio" id="male" name="jawab_2" value="4"> Hampir semua terlaksanan dengan baik (>75%)

    </div>
    </div>
   
    <div class="col-md-3">
    <label for="nim" class="row">3. Rata-rata berapa lama diskusi / tanyajawab berlangsung pada setiap tatap muka? </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_3" value="1"> < 15menit Diskusi / tanya jawab berlangsung rata-rata <br>
       <input type="radio" id="male" name="jawab_3" value="2"> (15menit-30menit) (masih jarang dan kurang intensif)<br>
       <input type="radio" id="male" name="jawab_3" value="3"> (>30menit-1 jam) (banyak diskusi dan cukup intensif)<br>
       <input type="radio" id="male" name="jawab_3" value="4"> (>1 jam) (banyak diskusi dan sangat intensif)

    </div>
    </div>
   
    <div class="col-md-3">
    <label for="nim" class="row"> 4. Seberapa banyak materi yang bisa anda serap dengan jelas?  </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_4" value="1"> Sangat sedikit (kurang dari 20%) <br>
       <input type="radio" id="male" name="jawab_4" value="2"> Sedikit (kurang lebih 20%-40%)<br>
       <input type="radio" id="male" name="jawab_4" value="3"> Banyak (>40 % sampai 60 %)<br>
       <input type="radio" id="male" name="jawab_4" value="4"> Hampir seluruhnya (diatas 60%)

    </div>
    </div>
    
   
   </div>
   <div class="row">
        <div class="col-md-3">
    <label for="nim" class="row">  5. Seberapa besar manfaat dari tugas yang diberikan dosen?   </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_5" value="1"> Tidak banyak bermanfaat / menambah beban saja <br>
       <input type="radio" id="male" name="jawab_5" value="2"> Sedikit menambah kemampuan<br>
       <input type="radio" id="male" name="jawab_5" value="3"> Banyak menambah kemampuan<br>
       <input type="radio" id="male" name="jawab_5" value="4"> Sangat banyak menambah kemampuan

    </div>
    </div>
     <div class="col-md-3">
    <label for="nim" class="row">  6. Apakah tugas/tes/UTS mendapat evaluasi dan koreksi yang memadai?   </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_6" value="1"> Tidak pernah dibahas dan tidak pernah dikembalikan <br>
       <input type="radio" id="male" name="jawab_6" value="2"> Dibahas secara umum, berkas tidak dikembalikan<br>
       <input type="radio" id="male" name="jawab_6" value="3"> Dibahas secara rinci, berkas tidak dikembalikan<br>
       <input type="radio" id="male" name="jawab_6" value="4"> Dibahas secara rinci, berkas tidak dikembalikan

    </div>
    </div>
     <div class="col-md-3">
    <label for="nim" class="row">  7. Seberapa banyak anda mendapat materi yang up to date?    </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_7" value="1"> Kurang sekali <br>
       <input type="radio" id="male" name="jawab_7" value="2"> Kurang<br>
       <input type="radio" id="male" name="jawab_7" value="3"> Banyak<br>
       <input type="radio" id="male" name="jawab_7" value="4"> Sangat banyak

    </div>
    </div>
     <div class="col-md-3">
    <label for="nim" class="row">  8. Seberapa sering berlangsung tepat waktu baik awal maupun akhirnya?   </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_8" value="1"> Tidak pernah tepat waktu <br>
       <input type="radio" id="male" name="jawab_8" value="2"> Jarang tepat waktu<br>
       <input type="radio" id="male" name="jawab_8" value="3"> Sering tepat waktu<br>
       <input type="radio" id="male" name="jawab_8" value="4"> Selalu tepat waktu

    </div>
    </div>
    
   </div>
   
   <div class="row">
        <div class="col-md-3">
    <label for="nim" class="row">  9. Bentuk pembelajaran yang dijalankan, seberapa besar dapat meningkatkan minat dan semangat belajar?   </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_9" value="1"> Tidak banyak menambah minat  <br>
       <input type="radio" id="male" name="jawab_9" value="2"> Sedikit menambah minat<br>
       <input type="radio" id="male" name="jawab_9" value="3"> Banyak menambah minat<br>
       <input type="radio" id="male" name="jawab_9" value="4"> Sangat banyak menambah minat

    </div>
    </div>
     <div class="col-md-3">
    <label for="nim" class="row">  10. Apakah proses evaluasi/penilaian belajar mahasiswa jelas dan akademis?   </label>
    <div class="row">
   
  
       <input type="radio" id="male" name="jawab_10" value="1"> Tidak jelas <br>
       <input type="radio" id="male" name="jawab_10" value="2"> kurang jelas<br>
       <input type="radio" id="male" name="jawab_10" value="3"> jelas <br>
       <input type="radio" id="male" name="jawab_10" value="4"> Sangat jelas

    </div>
    </div>
   </div>
    <br>
    <br>
    <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
</form>

</div >
</div >
