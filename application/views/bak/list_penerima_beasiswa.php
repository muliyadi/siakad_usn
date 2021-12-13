<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DATA MAHASISWA PENERIMA BEASISWA : <?php echo $jns_beasiswa;?></h3>
</div >
<div class="panel-body">

<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    <td>NIM</td>
	
		<td>MAHASISWA</td>
		<td>ANGKATAN</td>
		<td>PRODI</td>
		<td>NILAI UKTK</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($list as $r) {
    ?>
	<tr>
	    <td><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
		<td><?php echo $r->nm_prodi?></td>
		<td><?php echo $r->nilai_ukt?></td>
	</tr>
	<?php
    }
    ?>
</tbody>
</table>
<a  href="<?php echo base_url()?>bak/fbeasiswa">Kembali</a>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">
            $('#test').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
</script>