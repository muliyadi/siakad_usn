<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DATA MAHASISWA </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    	<td>PRODI</td>
	    <td>NIM</td>
	
		<td>MAHASISWA</td>
		<td>ANGKATAN</td>
	
		<td>NILAI UKTK</td>
		<td>NIK</td>
		<td>STATUS</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($list as $r) {
    ?>
	<tr>
	    	<td><?php echo $r->nm_prodi?></td>
	    <td><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
	
		<td><?php echo $r->nilai_ukt?></td>
		<td><?php echo $r->NIK?></td>
		<td><?php echo $r->status?></td>
		
	</tr>
	<?php
    }
    ?>
</tbody>
</table>

<a  href="<?php echo base_url()?>bak/fmahasiswa" class="btn btn-primary">Tambah Data</a>
<a  href="<?php echo base_url()?>bak/fsinkron_mahasiswa" class="btn btn-info">Sinkron</a>
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