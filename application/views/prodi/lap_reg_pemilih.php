<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <style type="text/css">
            body{
                padding: 10px;
                font-family: "Times New Roman";


                background-repeat: no-repeat;
                background-position:center;
            }


            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
                vertical-align:center;
                font-family: "Times New Roman";
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
                font-family: "Times New Roman";
                font-size: 13px;
                 vertical-align:center;
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
    <body background="">
        <div class="container" >

            <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.gif" alt="..." width="120px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>
                           UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA<br>
                            <b><?php echo $prodi->nm_fak ?></font></b><br/>
                            <font size="3">Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517 <br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: <a href="mailto:<?php echo $prodi->email ?>"><?php echo $prodi->email ?></a>; Website: <a href="<?php echo $prodi->web ?>"><?php echo $prodi->web ?></a>
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div>
            <p align=center>
           <font size="3">DAFTAR REGISTRASI PEMILIHAN BEM FTI
		   </font>
		</p>
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <td align="center" >No</td>
       
        <td >NIM</td>
        <td >Nama Mahasiswa</td>
        <td >Ang.</td>
	<td align="center" >Tgl Registrasi</td>
		<td align="center">TTD</td>
		<td>-</td>
		<td align=center width=100>Pin</td>
		
        </tr>
		<?php
        $start=0;
            foreach ($list as $row)
            {
            
            	
                ?>
                <tr>

		      <td align=center width=10><?php echo ++$start ?></td>
		  
		  <td width=30><?php echo $row->nim ?></td>
		  <td><?php echo $row->nm_mahasiswa ?></td>
		  <td><?php echo $row->angkatan ?></td>
		   <td width=40></td>
		   <td></td>
            <td width=3></td>
          <td align=right width=80>PIN BEM:<b> <?php echo $row->kunci ;?></b></td>
		  
            
		    
			 
                </tr>
                <?php
				
            }
            
            ?>

        </table>
		
		<table align=center>
		    <tr height=20><td>Kolaka, <?php echo date('d-M-Y')?></td></tr> 
			<tr><td>Ketua KPU</td></tr> 
		    <tr height=120><td></td></tr>
		    <tr><td>----------------</td></tr>
		</table>
    </body>
</html>