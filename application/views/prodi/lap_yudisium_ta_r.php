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

                            <?php echo $this->config->item('namakampus');?><br />

                           <?php echo $prodi->nm_fak ?><br/>
                             <b>PROGRAM STUDI <?php echo $prodi->nm_prodi ?></b></font><br/>
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



<br />

 <h4 align="center">LAPORAN YUDISIUM</h4>
<h4 align="center">TAHUN AKADEMIK <?php echo $kd_tahun_ajaran?></h4>
        <table class="word-table" style="margin-bottom: 10px">
        <tr>
        <th style="text-align: center;" >No</th>
        <th width="" style="text-align: center;" >No/Tgl Daftar</th>
        <th width="" tyle="text-align: center;"  >NIM</th>
<th style="text-align: left;">Nama Mahasiswa</th>
        <th style="text-align: left;">Judul</th>
        <th style="text-align: center;">Nilai</th>
        <th style="text-align: center;">IPK </th>
     <th style="text-align: center;">Status </th>
  
     
        </tr>

        <?php

        $start=0;

            foreach ($list  as $row)
            {
                ?>
                <tr>
              <td align="center"><?php echo ++$start ?></td>
              <td align="center"><?php echo $row->no_daftar.'/'. $row->tgl_daftar?></td>
              <td align="center"><?php echo $row->nim?></td>
            <td align=left><?php echo $row->nm_mahasiswa?></td>
              <td align="left"><?php echo $row->judul?></td>
              
              <td align="center"><?php echo $row->nilai ?></td>
              <td align="center"><?php echo  $row->ipk?></td>
               <td align="center"><?php echo  $row->status?></td>

              

             

                </tr>

                <?php

                

            }

          
            ?>

           

          

        </table>





               
        

</div>

    </body>

</html>