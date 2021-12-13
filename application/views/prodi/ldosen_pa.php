<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>List Dosen PA</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>

		<td>
			NAMA DOSEN | NIDN
		</td>
		<td>
			JAFUNG
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
	if($list)
	{


    foreach ($list as $row) {
    ?>
	<tr>
		

		<td>
			<?php echo $row->nm_dosen.'|'.$row->nidn?>
		</td>
		<td>
				<?php echo $row->jafung?>
		</td>
		<td>
			<?php echo $row->jumlah?>
		</td>
		<td>


		    <a class="btn btn-primary btn-xs" href="<?php echo base_url().'prodi/dpa/'.$row->kd_dosen?>" onclick="return confirm('Anda yakin?');">Print</a> 	
		</td>
	</tr>
	<?php
                            }
                        }
                            ?>
</tbody>
</table>

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
            "ordering": false,
            "info": false,
            "autoWidth": false
        });
                    </script>