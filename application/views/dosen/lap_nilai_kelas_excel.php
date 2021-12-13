<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=nilai.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

   
 <table align="center" class="wordx-table"  >

                <tr align="center">
                   <img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                  
                    <td colspan=5 >
                        <p ><font size="3"><?php echo $this->config->item('kementerian');?><br/>
                            <b><?php echo $this->config->item('namakampus');?></b><br />
                            <b><?php echo $prodi->nm_fak ?></font></b><br/>
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
        <h3 align='center'>DAFTAR NILAI MAHASISWA<br>
        TAHUN AKADEMIK <?php echo $kd_tahun_ajaran?> </h3>
		
		<br />

<table class="word-table">
<tr>
	<td colspan=5>  <?php echo "DOSEN PENGAMPU".' : '.$head->nm_dosen ?></td>
	

</tr>
<tr>
	<td colspan=5> <?php echo "MATAKULIAH / SKS".' : '. $head->nm_mtk .' / '.$head->sks?></td>

</tr>
<tr>
<td colspan=5>  <?php echo "KELAS".' : '. $head->kelas?> </td>
</tr>

</table>


<table id="test" class="table table-bordered table-responsive">
<thead>
	<tr>
		<th>NO</th>
        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th>NILAI</td>
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td><?php echo $start++ ?></td>
		<td ><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>

		<td><?php echo $r->nilai?></td>


		

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

<table class="word-table">
	<tr>
		
		<td align="right" colspan=5>
			Kolaka, <?php echo date('d-M-Y');?>
		</td>

	
	</tr>
		<tr>
		    	<td align="center" colspan=5>
	
		</td>
		</tr>
	<tr>
		
		<td align="right" colspan=5>
		Dosen Pengampu
		</td>
	</tr>
</table>









                            
           