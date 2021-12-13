<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>SIAKAD USN Kolaka</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <style type="text/css">
            body{
                padding: 10px;
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
                font-size: 10px;
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
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.gif" alt="..." width="120px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                           <?php echo $this->config->item('namakampus');?><br>
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
            <div>
                <hr class="style2">
            </div>
            <p align=center>
           <font size="3"><?php echo $judul ?> <br>
            PROGRAM STUDI <?php echo $prodi->nm_prodi?><br>
		   
		  
		   ANGKATAN <?php echo $angkatan?><br>
		   TAHUN AKADEMIK <?php echo $kd_tahun_ajaran ?>
		   </font>
		</p>
		
		
        <table class="word-table table" style="margin-bottom: 10px">
        <tr>
        <th align="center" >NO</th>
        <th align="center" >NO REG</th>
         <th align="center" >TGL REG</th>
         <th align="center" >TGL BAYAR</th>
		<th >NIM</th>
		<th >NAMA</th>
		<th align=left>NILAI UKT</th>
		<th align=left>STATUS</th>
			<th align=left>BANTUAN</th>
		<th>Keterangan</th>
        </tr>
		<?php
        $start=0;
            foreach ($list as $row)
            {
            
            	
                ?>
                <tr>

		      <td align=center height=10><?php echo ++$start ?></td>
		  <td><?php echo $row->noreg ?></td>
          <td><?php echo $row->tgl_reg_bak ?></td>
          <td><?php echo $row->tgl_reg_bank ?></td>
		      <td><?php echo $row->nim ?></td>
		      <td><?php echo $row->nm_mahasiswa ?></td>
		      <td><?php echo $row->nilai_ukt ?></td>
             <td><?php echo $row->status ?></td>
              <td><?php echo $row->beasiswa ?></td>
		      <td></td>
			 
                </tr>
                <?php
				
            }
            
            ?>

        </table>
		
		<table align=right>
		    <tr height=20><td>Kolaka, <?php echo date('d-M-Y')?></td></tr> 
			<tr><td>Ketua Program Studi</td></tr> 
		    <tr height=120><td></td></tr>
		    <tr><td><?php echo $prodi->ka_prodi ?></td></tr>
		</table>
    </body>
</html>