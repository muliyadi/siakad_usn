<!doctype html>
<html>
    <head>
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
        <h3 align='center'>JADWAL KULIAH</h3>
        <h3 align='center'>TAHUN AJARAN <?php echo $this->session->userdata('kd_tahun_ajaran');?>  </h3>
        
        
        
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th >NO.</th>
        <th >JADWAL</th>
        <th >MATA KULIAH</th>
        <th> SKS</th>
        <th >RUANG</th>
        
        </tr>
        <?php
        $start=0;
        
            foreach ($listjadwal as $row)
            {
                ?>
                <tr>
              <td><?php echo ++$start ?></td>
              <td><?php echo $row->hari.' ,'.$row->jam ?></td>
              
              <td><?php echo $row->nm_mtk ?></td>
              <td><?php echo $row->sks ?></td>
              <td><?php echo $row->kd_ruang ?></td>
              
                </tr>
                <?php
                
            }
            ?>
          
        </table>
        
       
</div>
    </body>
</html>