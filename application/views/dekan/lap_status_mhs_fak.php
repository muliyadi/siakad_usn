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
<div class="container">
        <h3 align='center'>LAPORAN STATUS MAHASISWA </h3>
        <h3 align='center'>TAHUN AJARAN </h3>
        
        
        
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >NO</th>
        <th >NIM</th>
        <th> MAHASISWA</th>
        <th >ANGKATAN</th>
        <th >KODE PRODI</th>
        <th >STATUS</th>
        
        </tr>
        <?php
        $start=0;
        $TOTAL=0;
    
            foreach ($list as $row)
            {
               
                ?>
                <tr>
              <td><?php echo ++$start ?></td>
             
              <td><?php echo $row->nim ?></td>
              <td><?php echo $row->nm_mahasiswa ?></td>
              <td><?php echo $row->angkatan ?></td>
              <td><?php echo $row->kd_prodi ?></td>
               <td><?php echo  $row->status?></td>
              
             
                </tr>
                <?php
                
            }
            ?>
            
        </table>
        
       
</div>
    </body>
</html>