<?php
 
 //fi="SISTEM INFORMASI";
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename='".$file."'.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

   
<table >
<thead>
	<tr>
		<th>KODE MATAKULIAH</th>
        <th>NAMA MATAKULIAH</th>
		<th>JENIS MATAKULIAH</th>
		<th>SKS TATAP MUKA</th>
		<th>SKS PRAKTEK</th>
		<th>SKS PRAKTEK LAPANAN</th>
		<th>SKS SIMULASI</th>
		<th>TGL MULAI EFEKTIF</th>
		<th>TGL AKHIR EFEKTIF</th>
		<th>SEMESTER</th>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td ><?php echo $r->kd_mtk?></td>
		<td><?php echo $r->nm_mtk?></td>
		<td><?php echo $r->id_jns_mtk?></td>
		<td><?php echo $r->sks_teori?></td>
		<td><?php echo $r->sks_praktikum_lab?></td>
		<td><?php echo $r->sks_praktikum_lapangan?></td>
		<td><?php echo $r->sks_simulasi?></td>
        <td></td>
         <td></td>
        <td><?php echo $r->semester_ke?></td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           