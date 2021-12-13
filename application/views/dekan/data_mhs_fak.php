<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Mahasiswa</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
		
		 <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>NIK</th>
		<th>ANGKATAN</th>
		<th>PRODI</th>
		<th>Status</th>
		<td>Aksi</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
        
	
	
		<td ><?php echo $r->nim?></td>
		
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->NIK?></td>
		
			
		<td ><?php echo $r->angkatan?></td>
		<td ><?php echo $r->kd_prodi?></td>
        <td><?php echo		$r->status.'('.$r->status_akademik.')'?></td>
        	<td><a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%"><?php echo $r->no_hp?></a></td>
		
	
		

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>prodi/daftar_ujian">Tambah</a>
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
            "autoWidth": false
        });
        </script>







                            
           