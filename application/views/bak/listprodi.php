<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR  PROGRAM STUDI </h3>
</div >
<div class="panel-body">

<table id="tabel" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>KODE PRODI</th>
		<td>NAMA PRODI</td>
		<td>FAKULTAS</td>
		<td>KATUA PRODI</td>
		<td>NIDNK</td>
		<td>STATUS AKREDITAS</td>
			<td>AKSI</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($prodi as $r) {
    ?>
	<tr>
		<td><?php echo $r->kd_prodi?></td>
		<td><?php echo $r->nm_prodi?></td>
		<td><?php echo $r->kd_fak?></td>
		<td><?php echo $r->ka_prodi?></td>
		<td><?php echo $r->nidn?></td>
		<td><?php echo $r->status_akreditasi?></td>
			<td><a href="<?php echo base_url('bak/edit_prodi').'/'.$r->kd_prodi?>" class="btn btn-info btn-xs">Edit</a>
		<a href="<?php echo base_url('bak/delete_prodi').'/'.$r->kd_prodi?>" class="btn btn-warning btn-xs">Delete</a></td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-sm" href="<?php echo base_url()?>bak/fprodi">Tambah Data</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#tabel').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
                    </script>