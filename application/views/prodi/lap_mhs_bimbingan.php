<!doctype html>
<html>
    <head>
        <title>SIAKAD USN Kolaka</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">
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
                padding: 5px 5px;
                font-family: "Times New Roman";
            }
            .wordx-table {
                border:0px solid black !important; 
                padding: 5px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 13px;
                margin-bottom: 5px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 0px 0px;
                font-family: "Times New Roman";
                font-size: 13px;
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
                            <b><?php echo $this->config->item('namakampus');?></b><br />
                            <?php echo $prodi->nm_fak ?></b><br/>
                           </font>
                            <font size="2"><?php echo $this->config->item('alamatinduk');?><br/>
                            <?php echo $this->config->item('email');?>; <?php echo $this->config->item('website');?>
                            </font></p>
                            
                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div>
            <div align="center">
                <b>DATA MAHASISWA BIMBINGAN <br>
              </b>

            </div>


<table class="wordx-table">
    <tr>
        <td width="120">Nama Dosen</td>
        <td>:</td>
        <td><?php echo $dosen->nm_dosen;?></td>
        <td></td>
         <td width="110">Program Studi</td>
        <td>:</td>
        <td width="120"><?php echo $prodi->nm_prodi ?></td>
    </tr>
     <tr>
        <td>NIDN</td>
        <td width="10">:</td>
        <td><?php echo $dosen->NIDN;?></td>
        <td></td>
        <td width="110" align="left">Tahun Akademik</td>
        <td width="10">:</td>
        <td align="left" width="60"><?php echo $this->session->userdata('kd_tahun_ajaran');?></td>
       
    </tr>
</table>

<table class="word-table" >
<thead>

	<tr>
		<td align="center">NO</td>

        <td align="center">NIM</td>
		<td>NAMA MAHASISWA</td>
		<td align="center">ANGKATAN</td>
		<td width="120">NO HP</td>
		<td align="center">STATUS</td>
		<td align="center">PARAF</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($listmhsbimbingan as $r) {
    ?>
	<tr>

		<td align="center"><?php echo $start++ ?></td>

		<td align="center"><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td align="center"><?php echo $r->angkatan?></td>
		<td align="center"><?php echo $r->no_hp?></td>
		
        	<td align="center"><?php echo $r->status?></td>
        <td></td>

        </td>
		
		
	</tr>
	<?php
                            }
           for ($i = 1; $i <= 4; $i++) {
    ?>
    <tr height="25">

		<td></td>

		<td ></td>
		<td></td>
		<td></td>
		<td></td>
        	<td></td>
        <td></td>
        </td>
		
		
	</tr>
	<?php
           
}

                            ?>
</tbody>
</table>

<table class="word-tabl" width="100%">
     <tr height='10'>
          <td  align='right'></td>
          <td  align='right' width="30%"></td>
    </tr>
    <tr>
        <td  align='right'></td>
     <td  align='right'>Kolaka, <?php echo date('d-M-Y'); ?></td>
    </tr>
    <tr height='100'>
        <td  align='right'></td>
          <td  align='right'></td>
    </tr>
        <tr>
            <td  align='right'></td>
             <td  align='left'> <u><?php echo $dosen->nm_dosen;?></u><br>
             NIDN.<?php echo $dosen->NIDN;?></td>
        
    </tr>
</table>

          

            



        </div>
    </body>
</html>















                            
           