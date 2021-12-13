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

    <body background="">

        <div class="container" >



            <table align="center" class="wordx-table"  >



                <tr align="center">

                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 



                    </td>

                    <td  >

                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>

                            <b>UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA</b><br />

                            <b><?php echo $nm_fak ?></font></b><br/>

                            <font size="3"><?php echo $this->config->item('alamatinduk');?><br/>

                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>

                            Email: <?php echo $this->config->item('email');?>; Website:  <?php echo $this->config->item('website');?>

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
    <td>NIM</td>
    <td>: <?php echo $mahasiswa->nim?></td>
    <td width="20%">&nbsp;</td>
    <td width="120">Program Studi</td>
    <td>: <?php echo $nm_prodi?></td>
  </tr>
  <tr>
    <td width="120">Nama Mahasiswa</td>
    <td>: <?php echo $mahasiswa->nm_mahasiswa?></td>
    <td>&nbsp;</td>
    <td>Jenjang</td>
    <td>: <?php echo $level_prodi?></td>
  </tr>
  <tr>
    <td>Angkatan</td>
    <td>: <?php echo $mahasiswa->angkatan?></td>
    <td>&nbsp;</td>
    <td>Dosen Pembimbing</td>
    <td>: <?php echo $pa->nm_dosen?></td>
  </tr>






</table>





        

        



        

        <table class="word-table" style="margin-bottom: 10px">

          <tr>
    <th rowspan="2"><div align="center">No</th>
    <th rowspan="2"><div align="center">Kode</th>
    <th rowspan="2">Matakuliah</th>
    <th rowspan="2"><div align="center">SMTR</div></th>
    <th rowspan="2"><div align="center">SKS</div></th>
    <th colspan="2"><div align="center">Nilai</th>
    <th rowspan="2"><div align="center">Bobot</th>
  </tr>
  <tr>
    <th><div align="center">Huruf</th>
    <th><div align="center">Angka</th>
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


                ?>

                <tr>

              <td align="center"><?php echo ++$start ?></td>

              <td align="center"><?php echo substr($row->kd_mtk,strlen($row->kd_kurikulum)+1) ?></td>

              <td ><?php echo $row->nm_mtk?></td>
  <td align=center><?php echo $row->semester_ke?></td>
              <td align="center"><?php echo $row->sks?></td>

              

              <td align="center"><?php echo $row->nilai_h ?></td>

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

                <th colspan="8">Indeks Prestasi Komulatif (IPK) =  <?PHP ECHO round($ips,2)?></th>

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

                Wakil Dekan I <br>

                

            </td>                 

        </tr>

        <tr height="70">

            <td></td>
            <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo base_url('laporan/get_transkrip').'/'.$nim.'/'.$ta_awal.'/'.$ta_akhir?>" width="80"></td>
        </tr>

        <tr >

             <td width="70%">

              

            </td>

            <td align="LEFT">

               <u> <?PHP ECHO $wd1?></u><br>
<?PHP ECHO  ' '.$nip_wd1?>
            </td>                 

        </tr>



    </table>





        

        

</div>

    </body>

</html>