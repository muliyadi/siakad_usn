<!doctype html>

<html>

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>SIAKAD USN Kolaka</title>

        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">

        <style type="text/css">

            body{

                padding: 20px;

                font-family: "Bookman Old Style";





                background-repeat: no-repeat;

                background-position:center;

            }





            .word-table {

                border:0px solid white !important; 

                border-collapse: collapse !important;

                width: 100%;

                align:center;

                font-family: "Bookman Old Style";
                  font-size: 12px;

            }

            .word-table tr th, .word-table tr td{

                border:0px solid black !important; 

                padding: 5px 10px;

                font-family: "Bookman Old Style";
                  font-size: 13px;

            }

            .wordx-table {

                border:0px solid black !important; 

                   padding: 5px 10px;

                width: 100%;

                align:center;

                font-family: "Times New Roman";

                font-size: 12px;

                margin-bottom: 0px;

            }

            .wordx-table tr th td, .wordx-table tr td{

                border:0px solid black !important; 

                padding: 5px 10px;

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

                    <td width="15%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="170px" height="110px"  align="top"> 



                    </td>

                    <td  >

                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>

                            <b><?php echo $this->config->item('namakampus');?></b><br />

                            <b><?php echo $fakultas->nm_fak ?></font></b><br/>

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

 <h4 align="center">SURAT KETERANGAN</h4>



<table class="word-table" align="center">

<tr><td width="3%"></td><td colspan=2 >Yang bertandatangan dibawah ini, menerangkan bahwa:</td></tr>
<tr><td width="3%"></td><td width="20%">Nama</td><td>:  <?php echo $mahasiswa->nm_mahasiswa;?> </td></tr>
<tr><td width="3%"></td><td  width="20%">NIM </td><td>:  <?php echo $mahasiswa->nim;?> </td></tr>
<tr><td width="3%"></td><td  width="20%">Program Studi </td><td>:  <?php echo $prodi->nm_prodi ?> </td></tr>
<tr><td width="3%"></td><td colspan=2>Berdasarkan hasil verifikasi bahwa yang tersebut namanaya diatas:</td></tr>
<tr><td width="3%"></td><td colspan=2><p>1.	IPK Sementara>= 2.0 <br>
2.	Tidak ada nilai E <br>
3.	Tidak memiliki tunggakan pembayaran SPP<br>
</p></td></tr>
<tr><td width="3%"></td><td></td></tr>
<tr><td width="3%"></td><td colspan=2>Sehingga yang bersangkutan diperkenankan untuk mengikuti Ujian Proposal.
<br>
<br>
Demikian keterangan atas perhatiannya diucapkan terimakasih.
</td></tr>

</table>

<table class="word-table">
    <tr><td></td><td></td><td width="30%"><p>Kolaka, <?php echo date('d-M-Y') ?> <br>
    Ketua Program Studi,
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php echo $prodi->ka_prodi;?>
    <br>
NIDN. <?php echo $prodi->nidn;?>
</p></td></tr>
</table>





        




        





        

        

</div>

    </body>

</html>