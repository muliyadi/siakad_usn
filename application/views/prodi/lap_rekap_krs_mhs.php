<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SIAKAD USN Kolaka </title>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        
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
                padding: 5px;
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
                font-size: 12px;
                margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 5px 5px;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
                
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
                <p align="center"><b> PROGRAM STUDI <?php echo $prodi->nm_prodi ?><br>LAPORAN REKAP SKS MAHASISWA <br>
                ANGKATAN <?php echo $angkatan.' ' ;?>TAHUN AKADEMIK <?php echo $ta_awal.'-'.$ta_akhir;?>
               </b></p>

            </div>
            
<table class="word-table" id="tabel" >
<thead>
	<tr>
		<th align="center">NO</th>

        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th>NO HP</th>
		<th>NILAI UKT</th>
	    <th>BANTUAN</th>
		<th>STATUS</th>
		
		
	<?php
foreach($listta as $ta)
{
    ?>

    <td align="center"><?php echo 'SKS '.$ta->kd_tahun_ajaran?></td>
    <?php
}
?>
	<th style="align:center">TOT.SKS</th>
		<th  style="align:center">IPK</th>
		<th  style="align:center">TOT. TIDAK AKTIF</th>
		<th>AKSI</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	$tot_tidak_aktif=0;
	$tot_tidak_aktif_2=0;
$tot_tidak_aktif_3=0;
$tot_tidak_aktif_4=0;
    foreach ($list as $r) {
    ?>
	<tr >
		<td align="center"><?php echo $start++ ?></td>
		<td align="center" ><?php echo $r['nim']?></td>
		<td><?php echo $r['nm_mahasiswa']?></td>
		<td align="center"><?php echo $r['angkatan']?></td>
			<td align="center"><?php echo $r['no_hp']?></td>
        <td><?php echo $r['ukt']?></td>
        <td><?php echo $r['beasiswa']?></td>
   
     <td><?php echo $r['status']?></td>
<?php
$jum=0;
foreach($listta as $ta)
{
    if($r[$ta->kd_tahun_ajaran]==0)
    {
       $jum=$jum+1; 
        ?>
        <td align="center" style="background-color: red;"><?php echo $r[$ta->kd_tahun_ajaran]?></td>
        <?php
    }else
    {
        ?>
         <td align="center" ><?php echo $r[$ta->kd_tahun_ajaran]?></td>
        <?php
    }
    ?>
    <?php
}
?>
<td align="center"><?php echo $r['jum_sks']?></td>
<?php
if($r['ipk']>=3.5)
    {
        ?>
        	<td align="center" ><?php echo round($r['ipk'],2). '*';?></td>
        <?php
    }else
    {
        ?>
        	<td align="center" ><?php echo round($r['ipk'],2)?></td>
        <?php
    }
    ?>
			<td align="center"><?php echo $jum?></td>
			<td>
	<?php
	if($jum>='3' and  $r['status']!='K' )
	{
	  ?> 
	  <a href="<?php echo base_url('prodi/save_mhs_keluar').'/'.$r['nim']?>" class="btn btn-info btn-xs">DO</a></td>
	<?php
	}?>
	</tr>
	<?php
	if($jum=='2')
	{
	    $tot_tidak_aktif_2=$tot_tidak_aktif_2+1;
	}elseif($jum=='3')
	{
	    $tot_tidak_aktif_3=$tot_tidak_aktif_3+1;
	}elseif($jum>3)
	{
	    $tot_tidak_aktif_4=$tot_tidak_aktif_4+1;
	}
                            }
                            ?>
</tbody>

</table>
<br>
<table class="wordx-table">
    
    <tr>
        <td width="35%">Total Mahasiswa Tidak Aktif 2 Semester=<?php echo $tot_tidak_aktif_2?></td>
         <td width="35%"></td>
        <td align="left">  Kolaka, <?php echo date('d-M-Y'); ?> </td>
    </tr>
    <tr height="100">
         <td width="35%">Total Mahasiswa Tidak Aktif 3 Semester=<?php echo $tot_tidak_aktif_3?></td>
        <td width="35%"></td>
        <td> </td>
    </tr>
        <tr>
             <td width="35%">Total Mahasiswa Tidak Aktif 4 Semester Lebih=<?php echo $tot_tidak_aktif_4?></td>
        <td width="35%"></td>
        <td align="left"><?php echo $prodi->ka_prodi?></td>
    </tr>
</table>

          
    </body>
</html>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#tabel').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>
                    









