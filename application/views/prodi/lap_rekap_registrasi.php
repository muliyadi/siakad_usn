<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
         <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                            <b><?php echo $this->config->item('namakampus');?></b><br />
                            <b><?php echo $nm_fak ?></font></b><br/>
                            <font size="3"><?php echo $this->config->item('alamatinduk');?><br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: <?php echo $this->config->item('email');?>; Website: <?php echo $this->config->item('website');?>
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>

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