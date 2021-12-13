<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Mahasiswa <a href="<?php echo base_url()?>prodi/fmahasiswa" class="btn btn-info"> Input</a></h3>
</div >
<div class="panel-body">
<table id="listdosen" class="table table-striped table-bordered" style="width:100%">
<thead>
	<tr>
	<th>No</th><th>FOTO</th><th>NIM</th><th>Nama Mahasiswa</th><th>NIK</th><th>Angkatan</th><th>Nilai UKT</th><th>Semester</th><th>No Hp</th><th>Beasiswa</th><th>Status</th><th>Aksi</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	if($listmhs)
	{
    foreach ($listmhs as $r) {
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
			<?php echo $r->NIK	?>
		</td>
		<td>
			<?php echo $r->angkatan	?>
		</td>
	
		<td>
			<?php echo $r->nilai_ukt	?>
		</td>
		<td>
			<?php echo $r->semester	?>
		</td>
		<td>
			<?php echo $r->no_hp	?>
		</td>
		<td>
			<?php echo $r->beasiswa	?>
		</td>
		<td>
			<?php echo $r->status	?>
		</td>
		
				
		<td>
		    <a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Asslamu%20alaikum%21%21%21">Chat</a>
		    	<a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/preview_biodata/'.$r->nim?>">Biodata</a>
		    	 <a  href="<?php echo base_url().'Prodi/list_matkul_mhs/'.$r->nim?>"class="btn btn-primary btn-xs" >MATAKULIAH</a>
		    <a  href="<?php echo base_url().'Prodi/krs_mhs/'.$r->nim?>"class="btn btn-primary btn-xs" >KRS</a>
		    <a  href="<?php echo base_url().'Prodi/lkhs/'.$r->nim?>"class="btn btn-info btn-xs" >KHS</a> 
		    <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/emahasiswa/'.$r->nim?>">Edit</a> 
		     <a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/reset_password/'.$r->nim?>">Reset Password</a> 
		</td>
	</tr>
	<?php
                            }
                        }
                            ?>
</tbody>
</table>
<div><a href="<?php echo base_url()?>prodi/fmahasiswa" class="btn btn-primary"> Input</a></div>
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
 