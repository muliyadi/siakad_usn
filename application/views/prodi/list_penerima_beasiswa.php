<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Mahasiswa Penerima Beasiswa</h3>
</div >
<div class="panel-body">
<table id="listdosen" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	<th>No</th><th>Jenis Beasiswa</th><th>NIM</th><th>Nama Mahasiswa</th><th>Angkatan</th><th>Nilai UKT</th><th>Semester</th><th>Status</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	if($list)
	{
    foreach ($list as $r) {
    ?>
	<tr>
	<td>
			<?php echo $start++?>
		</td>
	<td>	<?php echo $r->jenis_beasiswa?></td>
	<td>
			<?php echo $r->nim?>
		</td>

		<td>
			<?php echo $r->nm_mahasiswa?>
		</td>
		<td>
			<?php echo $r->angkatan	?>
		</td>
	
		<td>
			<?php echo $r->nilai_ukt	?>
		</td>
		<td>
			<?php echo $r->semester	?>
		</td>
		<td>
			<?php echo $r->status	?>
		</td>
			
				
	
	</tr>
	<?php
                            }
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

                         $('#listdosen').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>