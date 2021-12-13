<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>JUMLAH PENDAFTAR KKN / PROGRAM STUDI</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    <td>
    		TAHUN AKADEMIK
		</td>
		<td>
			PROGRAM STUDI
		</td>
		<td>
			JUMLAH
		</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
	$total=0;
    foreach ($list as $r) {
        $total=$total+$r->jumlah;
    ?>
	<tr><h4>
        <td>
			<?php echo $r->kd_tahun_ajaran?>
		</td>
		<td>
			<?php echo $r->nm_prodi?>
		</td>

		<td>
			<?php echo $r->jumlah?>
		</td>
</h4>
	</tr>
	<?php
                            }
                            ?>
                            
</tbody>
<tr><td colspan='2'><h4>Total</h4></td><td><h4><?php echo $total?></h4></td></tr>
</table>


</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#test').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>