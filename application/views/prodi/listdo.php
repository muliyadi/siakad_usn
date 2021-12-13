<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR DO </h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	<th>
			NO DO
		</th>
		<th>
			TGL DO
		</th>
		<th>
			ANGKATAN
		</th>
	<th>
			JUMLAH
		</th>
		
		<td>
			AKSI
		</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 0;
	
	if($listdo)
	{


    foreach ($listdo as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->no_do?>
		</td>
		<td>
			<?php echo $r->tgl_do?>
		</td>
		
		<td>
			<?php echo $r->angkatan?>
		</td>
			<td>
			<?php echo $r->jumlah?>
		</td>

	
		
		<td>

			<a class="btn btn-primary btn-xs" href="<?php echo base_url().'prodi/edo/'.$r->no_do?>">Edit</a>
			<a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/lmhsdo/'.$r->no_do?>">Detail</a>
		   	
		</td>
	</tr>
	<?php
                            }
                        }
                            ?>
</tbody>
</table>
<div><a href="<?php echo base_url()?>prodi/fudo" class="btn btn-primary"> Tambah</a></div>
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