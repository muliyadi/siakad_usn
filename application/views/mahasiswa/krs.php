<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title align='right'><?php echo $krsh->nim ?>-KRS-<?php echo $krsh->kd_tahun_ajaran ?> </title>
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
    <body background=""  onload="window.print();">
        <div class="container" >

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
            <div>
                <hr class="style2">
            </div>
            <div>
                <p align="center"><b>KARTU RENCANA STUDI</b></p>

            </div>
            <table class="wordx-table" align="center">
                <tr>
                    <td width="160">NIM</td><td width="10"> : </td><td ALIGN="LEFT" width="700"><?php echo $krsh->nim ?></td>

                    <td align="LEFT" >NO KRS</td><td width="10"> : </td>
                    <td ALIGN="LEFT"><?php echo $krsh->no_krs ?></td>

                </tr>
                <tr>
                    <td >MAHASISWA</td><td width="10"> : </td>
                    <td ALIGN="LEFT" ><?php echo $krsh->nm_mahasiswa ?></td>


                    <td ALIGN="LEFT" width="160">TAHUN AJARAN</td><td width="10"> : </td>
                    <td><?php echo $krsh->kd_tahun_ajaran ?></td>
                </tr>

                <tr>
                    <td ALIGN="LEFT" >PROGRAM STUDI</td><td width="10"> : </td><td ><?php echo $krsh->nm_prodi ?></td>
                    <td ALIGN="LEFT" width="160">IPS / IPK</td><td width="10"> : </td>
                   
                    <td><?php echo round($krsh->ips,2) . ' / ' . round($ipk,2)?></td>

                </tr>
                <tr>
                    <td align="LEFT"width="80">ANGKATAN</td>
                    <td width="10"> : </td>
                    <td ALIGN="LEFT"><?php echo $krsh->angkatan ?></td>
                    <td align="LEFT"width="80">MAKS. SKS</td>
                    <td width="10"> : </td>
                    <td ALIGN="LEFT"><?php echo $krsh->maks_sks ?></td>
                </tr>
            </table>

            <table class="word-table" style="margin-bottom: 10px">
                <tr>
                    <th style="text-align: center;" width="50" >NO.</th>
                    <th width="160" style="text-align: center;" >KODE MATA KULIAH</th>
                    <th >NAMA MATA KULIAH</th>
                    <th style="text-align: center;">SKS</th>
                    <th style="text-align: center;" >SEMESTER</th>
                   
                    <th style="text-align: center;">KELAS</th>
                    


                </tr>
                <?php
                $start = 0;
                $totsks = 0;


                foreach ($krsd as $row) {
                    $totsks = $totsks + $row->sks;
                    $lebar = strlen($row->kd_mtk);
                    $starnya=strlen($row->kd_kurikulum)+1;
                    ?>
                    <tr>
                        <td align="center"><?php echo++$start ?></td>
                        <td align="center"><?php echo substr($row->kd_mtk, $starnya, $lebar) ?></td>
                        <td ><?php echo $row->nm_mtk ?></td>
                         <td align="center"><?php echo $row->sks ?></td>
                        <td align="center"><?php echo $row->semester_ke ?></td>
                        <td align="center"><?php echo $row->kelas ?></td>
                       
                    </tr>
                    <?php
                }
                ?>
                <tr><th colspan="5" style="text-align: right;">JUMLAH SKS YANG DIPROGRAM </th>
                    <th style="text-align: center;"><?PHP ECHO $totsks . ' SKS' ?></th></tr>
            </table>


            <div class="col-md-12" align="right"> 
                Kolaka, <?php echo date('d-M-Y'); ?>

            </div>


            <table class="wordx-table">
                <br>
                <tr align="center">
                    <td height="0" width="33%">Mahasiswa</td>
                    <td></td>
                    <td width="33%" >Mengetahui,<br>Ketua Program Studi</td>

                </tr>
                <tr height="110"align="center">
                    <td></td>
                     <td></td>
                    <td><img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo base_url('mahasiswa/vkrs').'/'.$krsh->no_krs?>" width="100"></td>
                </tr>
                <tr align="center">
                    <td height="0"><?php echo $krsh->nm_mahasiswa; ?></td>
                    <td></td>
                    <td><?php echo $krsh->ka_prodi; ?></td>

                </tr>

             
            </table>




        </div>
    </body>
</html>