<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR MAHASISWA BIMBINGAN   </h3>
</div >
<div class="panel-body">



<table id="test" class="table ">
<thead>
	<tr>
		<th>NO</th>
        <th>FOTO</th>
        <th>PRODI</th>
        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th>UKT</th>
		
		<th>NO HP</th>
		
		<th>STATUS</th>
		<td>AKSI</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($listmhsbimbingan as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
        <td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= $r->nim;
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80" ">
                    </td>
                    	<td ><?php echo $r->kd_prodi?></td>
		<td ><a href=<?php echo $foto?>><?php echo $r->nim?></a></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
		<td><?php echo $r->nilai_ukt?></td>
		
		<td><?php echo $r->no_hp?></td>
		
        	<td><?php echo $r->status?></td>


        </td>
		<td><a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%21">Chat</a>
			<a class="btn btn-info btn-xs" href="<?php echo base_url().'dosen/list_krs/'.$r->nim?>">PROFIL</a> 
	
		<a class="btn btn-info btn-xs" href="<?php echo base_url().'dosen/list_krs/'.$r->nim?>">KRS</a> 
			<a class="btn btn-danger btn-xs" href="<?php echo base_url().'dosen/lkhs/'.$r->nim?>">KHS</a> 
			<a class="btn btn-danger btn-xs" href="<?php echo base_url().'dosen/list_krs/'.$r->nim?>">TRANSKRIP</a> 
		</td>

		
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
                                        url: "<?php echo base_url().'dosen/unilai'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Alhamdulillah, Nilai sudah terinput");
                                               
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







                            
           