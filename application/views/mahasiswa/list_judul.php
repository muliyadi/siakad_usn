<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Usulan Judul Skripsi Mahasiswa</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
	
        	<th>Judul</th>
        <th>Mahasiswa</th>
        
	
	
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>

			<td width="45%"><?php echo $r->judul?></td>
		<td</td>
        	<td><?php echo $r->nm_mahasiswa.'-'. $r->nim?></td>
        		
	


	   </td>
       

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>prodi/fdaftar_judul">Tambah</a>
</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">


        $('#test').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        </script>







                            
           