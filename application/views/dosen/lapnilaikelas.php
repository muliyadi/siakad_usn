<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>SIAKAD USN KOLAKA</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">
        <style>
            body{
                padding: 20px;
            }
		
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
				align:center;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 4px 4px;
            }
			.wordx-table {
                border:0px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
				align:center;
				padding: 2px
            }
            .wordx-table tr th, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 5px 10px;
                padding: 2px
            }
hr.style2 {

                border-top: 3px double #8c8b8b;

                height: 1px;

                margin-top: 0px;

                margin-bottom: 0px;

                padding: 0px

            }
        </style>
    </head>
    <body>
 <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                            <?php echo $this->config->item('namakampus');?><br />
                           <b><?php echo $prodi->nm_fak ?></b><br/>
                           
                            <font size="2"><?php echo $this->config->item('alamatinduk');?><br/>
                           <?php echo $this->config->item('telp');?><br/>
                            Email:<?php echo $this->config->item('email');?>; Website:<?php echo $this->config->item('website');?>
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
          <hr class="style2">
        <h4 align='center'>DAFTAR NILAI MAHASISWA</h3>
		

<div class="container">


<table class="wordx-table">
    <tr>
    <td width="17%">Program Studi</td>
    <td width="21%">= <?php echo $prodi->nm_prodi ?></td>
    <td width="">&nbsp;</td>
    <td width="14%">Matakuliah</td>
    <td width="29%">= <?php echo $head->nm_mtk ?></td>
  </tr>
  <tr>
    <td>Tahun Akademik</td>
    <td>= <?php echo $kd_tahun_ajaran?></td>
    <td>&nbsp;</td>
    <td>SKS / Kelas</td>
    <td>= <?php echo $head->sks.'/'.$head->kelas?></td>
  </tr>

</table>
<table id="test" class="word-table">
<thead>
	<tr>
		<td align="center">NO</th>
        <td align="center">NIM</th>
		<td>NAMA MAHASISWA</th>
		<td align="center">ANGKATAN</th>
		<td align="center">NILAI AKHIR</td>
		<td align="center">NILAI MUTU</td>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td align="center"><?php echo $start++ ?></td>
		<td align="center"><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td align="center"><?php echo $r->angkatan?></td>
<td align="center"><?php echo $r->nilai_angka?></td>
		<td align="center"><?php echo $r->nilai?></td>


		

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

<table class="wordx-table">
	    <tr><td></td><td align="center" width="30%">Kolaka, <?php echo date('d-M-Y');?></td></tr>
        <tr><td></td><td align="center" width="30%">Dosen Pengampu</td></tr>
		<tr height='100'><td align="right"></td><td align="center"><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo base_url('dosen/nilai_kelas').'/'.$head->kd_jadwal?>" width="80"></td></tr>
		<tr><td align="right"></td><td align="center"><u><?php echo $dosen?></u></td></tr>
    </table>
</div>
    </body>
</html>








                            
           