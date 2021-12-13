<div class="panel panel-primary">
<div class="panel-heading">
<h6 class='panel-title'>List Kegiatan Akademik </h6>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>KODE KEGIATAN</th>
		<td>NAMA KEGIATAN</td>
		<td>DESKRIPSI</td>
		<td>AKSI</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($listkegiatan as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->kd_kegiatan?>
		</td>
		<td>
			<?php echo $r->nm_kegiatan?>
		</td>
		<td>
			<?php echo $r->deskripsi?>
		</td>
		<td>
		     <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'bak/fka/' . $r->kd_kegiatan ?>">Edit</a> 
                            <a class="btn btn-warning btn-xs" href="<?php echo base_url() . 'bak/dka/' . $r->kd_kegiatan ?>" onclick="return confirm('Anda yakin?');">Delete</a>

		</td>
		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a href="<?php echo base_url()?>bak/fka" class="btn btn-primary btn-sm" >Tambah Data</a>
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