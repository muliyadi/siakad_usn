<!doctype html>
<html>
    <head>
        <title>USN|SIAKAD</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
        <h3 align='center'>DATA MAHASISWA SEMESTER > <?php echo $semester?> </h3>
		
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >No</th>
		<th >FAKULTAS</th>
		<th >PROGRAM STUDI</th>
		<th>MAHASISWA</th>
        <th>ANGKATAN</th>
        <th>JALUR MASUK</th>
		<th >SEMESTER</th>
		
        </tr>
		<?php
		$start=0;

            foreach ($list  as $row)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $row->kd_fak ?></td>
		      <td><?php echo $row->kd_prodi.'/'.$row->nm_prodi?></td>
		      <td><?php echo $row->nim.''.$row->nm_mahasiswa ?></td>
		      <td><?php echo $row->angkatan ?></td>
		      <td><?php echo $row->jalur_masuk ?></td>
		       <td><?php echo  $row->semester?></td>
		      
			 
                </tr>
                <?php
				
            }

            ?>

        </table>
		
		
</div>
    </body>
</html>