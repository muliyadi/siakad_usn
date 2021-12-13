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
			HARI / JAM /RUANG KULIAH
		</td>

		<td>
			KAPASITAS | TERISI
		</td>
		<td>TERSISA</td>
	
		<th>Status</th>
		<td>
			Aksi
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
			<?php echo $r->semester_ke?>
		</td>
		<td>
			<?php echo $r->kd_jadwal?>
		</td>
		<td>
			<?php echo $r->nm_mtk.'/'.$r->kd_mtk?>
		</td>
		<td>
			<?php echo $r->sks?>
		</td>
			
		
	
		<td>
			<?php echo $r->kelas?>
		</td>
		<td>
			<?php echo $r->hari.'/'.$r->jam.'/'.$r->kd_ruang?>
		</td>
        
		<td>
			<?php echo $r->kapasitas?><?php echo ' |';?> <?php echo $r->terisi;?>
		</td>
		<td><?php echo $r->kapasitas-$r->terisi?></td>
	
				<td>
			<?php echo $r->status?>
		</td>
		<td><a class="btn btn-info btn-xs"  href="<?php echo base_url().'prodi/ejk/'.$r->kd_jadwal?>">Edit</a> 
		    <a class="btn btn-info btn-xs"  href="<?php echo base_url().'prodi/djk/'.$r->kd_jadwal?>">Delete</a> 
		    <a href="<?php echo base_url().'prodi/list_mhs_jadwal/'.$r->kd_jadwal?>"class="btn btn-success btn-xs" >List Mahasiswa</a>
		    <a href="<?php echo base_url().'prodi/fjadwal_dosen/'.$r->kd_jadwal?>"class="btn btn-info btn-xs" >Input Subtansi</a>
		    <a href="<?php echo base_url().'prodi/jurnal_kuliah/'.$r->kd_mtk?>"class="btn btn-default btn-xs" >Jurnal Kuliah</a> 
            <a href="<?php echo base_url().'prodi/fabsensi/'.$r->kd_jadwal?>"class="btn btn-default btn-xs" >Absensi Perkuliahan</a> 
            
            <a href="<?php echo base_url().'prodi/fberita_acara_final/'.$r->kd_jadwal?>"class="btn btn-danger btn-xs" >Berita Acara Ujian</a>
           <a href="<?php echo base_url().'prodi/nilai_kelas/'.$r->kd_jadwal?>"class="btn btn-warning btn-xs" >Print Nilai</a>

            
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