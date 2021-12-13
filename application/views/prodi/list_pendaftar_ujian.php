<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Daftar Ujian</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
	<th>Jenis Ujian</th>
		 <th>No Daftar</th>
        <th>Tgl Daftar</th>
        <th>Nama Mahasiswa/NIM</th>
        <th>No Hp</th>
		<th>Judul</th>
	     <th>No Daftar Judul</th>
        <th>Status</th>
		<td>Aksi</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
			<td><?php echo $r->jenis_ujian?></td>
      
		<td ><?php echo $r->no_daftar?></td>
		<td ><?php echo $r->tgl_daftar?></td>

	
	
		<td><?php echo $r->nm_mahasiswa.'/'.$r->nim?></td>
        	<td><a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%2C%20Jadwal%20ujian%20Anda%20Tgl.%<?php echo date('dd F Y', strtotime($r->tgl_ujian)).' Jam'.$r->jam;?>.%20Lebih%20lengkapnya%20lihat%20disiakad%20USN.%20Terimakasih"><?php echo $r->no_hp?></a></td>
		<td><?php echo $r->judul?></td>
        	<td ><?php echo $r->no_daftar_judul?></td>
            <td><?php echo $r->status?></td>
        
		<td >
		    

		        
		        
		      
		       <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/fedaftar_ujian/'.$r->no_daftar?>"> Jadwal</a>
		       <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/delete_daftar_ujian/'.$r->no_daftar?>"> Delete</a>
		</td>
		

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>prodi/daftar_ujian">Tambah</a>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
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




                            
           