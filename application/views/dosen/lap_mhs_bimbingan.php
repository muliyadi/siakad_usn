<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                            <b><?php echo $this->config->item('namakampus');?></b><br />
                            <?php echo $prodi->nm_fak ?></b><br/>
                            PROGRAM STUDI <?php echo $prodi->nm_prodi ?><br/></font>
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
            <div>
                <p align="center"><b>LAPORAN KONSULTASI AKADEMIK MAHASISWA <br>
                TAHUN AKADEMIK <?php echo $this->session->userdata('kd_tahun_ajaran');?></b></p>

            </div>
            
<table class="word-table" >
<thead>
	<tr>
		<th>NO</th>
        <th>PRODI</th>
        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th width="120">NO HP</th>
		<th>STATUS</th>
		<td>PARAF</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($listmhsbimbingan as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
        <td ><?php echo $r->kd_prodi?></td>
		<td ><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
		<td><?php echo $r->no_hp?></td>
        	<td><?php echo $r->status?></td>


        </td>
		<td>
		</td>

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>


          <table class="wordx-tabl" width="100%">
     <tr height='10'>
          <td  align='right'></td>
    </tr>
    <tr>
     <td  align='right'>Kolaka, <?php echo date('d-M-Y'); ?></td>
    </tr>
    <tr height='100'>
          <td  align='right'></td>
    </tr>
        <tr>
             <td  align='right'> <?php echo $dosen->nm_dosen;?></td>
        
    </tr>
</table> 



        </div>
    </body>
</html>















                            
           