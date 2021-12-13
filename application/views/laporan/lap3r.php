<!doctype html>
<html>
    <head>
        <title>USN|SIAKAD</title>
        <link rel="stylesheet" href="php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 20px;
            }
		
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
				align:center;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
			.wordx-table {
                border:0px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
				align:center;
            }
            .wordx-table tr th, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 5px 10px;
            }

        </style>
    </head>
    <body>
<div class="container">
        <h3 align='center'>RANGKING MAHASISWA </h3>
        <h3 align="center">ANGKATAN <?php echo $angkatan?> TAHUN AJARAN:  <?php echo $kd_tahun_ajaran?> </h3>
        
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >No</th>
		<th >RANGKING</th>
		<th >NIM</th>
		<th >NAMA MAHASISWA</th>
		<th >PROGRAM STUDI</th>
        <th>SEMESTER</th>
        <th width="200">INDEX PRESTASI SEMESTER (IPS)</th>
		
        </tr>
		<?php
		$start=1;
		$rank=0;
		$maks=4;
			if($list)
			{
				foreach ($list as $row)
            {
				if($maks>$row->ips_sebelumnya)
				{
					$rank=$rank+1;
					$maks=$row->ips_sebelumnya;
				}
				
		
				?>
			
            
                <tr>
		      <td><?php echo $start++ ?></td>
		      <td><?php echo $rank ?></td>
			  <td><?php echo $row->nim ?></td>
		      <td><?php echo $row->nm_mahasiswa ?></td>
			  <td><?php echo $row->nm_prodi ?></td>
		      <td><?php echo $row->semester_ke ?></td>
		      <td><?php echo $row->ips_sebelumnya ?></td>
		      </tr>
                <?php
				
            }
			}
            ?>

        </table>
		
		</div>

    </body>
</html>