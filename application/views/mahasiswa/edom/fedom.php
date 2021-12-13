<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>EVALUASI DOSEN OLEH MAHASISWA (EDOM)</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/save_edom2" method="post" class="form-user form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
   
                                <table class="word-table">
                              <tr><th colspan=2><u>Petunjuk:</u></th></tr>
                              <tr><td colspan=2>1. Berikan penilaian terhadap komponen evaluasi di bawah ini dengan memilih jawaban pada pilihan jawaban yang tersedia sesuai dengan yang saudara ketahui</td></tr>
                                 <tr><td colspan=2>2. Berilah penilaian secara jujur, objektif, dan penuh tanggung jawab terhadap DOSEN Saudara. Informasi yang Saudara berikan akan dipergunakan sebagai bahan masukan bagi Dosen dan tidak akan berpengaruh terhadap status Saudara sebagai Mahasiswa.
</td></tr>
                  <tr><th colspan=2><br></th></tr>
                                 </table>  
                                <table class="word-table">
                         
                             <tr><th width="160">Nama Matakuliah</td><td>: <?php echo $jadwal->nm_mtk?></td></tr>
                              <tr><th>Kelas</td><td>:  <?php echo $jadwal->kelas?></td></tr>
                             <tr><th>Nama Dosen</td><td>:  <?php echo $jadwal->nm_dosen?></td></tr>
                             
             
                                </table>
                                <br>
                                        <h5><b><u>Pernyataan!</u></b></h5>
  
<div>
     <label> <?php echo $soal->pertanyaan?></label>
     <input type="hidden" id='no_soal' name="no_soal" value="<?php echo $soal->nosoal?>"  />
            <input type="hidden" id='kd_jadwal' name="kd_jadwal" value="<?php echo $jadwal->kd_jadwal?>"  />
             <input type="hidden" id='kd_mtk' name="kd_mtk" value="<?php echo $jadwal->kd_mtk?>"  />
             <input type="hidden" id='kd_dosen' name="kd_dosen" value="<?php echo $jadwal->kd_dosen?>"  />
              <input type="hidden" id='no_krs' name="no_krs" value="<?php echo $no_krs?>"  />
</div>
<div>
                <input type="radio" id="jawaban" name="jawaban" value="1"  /> Tidak Setuju
                <input type="radio" id="jawaban" name="jawaban" value="2"  /> Kurang Setuju 
                <input type="radio" id="jawaban" name="jawaban" value="3"  /> Cukup Setuju
                 <input type="radio"  id="jawaban" name="jawaban" value="4"  /> Setuju
                <input type="radio"  id="jawaban" name="jawaban" value="5"  /> Sangat Setuju
</div>
            
    
    
	
    

	
	 <div class="text-input" align="left">
	     <br>
        <input type="submit" class="btn btn-sm btn-primary" name="register" value="Submit" onclick="return radioValidation();" />
    </div>
	

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

               
			
				<script>   
					$('#notifications').slideDown('slow').delay(7000).slideUp('slow');
				</script>
				
				<script type="text/javascript">
    function radioValidation(){

        var jawaban = document.getElementsByName('jawaban');
        var genValue = false;

        for(var i=0; i<jawaban.length;i++){
            if(jawaban[i].checked == true){
                genValue = true;    
            }
        }
        if(!genValue){
            alert("Please Choose the answer");
            return false;
        }

    }
</script>