<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>SIAKAD USN KOLAKA</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
<style type="text/css">
            body{
                padding: 20px;
                font-family: "Times New Roman";


                background-repeat: no-repeat;
                background-position:center;
            }


            .word-table {
                border:1px solid black !important; 
                padding: 0px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
            }
            .word-table tr th td, .wordx-table tr td{
                border:1px solid black !important; 
                padding: 0px 0px;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
                padding: 0px;
            }
            
            .wordx-table {
                border:0px solid black !important; 
                padding: 0px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 11px;
                margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 0px 0px;
                font-family: "Times New Roman";
                font-size: 11px;
                margin-bottom: 0px;
                padding: 0px;
            }
            hr.style2 {
                border-top: 3px double #8c8b8b;
                height: 1px;
                margin-top: 1px;
                margin-bottom: 1px;
                padding: 0px
            }


        </style>
        
    </head>
    <body>
    <div class="container">
        <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br/>
                            <b>UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA</b><br />
                           
                            <font size="3">Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517 <br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: rektorat@usn.ac.id; Website: https://usn.ac.id
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div>
             <p align="center"><b>
           LAPORAN DATA REGISTRASI <?php echo $jns_registrasi?>
           TAHUN AKADEMIK <?PHP ECHO $ta?>
           </b>
            </p>

		
		
		
        <table class="word-table table" >
        <tr>
        <th >NO</th>
	
		<th >KODE PRODI</th>
		
		<th width="250" >PROGRAM STUDI</td>
		<th >ANGKATAN</th>
		<th >JUMLAH MAHASISWA AKTIF(A,C,T)</th>
		<th >JUMLAH REGISTRASI</th>
		<th >TIDAK REGISTRASI</th>
	
        </tr>
		<?php
		$start=0;
		$TOTCUTI=0;
		$TOTMHS=0;
		$TOTSPP=0;
		$TOTTAKTIF=0;
		$TOTMHS=0;
		$TAK=0;
            foreach ($rekapregistrasi as $row)
            {
            //	$TOTMHS=$TOTMHS+$row->jumlahmhs;
            //	$TOTCUTI=$TOTCUTI+$row->jumlah_registrasi_cuti;
            	$TOTSPP=$TOTSPP+$row->jumlah;
            	foreach($jml_mhs_prodi as $row2)
            	{
            	    if($row->kd_prodi==$row2->kd_prodi and $row->angkatan==$row2->angkatan)
            	    {
            	       $TOTMHS=$TOTMHS+$row2->jumlah;
            	        $TAK=$TOTMHS-$TOTSPP;
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		     
		      <td align='center'><?php echo $row->kd_prodi ?></td>
		      <td><?php echo $row->nm_prodi ?></td>
		    <td align='center'><?php echo $row->angkatan ?></td>
		    <td align='center'><?php echo $row2->jumlah ?></td>
		    
		      <td align='center'><?php echo $row->jumlah ?></td>
		        <td align='center'><?php echo $row2->jumlah-$row->jumlah ?></td>
		    
		      
			 
                </tr>
                <?php
            	    }
            	}
            }
           // $TOTTAKTIF=($TOTMHS-$TOTSPP-$TOTCUTI);
            ?>
        <tr><td colspan='4' align='center'>TOTAL</td>
            <td align='center' ><?php echo $TOTMHS?></td>
            <td align='center' ><?php echo $TOTSPP?></td>
            <td align='center' ><?php echo $TAK?></td>
        </tr>
        </table>
		
	
</div>
    </body>
</html>