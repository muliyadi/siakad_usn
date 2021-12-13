<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pembimbing Skripsi</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>

		<th>Pembimbing Ke</th>
		<td>KODE/NIDN</td>
		<td>Nama Pembimbing</td>
		<td>Jafung</td>
	</tr>
</thead>
<tbody>
<?php
    if($list)
    {
    foreach ($list as $r) {
    ?>
	<tr>


		
		<td><?php echo $r->pembimbing_ke?></td>
		<td><?php echo $r->pembimbing?></td>
		<td><?php echo $r->nm_dosen?></td>
		<td><?php echo $r->jafung?></td>

        </td>
	

		
	</tr>
	<?php
                            }}
                            ?>
</tbody>
</table>

</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">


        $('#test').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
        </script>







                            
           