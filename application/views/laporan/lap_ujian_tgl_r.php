<div class="row">
    <div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">Laporan Ujian Per Tanggal</div>
<table id="" border="1" align="center" cellpadding="10"class="table" >
	<tr>
	    <th>Tanggal : Jam</th>
	    <th>Jenis Ujian</th>
	    <th>Mahasiswa</th>
	    <th>Judul</th>
		<th>Pembimbing I</th>
		<th>Pembimbing II</th>
		<th>Penguji I</th>
		<th>Penguji II</th>
		<th>Penguji III</th>
	</tr>
<?php
    foreach ($jadwalujianlengkap as $row3) {
        
        
         
        ?>
		<tr>
		     <td><?php echo $row3['tgl_ujian'].' : '.$row3['jam']?></td>
		    <td align='left'><?php echo $row3['jenis_ujian']?></td>
		     <td align='left'><?php echo $row3['nm_mahasiswa'].'/'.$row3['nim']?></td>
		     <td align='left'><a href=<?php echo $row3['link_draft'] ?>><?php echo $row3['judul']?></a></td>
            <td align='left'><?php echo $row3['pembimbing1']?></td>
            <td align='left'><?php echo $row3['pembimbing2']?></td>
             <td align='left'><?php echo $row3['penguji1']?></td>
              <td align='left'><?php echo $row3['penguji2']?></td>
               <td align='left'><?php echo $row3['penguji3']?></td>
           


        </tr>
    <?php
    }
    ?>

</table>
</div>


</div> 
