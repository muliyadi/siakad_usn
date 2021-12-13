<!doctype html>
<html>
    <head>
        <title>SIAKAD USN Kolaka</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <style type="text/css">
            body{
                padding: 20px;
                font-family: "Times New Roman";


                background-repeat: no-repeat;
                background-position:center;
            }


            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 13px;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 2px;
                font-family: "Times New Roman";
                font-size: 13px;
            }
            .wordx-table {
                border:0px solid black !important; 
                padding: 5px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 5px 5px;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
                
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
    <body background="">
        <div class="container" >

            <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>
                            UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA<br />
                           <b> <?php echo $prodi->nm_fak ?></b><br>
                           PROGRAM STUDI <?php echo $prodi->nm_prodi ?></br></font>
                          <font size="3">Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517 <br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: fti@usn.ac.id; Website: https://fti.usn.ac.id
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div>
            <div>
                <p align="center"><b>LAPORAN JUMLAH PENGUJIAN DOSEN <br>
                TAHUN AKADEMIK <?php echo $ta;?><br>
                

            </div>
            
<table class="word-table" >
<thead>
	<tr>
		<td align="center">NO</td>
        
		<td align="center">KODE DOSEN</td>
		<td>NAMA DOSEN</td>
		<td align="center">JAFUNG</td>
		<td align="center">ANGKATAN</td>
		<td align="center">JUMLAH</td>
		<td>KETERANGAN</td>
	
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr >

		<td align="center"><?php echo $start++ ?></td>

		
		<td align="center"><?php echo $r->NIDN?></td>
		<td><?php echo $r->nm_dosen?></td>
        <td align="center"><?php echo $r->jafung?></td>
        <td align="center"><?php echo $r->angkatan?></td>
        	<td align="center"><?php echo $r->jumlah?></td>
<td></td>



		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<br>


<table class="wordx-table">
    
    <tr>
        <td width="35%"></td>
         <td width="35%"></td>
        <td align="left">  Kolaka, <?php echo date('d-M-Y'); ?> </td>
    </tr>
    <tr height="100">
         <td width="35%"></td>
        <td width="35%"></td>
        <td> </td>
    </tr>
        <tr>
             <td width="35%"></td>
        <td width="35%"></td>
        <td align="left"><?php echo $prodi->ka_prodi?></td>
    </tr>
</table>

          
    </body>
</html>















                            
           