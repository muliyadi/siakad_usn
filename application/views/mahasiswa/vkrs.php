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
				font-size: "20px";
				margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 0px 0px;
				font-family: "Times New Roman";
				font-size: "20px"
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


<div>
 <p align="center"><b>USULAN RENCANA STUDI MAHASISWA</b></p>
 
</div>
<table class="wordx-table" align="center">
<tr>
    <td width="160">NIM</td><td width="10"> : </td><td ALIGN="LEFT" width="700"><?php echo $krsh->nim?></td>
    
    <td align="LEFT" >NO KRS</td><td width="10"> : </td>
    <td ALIGN="LEFT"><?php echo $krsh->no_krs?></td>
    
</tr>
<tr>
<td >MAHASISWA</td><td width="10"> : </td>
<td ALIGN="LEFT" ><?php echo $krsh->nm_mahasiswa ?></td>


    <td ALIGN="LEFT" width="160">TAHUN AJARAN</td><td width="10"> : </td>
    <td><?php echo $krsh->kd_tahun_ajaran?></td>
</tr>

<tr>
    <td ALIGN="LEFT" >PROGRAM STUDI</td><td width="10"> : </td><td ><?php echo  $krsh->nm_prodi?></td>
 <td ALIGN="LEFT" width="160">IPS / IPK</td><td width="10"> : </td>
    <td><?php echo round($krsh->ips,2).' / '.round($ipk,2)?></td>

</tr>
<tr>
    <td align="LEFT"width="80">ANGKATAN</td>
<td width="10"> : </td>
<td ALIGN="LEFT"><?php echo $krsh->angkatan?></td>
<td align="LEFT"width="80">MAKS. SKS</td>
<td width="10"> : </td>
<td ALIGN="LEFT"><?php echo $krsh->maks_sks?></td>
</tr>
</table>

        <table class="word-table" style="margin-bottom: 10px">
        <tr>
        <th style="text-align: center;" width="50" >NO.</th>
        <th width="160" style="text-align: center;" >KODE MATA KULIAH</th>
        <th >NAMA MATA KULIAH</th>
          
          <th style="text-align: center;">SKS</th>
          <th style="text-align: center;">SEMESTER</th>
         
         <th style="text-align: center;">KELAS</th>
        
        <th style="text-align: left;">JADWAL</th>
        <th>DISETUJUI</th>
        
        </tr>
        <?php
        $start=0;
        $totsks=0;
    
        
            foreach ($krsd  as $row)
            {
                $totsks=$totsks+$row->sks;
            $lebar=strlen($row->kd_mtk);
                ?>
            <tr>
            <td align="center"><?php echo ++$start ?></td>
            <td align="center"><?php echo substr($row->kd_mtk,4,$lebar) ?></td>
              <td ><?php echo $row->nm_mtk?></td>
              <td align="center"><?php echo $row->sks?></td>
               <td align="center"><?php echo $row->semester_ke?></td>
             
               <td align="center"><?php echo $row->kelas?></td>
               <td align="left"><?php echo 'Hari: '.$row->hari.', Jam: '.$row->jam?></td>

                <td><?php echo $row->status?></td>
                </tr>
                <?php
                
            }
            ?>
                <tr><th colspan="3" style="text-align: right;">JUMLAH SKS YANG DIPROGRAM </th>
                <th style="text-align: center;"><?PHP ECHO $totsks.' SKS'?></th><th></th><TH>KRS DISETUJUI</TH><th><?php echo $krsh->status?></th></tr>
        </table>

        <table align=right>
            <tr>
                <td>Penasehat Akademik,</td>
            </tr>
            <tr>
                <td height=100></td>
            </tr>
             <tr align="center">
                    <td height="0"><?php 
                    if($pa)
                    {
                    echo $pa->nm_dosen; }?></td>
                   
                </tr>
        </table>


        
        
</div>
    </body>
</html>