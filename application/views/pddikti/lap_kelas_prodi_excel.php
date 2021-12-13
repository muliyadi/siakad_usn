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
		<th>KODE MATAKULIAH</th>
		<th>NAMA MATAKULIAH</th>
		<th>KELAS</th>
		<th>BAHASAN</th>
		<th>TGL MULAI</th>
		<th>TGL SELESAI</td>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td><?php echo $start++ ?></td>
		<td ><?php echo $r->semester?></td>
		<td><?php echo $r->kd_mtk?></td>
		<td><?php echo $r->nm_mtk?></td>
		<td><?php echo $r->kelas?></td>
		<td><?php echo $r->bahasan?></td>
		<td><?php echo $r->tgl_mulai?></td>
		<td><?php echo $r->tgl_selesai?></td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           