<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR MAHASISWA DO </h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	<th>
			NIM
		</th>
		<th>
			NAMA MAHASISWA
		</th>
		<th>
			ANGKATAN
		</th>
	<th>
			SEMESTER
		</th>
		
		<td>
			STATUS
		</td>
			<td>
			AKSI
		</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 0;
	
	if($listmhs)
	{


    foreach ($listmhs as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->nim?>
		</td>
		<td>
			<?php echo $r->nm_mahasiswa?>
		</td>
		
		<td>
			<?php echo $r->angkatan?>
		</td>
			<td>
			<?php echo $r->semester?>
		</td>
		<td>
			<?php echo $r->status?>
		</td>

	
		
		<td>

			<a class="btn btn-primary btn-xs" href="<?php echo base_url().''.$r->no_do?>">Batal</a>
			<a class="btn btn-info btn-xs" href="<?php echo base_url().''.$r->no_do?>">Detail</a>
		   	
		</td>
	</tr>
	<?php
                            }
                        }
                            ?>
</tbody>
</table>
<div><a href="<?php echo base_url()?>prodi/ldo" class="btn btn-primary"> Kembali</a></div>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">
    $('#test').DataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });


                    </script>