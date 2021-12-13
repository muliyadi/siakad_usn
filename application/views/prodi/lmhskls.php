<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR MAHASISWA KELAS    </h3>
</div >
<div class="panel-body">
<div class="form-group">
<label for="kd_dosen_lama" class="col-sm-2">NAMA MATAKULIAH (SKS)</label>
<div class="col-sm-10">
    <input type="text" readonly="true" class="form-control required" id="nm_mtk"  value="<?php echo $data->nm_mtk.' ('.$data->sks.' )'; ?>" name="kd_dosen_lama" placeholder="Isi dengan Nomor Induk Kepegawaian USN">
                </div>
</div>
<div class="form-group">
<label for="kd_dosen_lama" class="col-sm-2">KELAS</label>
<div class="col-sm-10">
    <input type="text" readonly="true" class="form-control required" id="kelas"  value="<?php echo $data->kelas ?>" name="kelas" placeholder="KELAS">
                </div>
</div>

<BR>

<table id="test" class="table ">
<thead>
	<tr>
		<th>NO</th>
		<th>FOTO</th>
       <th>MAHASISWA</th>
		<th>ANGKATAN</th>
		<td>NILAI</td>
		<td>AKSI</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
        <input type="hidden" id="kd_jadwal" value="<?php echo $r->kd_jadwal?>">
        <input type="hidden" id="no_krs" value="<?php echo $r->no_krs?>">
		<input type="hidden" id="kd_mtk" value="<?php echo  $data->kd_mtk;?>">
		<td><?php echo $start++ ?></td>
		<td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= strtoupper($r->nim);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="40" height="60" ">
             </td>
	
		<td><?php echo $r->nm_mahasiswa.'/'.$r->nim?></td>
		<td><?php echo $r->angkatan?></td>
        <td>
        <select name="nilai" id="nilai">
<?php

    foreach($lnilai as $d)
    {
    $selected = '';
    if($d->huruf==$r->nilai)
    {
        $selected = 'selected="selected"';
    }
    if ($r->kd_prodi==$d->kd_prodi and $r->angkatan==$d->angkatan and $d->kd_nilai=="D") {
        
            
    ?>

    <option value="<?php echo $d->huruf; ?>" <?php echo $selected; ?>><?php echo $d->huruf?></option>
    <?php
    }elseif ($r->kd_prodi==$d->kd_prodi and $r->angkatan==$d->angkatan and $d->kd_nilai=="T") {
       ?>
       <option value="<?php echo $d->huruf; ?>" <?php echo $selected; ?>><?php echo $d->huruf?></option>
       <?php
    }
    }
?>
</select><input type="number" name="nilai2" id="nilai2" class="form-control nilai2">
            </td>

		<td><button  class="btn-xs btn-info updat">Simpan</button>
		
		</td>

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>
<button id="tutup" class="btn btn-primary tutup">Tutup Kelas</button>
<br>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">


 $("#test").on('click', '.updat', function(e) {
var currentRow = $(this).closest("tr");
    var no_krs = currentRow.find("#no_krs").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var nilai = currentRow.find("#nilai").val();

      var form_data = {
                                        no_krs: no_krs,
                                        kd_jadwal: kd_jadwal,
                                        nilai: nilai,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'prodi/unilai'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Tersimpan.");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});



        $('#test').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
        </script>







                            
           