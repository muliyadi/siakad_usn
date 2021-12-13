<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR Perwalian Dosen</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	<th>
			Thn Angkatan
		</th>
		<th>
			NO PA
		</th>
		<th>
			TGL PA
		</th>
		<td>
			PRODI </td>
		<td>
			NAMA DOSEN | NIDN
		</td>
		<td>
			JUMLAH MHS BIMBINGAN
		</td>
		<td>
			AKSI
		</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 0;
	if($listpa)
	{


    foreach ($listpa as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->thn_angkatan?>
		</td>
		<td>
			<?php echo $r->no_pa?>
		</td>
		
		<td>
			<?php echo $r->tgl_pa?>
		</td>
			<td>
			<?php echo $r->kd_prodi?>
		</td>

		<td>
			<?php echo $r->nm_dosen.'|'.$r->NIDN?>
		</td>
		<td>
			<?php echo $r->jumlah?>
		</td>
		<td>

			<a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/epa/'.$r->no_pa?>">Edit</a>
		   		<a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/dpa/'.$r->no_pa?>">Delete</a>
		</td>
	</tr>
	<?php
                            }
                        }
                            ?>
</tbody>
</table>
<div><a href="<?php echo base_url()?>prodi/fpax" class="btn btn-primary"> Tambah</a></div>
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
            "autoWidth": false
        });
                    </script>