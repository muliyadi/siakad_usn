<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>REKAP ABSENSI DOSEN</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    <th>
			PRODI
		</th>
			    <th>
			SEMESTER
		</th>
		<th>
			PERTEMUAN KE
		</th>
		<th>
			JUMLAH
		</th>
		<th>AKSI</th>
	   </TR>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
	    <td>
			<?php echo $r->nm_prodi?>
		</td>
		<td>
			<?php echo $r->semester_ke?>
		</td>
	<td>
			<?php echo $r->pertemuan_ke?>
		</td>
		<td>
			<?php echo $r->jumlah?>
		</td>
			<td>
			<a href="<?php echo base_url('prodi/list_jadwal_absensi')?>">Detail</a>
		</td>
	
			
		

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
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