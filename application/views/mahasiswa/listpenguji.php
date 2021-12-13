<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Penguji</h3>
</div >
<div class="panel-body">



<table id="tabel" class="table table">
<thead>
	<tr>
		<th>Penguji Ke</th>
		 <th>NIK/NIDN</th>
        <th>Nama Dosen</th>
		<th>Jabatan Fungsional</th>
		<th>Deskripsi</th>

	</tr>
</thead>
<tbody>
<?php

    foreach ($list as $r) {
    ?>
	<tr>



		<td ><?php echo $r->penguji_ke?></td>
		<td ><?php echo $r->penguji.'/'.$r->nidn?></td>
		<td><?php echo $r->nm_dosen?></td>

		<td><?php echo $r->jafung?></td>
		<td></td>
        
		

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script>

        $('#tabel').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
        </script>







                            
           