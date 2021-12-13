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
		<TH>NIDN</TH>
        <th>NAMA DOSEN</th>
        <th>MATAKULIAH</th>
        <TH>SKS</TH>
		<th>NO 1</th>
		<th>NO 2</th>
		<th>NO 3</th>
		<th>NO 4</th>
		<th>NO 5</th>
		<th>NO 6</th>
		<th>NO 7</th>
		<th>NO 8</th>
		<th>NO 9</th>
		<TH>NO 10</TH>
		
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td><?php echo $start++ ?></td>
		<td ><?php echo $r->NIDN?></td>
		<td><?php echo $r->nm_dosen?></td>
		<td><?php echo $r->nm_mtk?></td>
		<td><?php echo $r->sks?></td>
		<td><?php echo $r->no_1?></td>
		<td><?php echo $r->no_2?></td>
		<td><?php echo $r->no_3?></td>
		<td><?php echo $r->no_4?></td>
		<td><?php echo $r->no_5?></td>
        <td><?php echo $r->no_6?></td>
        <td><?php echo $r->no_7?></td>
        <td><?php echo $r->no_8?></td>
        <td><?php echo $r->no_9?></td>
        <td><?php echo $r->no_10?></td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           