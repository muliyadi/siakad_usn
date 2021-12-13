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
		<th>NO</th>
        <th>SEMESTER</th>
		<th>NIDN</th>
		<th>NAMA DOSEN</th>
		<th>KODE MATAKULIAH</th>
		<th>NAMA MATAKULIAH</th>
		<TH>SKS</TH>
		<th>KELAS</th>
		<th>JUMLAH PERTEMUAN</th>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td><?php echo $start++ ?></td>
		<td ><?php echo $r->kd_tahun_ajaran?></td>
		<td><?php echo "'".$r->NIDN?></td>
		<td><?php echo $r->nm_dosen?></td>
		<td><?php echo $r->kd_mtk?></td>
		<td><?php echo $r->nm_mtk?></td>
		<td><?php echo $r->sks?></td>
		<td><?php echo $r->kelas?></td>
		<td>16</td>

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           