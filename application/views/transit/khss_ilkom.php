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

    <body background="">

        <div class="container" >



            <table align="center" class="wordx-table"  >



                <tr align="center">

                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 



                    </td>

                    <td  >

                        <p ><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>

                            <b>UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA</b><br />

                            <b><?php echo $nm_fak ?></font></b><br/>

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



<br />

 <h4 align="center">KARTU HASIL STUDI</h4>



<table class="wordx-table" align="center">

<tr>

    <td width="120">MAHASISWA</td><td width="10"> = </td>

    <td ALIGN="LEFT" ><?php echo $hkhs->nm_mahasiswa .' | '.$hkhs->nim?></td>

    <td ALIGN="LEFT" width="120">PROGRAM STUDI</td><td width="10"> = </td><td width="150" ><?php echo $hkhs->nm_prodi?></td>

</tr>

<tr>

    <td>ANGKATAN</td><td width="10"> = </td>

    <td ALIGN="LEFT"><?php echo $hkhs->angkatan?></td>

    <td ALIGN="LEFT">TAHUN AKADEMIK</td><td width="10"> = </td><td><?php echo $hkhs->tahun_ajaran?></td>

</tr>

<tr>

    <td>DOSEN PA</td><td width="10"> = </td>

    <td ALIGN="LEFT"><?php echo $hkhs->nm_dosen?></td>

    <td ALIGN="LEFT">SEMESTER</td><td width="10"> = </td><td><?php echo $hkhs->semester?></td>

</tr>



</table>





        

        



        

        <table class="word-table" style="margin-bottom: 10px">

        <tr>
        <th rowspan="2" style="text-align: center;" >NO</th>
        <th rowspan="2"  style="text-align: center;" >KODE</th>
        <th rowspan="2">MATAKULIAH</th>
        <th rowspan="2" style="text-align: center;">SKS</th>
        <th colspan="2" style="text-align: center;">NILAI</th>
       
        <th rowspan="2"style="text-align: center;" width="100" >BOBOT</th>
        </tr>
        <tr>
        
        
       
        <th style="text-align: center;">HURUF</th>
        <th style="text-align: center;">ANGKA</th>
        
        </tr>
        

        <?php

        $start=0;

        $totbobot=0;

        $totsks=0;

	$totangka=0;

        

            foreach ($dkhs  as $row)

            {

            $totbobot=$totbobot+($row->sks*$row->nilai_a);

            $totsks=$totsks+$row->sks;
		$totangka=$totangka+$row->nilai_a;


                ?>

                <tr>

              <td align="center"><?php echo ++$start ?></td>

              <td align="center"><?php echo $row->kd_mtk ?></td>

              <td ><?php echo $row->nm_mtk?></td>

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

                <td colspan="3" align="right">JUMLAH</td>

                <td align="center"><?PHP ECHO $totsks?></td>

                 <td align="center"></td>

                  <td align="center"></td>

                   <td align="center"><?PHP ECHO $totbobot?></td>

            </tr>

            <tr>

                <td colspan="7">INDEKS PRESTASI SEMESTER (IPS) =  <?PHP ECHO round($ips,2)?><br>
                MAKSIMAL SKS YANG DAPAT DIPROGRAM = </td>

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

                 a.n Dekan <br>

                 Wakil Dekan I,
            </td>                 
        </tr>

        <tr height="70">

            <td colspan="2"></td>

        </tr>

        <tr >

             <td width="70%">

              

            </td>

            <td align="LEFT">

                <u><?PHP ECHO $ka_prodi?></u><br>
                <?PHP ECHO $nidn?>
                

            </td>                 

        </tr>



    </table>





        

        

</div>

    </body>

</html>