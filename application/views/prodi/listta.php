<div class="panel panel-primary">
<div class="panel-heading">
<h6 class='panel-title'>DATA TAHUN AKADEMIK </h6>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<td>TAHUN AJARAN</td>
		<td>STATUS</td>
		<td>AKSI</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($listta as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->kd_tahun_ajaran?>
		</td>

		<td>
			<?php echo $r->aktif?>
		</td>
        <td>Edit</td>
		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a href="<?php echo base_url()?>prodi/fta">TAMBAH</a>
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