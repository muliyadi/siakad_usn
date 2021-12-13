<div class="panel panel-primary">
<div class="panel-heading">
<h6 class='panel-title'>List Kurikulum </h6>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>KODE KURIKULUM</th>
		<td>NAMA KURIKULUM</td>
		<td>TAHUN AWAL BERLAKU</td>
		<td>TAHUN AKHIR BERLAKU</td>
		<td>AKTIF</td>
		<td>KD PRODI</td>
		<td>AKSI</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($listkurikulum as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->kd_kurikulum?>
		</td>
		<td>
			<?php echo $r->nm_kurikulum?>
		</td>
		<td>
			<?php echo $r->thn_awal?>
		</td>
		<td>
			<?php echo $r->thn_akhir?>
		</td>
		<td>
			<?php echo $r->kd_prodi?>
		</td>
		<td>
			<?php echo $r->aktif?>
		</td>
		<td>
			Edit/Delete
		</td>
		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a href="<?php echo base_url()?>bak/fta">TAMBAH</a>
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