<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Absen <br> <?php echo $jadwal->nm_mtk?><br>Kelas: <?php echo $jadwal->kelas?><br>Pertemuan ke: <?php echo $pertemuan_ke?>   </h3>
</div >
<div class="panel-body">


<table id="test" class="table ">
<thead>
	<tr>
	
        <TH>MAHASISWA</TH>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
        <input type="hidden" id="kd_jadwal" value="<?php echo $r->kd_jadwal?>">
        <input type="hidden" id="pertemuan_ke" value="<?php echo $r->pertemuan_ke?>">
        <input type="hidden" id="nim" value="<?php echo  $r->nim;?>">
        
			<td align="center"><?php echo '['.$start++.']' ?> <br>
			<?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= strtoupper($r->nim);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="100" height="120" ><br><?php echo $r->nim?> <br>
		<?php echo $r->nm_mahasiswa?><br><button  class="btn btn-success hadir">Hadir</button><button  class="btn btn-info izin">Izin</button><button  class="btn btn-warning sakit">Sakit</button><button  class="btn btn-danger tidak">Alpa</button></td>
	
		
        

	

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

 $("#test").on('click', '.hadir', function(e) {
var currentRow = $(this).closest("tr");
    var nim = currentRow.find("#nim").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var pertemuan_ke = currentRow.find("#pertemuan_ke").val();
     var hadir = 'H';

      var form_data = {
                                        nim: nim,
                                        kd_jadwal: kd_jadwal,
                                        pertemuan_ke: pertemuan_ke,
                                        hadir: hadir,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/hadir'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Terimpan, Keterangan Hadir");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});
$("#test").on('click', '.sakit', function(e) {
var currentRow = $(this).closest("tr");
    var nim = currentRow.find("#nim").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var pertemuan_ke = currentRow.find("#pertemuan_ke").val();
     var hadir = 'S';
      var form_data = {
                                        nim: nim,
                                        kd_jadwal: kd_jadwal,
                                        pertemuan_ke: pertemuan_ke,
                                        hadir: hadir,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/sakit'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Sudah tersimpan, Keterangan Sakit...!!!");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});
$("#test").on('click', '.izin', function(e) {
var currentRow = $(this).closest("tr");
    var nim = currentRow.find("#nim").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var pertemuan_ke = currentRow.find("#pertemuan_ke").val();
     var hadir = 'I';

      var form_data = {
                                        nim: nim,
                                        kd_jadwal: kd_jadwal,
                                        pertemuan_ke: pertemuan_ke,
                                        hadir: hadir,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/izin'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Sudah tersimpan, Keterangan Izin...!!!");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});

$("#test").on('click', '.tidak', function(e) {
var currentRow = $(this).closest("tr");
    var nim = currentRow.find("#nim").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var pertemuan_ke = currentRow.find("#pertemuan_ke").val();
     var hadir = 'A';

      var form_data = {
                                        nim: nim,
                                        kd_jadwal: kd_jadwal,
                                        pertemuan_ke: pertemuan_ke,
                                        hadir: hadir,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/tidakhadir'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Sudah tersimpan, Keterangan Alpa...!!!");
                                               
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
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
 </script>







                            
           