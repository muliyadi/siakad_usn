<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR  FAKULTAS </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>KODE FAKULTAS</th>
		<td>NAMA FAKULTAS</td>
		<td>DESKRIPSI FAKULTAS</td>
		<td>DEKAN</td>
		<td>NIP/NIDN DEKAN</td>
		<td>WD1</td>
		<td>NIP/NIDN WD1</td>
		<td>AKSI</td>
		

	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($listfakultas as $r) {
    ?>
	<tr>
		<td><?php echo $r->kd_fak?></td>
		<td><?php echo $r->nm_fak?></td>
		<td><?php echo $r->deskripsi?></td>
		<td><?php echo $r->dekan?></td>
		<td><?php echo $r->nip_dekan?></td>
		<td><?php echo $r->wd1?></td>
		<td><?php echo $r->nip_wd1?></td>
		<td><a href="<?php echo base_url('bak/edit_fakultas').'/'.$r->kd_fak?>" class="btn btn-info btn-sm">Edit</a>
		<a href="<?php echo base_url('bak/delete_fakultas').'/'.$r->kd_fak?>" class="btn btn-warning btn-sm">Delete</a></td>
		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a href="<?php echo base_url()?>bak/ffakultas" class="btn btn-primary btn-sm">Tambah Data</a>
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