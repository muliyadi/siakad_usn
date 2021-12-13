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

        <h3 align='center'>LAPORAN REGISTRASI MAHASISWA </h3>
		<h3 align='center'>TAHUN AJARAN : <?PHP ECHO $ta.'/'.$semester?> </h3>
		
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >No</th>
		<th >FAKULTAS</th>
		<th >KODE PRODI</th>
		<th >PROGRAM STUDI</th>
		<th>JUMLAH MAHASISWA</th>
		<th >JUMLAH BAYAR SPP</th>
		<th >JUMLAH CUTI</th>
		<th >JUMA TIDAK AKTIF</th>
		
        </tr>
		<?php
		$start=0;
		$TOTCUTI=0;
		$TOTMHS=0;
		$TOTSPP=0;
		$TOTTAKTIF=0;
            foreach ($rekapregistrasi as $row)
            {
            	$TOTMHS=$TOTMHS+$row->jumlahmhs;
            	$TOTCUTI=$TOTCUTI+$row->jumlah_registrasi_cuti;
            	$TOTSPP=$TOTSPP+$row->jumlah_registrasi_spp;
            	
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $row->kd_fak ?></td>
		      <td><?php echo $row->kd_prodi ?></td>
		      <td><?php echo $row->nm_prodi ?></td>
		      <td><?php echo $row->jumlahmhs ?></td>
		      <td><?php echo $row->jumlah_registrasi_spp ?></td>
		      <td><?php echo $row->jumlah_registrasi_cuti ?></td>
		       <td><?php echo  $row->jumlahmhs-$row->jumlah_registrasi_spp-$row->jumlah_registrasi_cuti?></td>
		      
			 
                </tr>
                <?php
				
            }
            $TOTTAKTIF=($TOTMHS-$TOTSPP-$TOTCUTI);
            ?>

        </table>
		
		<table>
			<tr><td>TOTAL MAHASISWA</td><td width="30" align="center">=</td><td><?php echo $TOTMHS?> </td></tr>
			<tr><td>TOTAL MEMBAYAR SPP</td><td width="30" align="center">=</td><td><?php echo $TOTSPP?> </td></tr>
			<tr><td>TOTAL CUTI</td><td width="30" align="center">=</td><td><?php echo $TOTCUTI?> </td></tr>
			<tr><td>TOTAL TIDAK AKTIF</td><td width="30" align="center">=</td><td><?php echo $TOTTAKTIF?> </td></tr>
		</table>

    </body>
</html>