<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>SIAKAD USN KOLAKA</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
                padding: 5px 10px;
            }
			.wordx-table {
                border:0px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
				align:center;
            }
            .wordx-table tr th, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 5px 10px;
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
                            <b><?php echo $this->config->item('namakampus');?></b><br />
                            <b><?php echo $prodi->nm_fak ?></font></b><br/>
                            <font size="3"><?php echo $this->config->item('alamatinduk');?><br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: <?php echo $this->config->item('email');?>; Website: <?php echo $this->config->item('website');?>
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>

        <h3 align='center'>LAPORAN JUMLAH MAHASISWA PADA SETIAP KELAS </h3>
		<h3 align='center'>TAHUN AJARAN : <?PHP ECHO $kd_tahun_ajaran?> </h3>
		
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >NO</th>
		<th >KODE/NIDN</th>
		<th >NAMA DOSEN</th>
		<th >MATAKULIAH</th>
		<th>SKS</th>
		<th >SMSTR</th>
		<th >KELAS</th>
		<th >JADWAL</th>
		<th >JUMLAH MHS</th>
		
        </tr>
		<?php
            $start=0;
            foreach ($list as $row)
            {

                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $row->kd_dosen.'/'.$row->nidn?></td>
		      <td><?php echo $row->nm_dosen ?></td>
		      <td><?php echo $row->nm_mtk ?></td>
		      <td><?php echo $row->sks ?></td>
		      <td><?php echo $row->semester_ke ?></td>
		      <td><?php echo $row->kelas ?></td>
		       <td><?php echo $row->hari.','.$row->jam ?></td>
		      <td><?php echo $row->jumlah ?></td>
             <td><a href="<?php echo base_url().'prodi/fabsensi/'.$row->kd_jadwal?>"class="btn btn-default btn-xs" >Print Absensi</a>                 </td>
		     <td><a href="<?php echo base_url().'prodi/fberita_acara_final/'.$row->kd_jadwal?>"class="btn btn-default btn-xs" >Print Berita Acara Final</a>                 </td>
		      
			 
                </tr>
                <?php
				
            }

            ?>

        </table>
		
	

    </body>
</html>