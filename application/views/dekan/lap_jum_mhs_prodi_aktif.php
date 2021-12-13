<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>LAPORAN JUMLAH TOTAL MAHASISWA AKTIF SETIAP PRODI</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th width="40">
			FAKULTAS
		</th>
		<td>
			PROGRAM STUDI
		</td>
		<td>
			JUMLAH TOTAL
		</td>
		<td>
			STATUS
		</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($list as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->kd_fak?>
		</td>
		<td>
			<?php echo $r->nm_prodi.' / '.$r->kd_prodi?>
		</td>

		<td>
			<?php echo $r->jumlah?>
		</td>
		<td>
			<?php echo $r->status?>
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
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
                    </script>