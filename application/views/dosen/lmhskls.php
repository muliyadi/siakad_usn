<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Daftar Mahasiswa <br>  <?php echo $data->nm_mtk?>  <?php echo $data->kelas?>  </h3>
</div >
<div class="panel-body table-responsive">



<table id="test" class="table table-responsive">
<thead>
	<tr>
		<th>FOTO</th>
		<th>MAHASISWA</th>
		<th>NILAI AKHIR (0-100)</th>
		<th>NILAI MUTU</th>

			</tr>
</thead>
<tbody>
<?php
	$start = 1;
	$kd_jadwal='';
    foreach ($list as $r) {
        $kd_jadwal=$r->kd_jadwal;
    ?>
	<tr>
        <input type="hidden" id="kd_jadwal" value="<?php echo $r->kd_jadwal?>">
        <input type="hidden" id="no_krs" value="<?php echo $r->no_krs?>">
		<input type="hidden" id="kd_mtk" value="<?php echo  $data->kd_mtk?>">
			<input type="hidden" id="nim" value="<?php echo  $r->nim?>">
	
		<td align="center"><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= strtoupper($r->nim);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="120" height="135" ">
                    
             </td>
		
		<td><?php echo $r->nim?><br><?php echo $r->nm_mahasiswa?><br><?php echo $r->angkatan?><br>
		<a class="btn btn-info btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum!!!"><?php echo $r->no_hp?></a><br>
		</td>
	
        
       
        <td><input type="number" id="nilaix" name="nilaix" value="<?php echo $r->nilai_angka ?>" class="form-control nilaix">
        <td><input type="text" id="nilai_mutu" name="nilai_mutu" class="form-control nilai_mutu" value="<?php echo $r->nilai ?>" readonly="true"></td>
      
        
            </td>
        </td>
		

		
	</tr>
	<?php
                            }
                            ?>
</tbody>

</table>
<a href="<?php echo base_url('dosen/revisi').'/'.$kd_jadwal?>" class="btn btn-info col-md-6" >Revisi</a>
<a href="<?php echo base_url('dosen/selesai').'/'.$kd_jadwal?>" class="btn btn-success col-md-6" >Selesai</a>

<table class="table">
<tr><td>Tignkat Kemampuan</td><td>Huruf</td><td>Angka</td><td>Derajat Mutu</td></tr>
<tr><td>86.00-100</td><td>A</td><td>4.0</td><td>Istimewa</td></tr>
<tr><td>81.00-85.99</td><td>AB</td><td>3.5</td><td>Baik Sekali</td></tr>
<tr><td>76.00-80.99</td><td>B</td><td>3.0</td><td>Baik</td></tr>
<tr><td>71.00-75.99</td><td>BC</td><td>2.5</td><td>Cukup Baik</td></tr>
<tr><td>61.00-70.99</td><td>C</td><td>2.0</td><td>Cukup</td></tr>
<tr><td>51.00-60.99</td><td>CD</td><td>1.5</td><td>Kurang Cukup</td></tr>
<tr><td>41.00-50.99</td><td>D</td><td>1.0</td><td>Kurang</td></tr>
<tr><td>0-40.99</td><td>E</td><td>0.0</td><td>Gagal</td></tr>
</table>


</div>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 
 


<script type="text/javascript">
$("#test").on('click', '.updatex', function(e) {
    
var currentRow = $(this).closest("tr");
    var no_krs = currentRow.find("#no_krs").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var kd_mtk = currentRow.find("#kd_mtk").val();
var nim = currentRow.find("#nim").val();
    var nilai = currentRow.find("#nilaix").val();
    

      var form_data = {
                                        no_krs: no_krs,
                                        kd_jadwal: kd_jadwal,
                                       
                                        nilai:nilai, 
                                        kd_mtk: kd_mtk,
                                        nim: nim,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/ajax_unilai'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                            alert("tersimpan");
                                            }else
                                            {
                                            alert("gagal");
                                            }
                                    
                                         
                                        }
                                    });

    
});
        </script>


<script type="text/javascript">
$("#test").on('change', '.nilaix', function(e) {
var currentRow = $(this).closest("tr");
var nilai = currentRow.find("#nilaix").val();
if (nilai >= 86){
        grade = "A"
    } else if(nilai >= 81) {
        grade = "AB"
    } else if(nilai >= 76) {
        grade = "B"
    } else if(nilai >= 71) {
        grade = "BC"
    } else if(nilai >= 61) {
        grade = "C"
    } else if(nilai >= 51) {
        grade = "CD"
    } else if(nilai >= 41) {
         grade = "D"
    } else { 
        grade = "E";
    }
    currentRow.find(".nilai_mutu").val(grade);
    var currentRow = $(this).closest("tr");
    var no_krs = currentRow.find("#no_krs").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var kd_mtk = currentRow.find("#kd_mtk").val();
   
  
    

      var form_data = {
                                        no_krs: no_krs,
                                        kd_jadwal: kd_jadwal,
                                       
                                        nilai:nilai, 
                                        kd_mtk: kd_mtk,
                                        
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/ajax_unilai'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                            alert("tersimpan");
                                            }else
                                            {
                                            alert("gagal");
                                            }
                                    
                                         
                                        }
                                    });
});
</script>






                            
           