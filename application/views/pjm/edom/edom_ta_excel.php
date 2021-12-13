<?php
 
 //fi="SISTEM INFORMASI";
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$file.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

   
<table id="test" class="table table-bordered table-responsive">
<thead>
	<tr>
        <th>MATAKULIAH</th>
		<th>SKS</th>
		<th>KELAS</th>
		<th>DOSEN</th>
		<th>NIDN</th>
		<th>HOMEBASE</th>
		<th>KOMPETENSI</th>
		<th>SOAL</th>
		<th>PERNYATAAN</th>
		<th>JAWABAN</th>
		
	</tr>
</thead>
<tbody>
<?php

    foreach ($list as $r) {
       
            ?>
	<tr>
	
		<td ><?php echo $r->nm_mtk?></td>
		<td><?php echo $r->sks?></td>
			<td><?php echo $r->kelas?></td>
		<td><?php echo $r->nm_dosen?></td>
		<td><?php echo $r->NIDN?></td>
		<td><?php echo $r->homebase_dosen?></td>
			<td><?php echo $r->nm_kategori?></td>
		<td><?php echo $r->no_soal?></td>
		<td><?php echo $r->pertanyaan?></td>
		<td><?php echo $r->jawaban?></td>
		
		
		
		
	

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           