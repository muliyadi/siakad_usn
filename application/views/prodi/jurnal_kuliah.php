<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
                font-family: "Times New Roman";
            }
            .wordx-table {
                border:0px solid black !important; 
                padding: 5px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 5px;
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
    <body background="" onload="window.print()">
        <div class="container" >

            <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                           UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA<br />
                            <b><?php echo $fak->nm_fak ?></font></b><br/>
                            <font size="3"><?php echo $this->config->item('alamatinduk');?><br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email:<?php echo $this->config->item('email');?>; Website: <?php echo $this->config->item('website');?>
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
                 <br>
                <p align="center"><b>JURNAL KULIAH<br><br>
               </b></p>

            </div>
        <table class="wordx-table " >
        <tr>
        <td width="110"> Matakuliah</td> <td width="200">: <?php echo $mtk->nm_mtk?></td> <td width="200"></td><td width="120">Program Studi</td><td width="220">: <?php echo $prodi->nm_prodi?></td></tr>
        <tr></tr><td > Semester/SKS</td><td>: <?php echo $mtk->semester_ke.' / '. $mtk->sks?></td>   <td></td><td>Tahun Akademik</td><td>: </td></tr>
        <tr></tr><td > Dosen Pengampu</td><td>:</td><td></td><td></td><td></td>
        </tr>
        </table>
        
        
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th width="10"  style="align='center'"> Mg.Ke</th>
        <th >Hari/Tanggal</th>
        <th width="400">Materi Pembelajaran</th>
        <th> Dosen</th>
        <th >Ketua Kelas</th>
        <th>Pengawas</th>
        <th>Keterangan</th>
        
        </tr>
        <?php
        $start=0;
        
            foreach ($detail_mtk as $row)
            {
                ?>
                <tr>
             
              
              
              <td align='center'><?php echo $row->pertemuan ?></td>
              <td></td>
              <td><?php echo $row->materi_pembelajaran ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
                </tr>
                <?php
                
            }
            ?>
          
        </table>
        	<table align=right >
		    <tr height=20 width=300><td></td><td widht=200>Kolaka, </td></tr> 
			<tr><td></td><td>Ketua Program Studi</td></tr> 
		    <tr height=120><td></td><td></td></tr>
		    <tr><td></td><td><?php echo $prodi->ka_prodi ?></td></tr>
		</table>
       
</div>
    </body>
</html>