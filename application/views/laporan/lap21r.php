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
        <h4 align='center'>LAPORAN</h4>
		<h4 align='center'>RATA-RATA IPK MAHASISWA</h4>
		
		
        <table class="word-table table" style="margin-LEFT: 0px">
        <tr>
        <th >No</th>
		<th >FAKULTAS</th>
		<th >PROGRAM STUDI</th>
		<th>STATUS AKREDITAS PRODI</th>
		<th>TAHUN AJARAN</th>
        <th>RATA-RATA IPK</th>

		
        </tr>
		<?php
		$start=0;
            if($list)
            {
                
           
            foreach ($list  as $row)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $row->kd_fak ?></td>
		      <td><?php echo $row->kd_prodi.'/'.$row->nm_prodi?></td>
		      <td><?php echo $row->status_akreditas?></td>
		      <td><?php echo $row->kd_tahun_ajaran ?></td>
		      <td><?php echo $row->rataipk ?></td>	      
                </tr>
                <?php
				
            }
             }
            ?>

        </table>
		
		
</div>
    </body>
</html>