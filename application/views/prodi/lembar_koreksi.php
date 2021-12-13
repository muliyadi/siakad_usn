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
                            <b><?php echo $fakultas->nm_fak ?></font></b><br/>
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
            <div>
                <p align="center"><b><?php echo $judul?><br>
                TAHUN AKADEMIK <?php echo $this->session->userdata('kd_tahun_ajaran');?> </b></p>

            </div>
            
            <table class="wordx-table" align="center">
                
                <tr height='30'>
                     <td>NIM</td><td align="center">:</td><td> <?php echo $daftar->nim?> </td>
                </tr>
                <tr height='30'>
                     <td>NAMA </td><td align="center">:</td><td><?php echo  $daftar->nm_mahasiswa ?> </td>
                </tr>
                <tr height='30'>
                     <td>JUDUL </td><td align="center">:</td><td><?php echo  $daftar->judul?> </td>
                </tr>
                
                
            </table>

            <table class="word-table" >
                <tr height="650">
                    <td bordered='1'></td>
                </tr>
                
                
                
            </table>
            <br>
            <table class="wordx-table" align="center">
                <tr>
                    <td align="center" >Penguji ke ( 1 / 2 / 3 )</td>
                     <td width="80%"></td>
                </tr>
                 <tr height="40">
                    <td ></td>
                     <td width="80%"></td>
                </tr>
               <tr height="40">
                    <td align="center">___________________________</td>
                     <td width="80%"></td>
                </tr>
            </table>
           

           




        </div>
    </body>
</html>