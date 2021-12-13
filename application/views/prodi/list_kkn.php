<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>LIST PENDAFTAR KKN    </h3>
</div >
<div class="panel-body">


<table id="test" class="table ">
<thead>
	<tr>
		<th>NO</th>
		<th>TGL DAFTAR</th>
       <th>MAHASISWA</th>
		<th>ANGKATAN</th>
		<td>JUMLAH SKS</td>
		<td>TRANSKRIP NILAI</td>
		<td>STATUS</td>
		<td>AKSI</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list_kkn as $r) {
    ?>
	<tr>
        
		<td><?php echo $start++ ?></td>
		<td><?php  echo $r->tgl_daftar ?></td>
	
	
		<td><?php echo $r->nm_mahasiswa.'/'.$r->nim?></td>
		<td><?php echo $r->angkatan?></td>
        <td><?php echo $r->jum_sks?></td>
        <td><a href="<?php echo $r->file_transkrip?>" class="btn btn-xs btn-warning">Unduh</a><a href="<?php echo base_url('prodi/transkrip_nilai2').'/'.$r->nim?>" class="btn btn-xs btn-default">View</a></td>
        <td><?php echo $r->status?></td>
		<td><a href="<?php echo base_url('prodi/terima_kkn').'/'.$r->nim?>"  class="btn btn-xs btn-success updat">Terima</a><a  href="<?php echo base_url('prodi/tolak_kkn').'/'.$r->kd_tahun_ajaran.'/'.$r->nim?>" class="btn btn-xs btn-warning updat">Tolak</a><a  href="<?php echo base_url('prodi/hapus_kkn').'/'.$r->kd_tahun_ajaran.'/'.$r->nim?>" class="btn btn-xs btn-primary updat">Hapus</a>
		
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




        $('#test').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
        </script>







                            
           