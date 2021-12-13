<?php
 
 //fi="SISTEM INFORMASI";
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename='".$file."'.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

   
<table id="test" class="table table-bordered table-responsive">
<thead>
	<tr>
        <th>SEMESTER</th>
		<th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>JUDUL</th>
		<th>NIDN</th>
		<th>NAMA DOSEN</th>
		<th>JENIS PERAN</th>
		<th>URUTAN</th>
		<th>KODE PRODI</th>
		<th>JENIS UJIAN</th>
	</tr>
</thead>
<tbody>
<?php
	
//	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td ><?php echo $r->kd_tahun_ajaran?></td>
		<td><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->judul?></td>
		<td><?php echo $r->NIDN?></td>
		<td><?php echo $r->nm_dosen?></td>
		<td><?php echo $r->jns_peran?></td>
		<td><?php echo $r->urutan?></td>
		<td><?php echo $r->kd_prodi_forlap?></td>
		<td><?php echo $r->jenis_ujian?></td>

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           