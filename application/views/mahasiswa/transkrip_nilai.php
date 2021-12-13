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

                padding: 2px 3px;

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

    <body background="" onload="window.print();">

        <div class="container" >



            <table align="center" class="wordx-table"  >



                <tr align="center">

                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 



                    </td>

                    <td  >

                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>

                            <b><?php echo $this->config->item('namakampus');?></b><br />

                            <b><?php echo $nm_fak ?></font></b><br/>

                            <font size="2"><?php echo $this->config->item('alamatinduk');?><br/>

                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>

                            Email: <?php echo $this->config->item('email');?>; Website: <?php echo $this->config->item('website');?>

                            </font></p>



                    </td> 

                    <td width="10%">



                    </td>

                </tr>

            </table>

            <div>

                <hr class="style2">

            </div>



<br />

 <h4 align="center">TRANSKRIP NILAI SEMENTARA</h4>



<table class="wordx-table" align="center">

<tr>

    <td width="100">MAHASISWA</td><td width="10"> = </td>

    <td ALIGN="LEFT" ><?php echo $mahasiswa->nm_mahasiswa .' | '.$mahasiswa->nim?></td>

    <td ALIGN="LEFT" width="100">PROGRAM STUDI</td><td width="10"> = </td><td width="150" ><?php echo $nm_prodi?></td>

</tr>

<tr>

    <td>ANGKATAN</td><td width="10"> = </td>

    <td ALIGN="LEFT"><?php echo $mahasiswa->angkatan?></td>

   
    <td>DOSEN PA</td><td > = </td>

    <td ALIGN="LEFT" width="300"><?php if($pa){echo $pa->nm_dosen;}?></td>

</tr>





</table>





        

        



        

        <table class="word-table" style="margin-bottom: 10px">

        <tr>

        <th style="text-align: center;" >No</th>

        <th width="150" style="text-align: center;" >KODE</th>

        <th width="450" >MATAKULIAH</th>
<th style="text-align: center;">SMSTR</th>
        <th style="text-align: center;">SKS</th>

        

        <th style="text-align: center;">NILAI HURUF</th>

        <th style="text-align: center;">NILAI ANGKA</th>

        <th style="text-align: center;" width="" >BOBOT</th>

        

        </tr>

        <?php

        $start=0;

        $totbobot=0;

        $totsks=0;

	$totangka=0;

        

            foreach ($transkrip  as $row)

            {

            $totbobot=$totbobot+($row->sks*$row->nilai_a);

            $totsks=$totsks+$row->sks;
		//$totangka=$totangka+$row->nilai_a;
                $lebar = strlen($row->kd_mtk);
                    $starnya=strlen($row->kd_kurikulum)+1;

                ?>

                <tr>

              <td align="center"><?php echo ++$start ?></td>

              <td align="center"><?php echo substr($row->kd_mtk, $starnya, $lebar) ?></td>

              <td ><?php echo $row->nm_mtk?></td>
  <td align=center><?php echo $row->semester_ke?></td>
              <td align="center"><?php echo $row->sks?></td>

              

              <td align="center"><?php echo $row->nilai ?></td>

              <td align="center"><?php echo $row->nilai_a ?></td>

               <td align="center"><?php echo  $row->sks*$row->nilai_a?></td>

              

             

                </tr>

                <?php

                

            }

            $ips=$totbobot/$totsks;

            ?>

            <tr >

                <td colspan="4" align="right">JUMLAH</td>

                <td align="center"><?PHP ECHO $totsks?></td>

                 <td align="center"></td>

                  <td align="center"></td>

                   <td align="center"><?PHP ECHO $totbobot?></td>

            </tr>

            <tr>

                <th colspan="8">INDEKS PRESTASI KOMULATIF (IPK) =  <?PHP ECHO round($ips,2)?></th>

            </tr>



        </table>





                <table class="wordx-table">

        <tr>

            <td width="70%">

              

            </td>

         



            <td align="LEFT" >

                   Kolaka, <?php echo date('d-M-Y');?>

            </td>

        </tr>





        <tr >

             <td width="70%">

              

            </td>

            <td  align="LEFT">

                Dekan <br>

                

            </td>                 

        </tr>

        <tr height="70">

            <td colspan="2"></td>

        </tr>

        <tr >

             <td width="70%">

              

            </td>

            <td align="LEFT">

                <?PHP ECHO $dekan?><br>
              <?PHP ECHO  ' '.$nip_dekan?>

            </td>                 

        </tr>



    </table>





        

        

</div>

    </body>

</html>