<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR JADWAL MATAKULIAH</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>
			SEMESTER
		</th>
		<th>
			KODE JADWAL
		</th>
		<td>
			MATAKULIAH
		</td>
		<td>
			SKS
		</td>
		
		
		<td>
			KELAS
		</td>
		<td>
			DOSEN
		</td>
		<td>
			HARI, JAM 
		</td>


		<td>JUM. MHS</td>


		<th>PERTEMUAN KE</th>
		<td>
			AKSI
		</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
	<td>
			<?php echo $r['semester_ke']?>
		</td>
		<td>
			<?php echo $r['kd_jadwal']?>
		</td>
		<td>
			<?php echo $r['nm_mtk'].'/'.$r['kd_mtk']?>
		</td>
		<td>
			<?php echo $r['sks']?>
		</td>
			
		
	
		<td>
			<?php echo $r['kelas']?>
		</td>
		<td>
			<?php echo $r['dosen']?>
		</td>
		<td>
			<?php echo $r['hari'].', '.$r['jam']?>
		</td>
        

		<td><?php echo $r['terisi']?></td>

			<td><?php echo $r['max_pertemuan']?></td>

		<td>
           <a href="<?php echo $r['link_virtual']?>"class="btn btn-warning btn-xs" >Buka Kelas Online</a>

            
        </td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary" href="<?php echo base_url()?>prodi/fjm">Tambah</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#test').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
                    </script>