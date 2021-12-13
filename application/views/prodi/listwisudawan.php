<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>List Wisudawan <a href="<?php echo base_url()?>prodi/ustatus_lulus_mahasiswa" class="btn btn-info"> Update</a></h3>
</div >
<div class="panel-body">
<table id="listdosen" class="table table-striped table-bordered" style="width:100%">
<thead>
	<tr>
	<th>No</th><th>FOTO</th><th>NIM</th><th>Nama Mahasiswa</th><th>Angkatan</th><th>Thn Wisuda</th><th>Status</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	if($listwisudawan)
	{
    foreach ($listwisudawan as $r) {
    ?>
	<tr>
	<td>
			<?php echo $start++?>
		</td>
		<td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= $r->nim;
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80" >
                    </td>
	<td>
			<?php echo $r->nim?>
		</td>

		<td>
			<?php echo $r->nm_mahasiswa?>
		</td>
		<td>
			<?php echo $r->angkatan	?>
		</td>
	
		
		<td>
			<?php echo $r->kd_tahun_ajaran	?>
		</td>
		
				
		<td>
		   	<?php echo $r->status	?>
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
			
                
                <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function() {
    var table = $('#listdosen').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );
 </script>
 