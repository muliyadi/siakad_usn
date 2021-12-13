<!doctype html>
<html>
    <head>
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
                border-collapse: collapse !important;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
                font-family: "Times New Roman";
            }
            .wordx-table {
                border:0px solid black !important; 
                padding: 0px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 0px 0px;
                font-family: "Times New Roman";
                font-size: 12px;
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
                        <p ><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>
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
           LAPORAN AKTIVITAS
           KULIAH MAHASISWA TAHUN AKADEMIK <?PHP ECHO $ta?>
           </b>
            </p>

		
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >NO</th>
		<th >NIM</th>
		<th >NAMA MAHASISWA</th>
		<th >ANGKATAN</th>
		<th >IPS</th>
        </tr>
		<?php
		$start=0;
	
            foreach ($listakam as $row)
            {
           
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		        <td align='center'><?php echo $row->nim ?></td>
		      <td><?php echo $row->nm_mahasiswa ?></td>
		        <td align='center'><?php echo $row->angkatan ?></td>
		      <td align='center'><?php echo $row->ips ?></td>

                </tr>
                <?php
				
            }
           
            ?>
       
        </table>
		
	
</div>
    </body>
</html>