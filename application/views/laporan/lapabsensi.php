<!doctype html>
<html>
    <head>
        <title>SIAKAD USN</title>

       
    </head>
    <body>

    <div class="container ">
        <table align="center" class="">
        
        <tr align="center">
		<td width="15%"><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="120px"  align="right">
            </td>
		<td>
               <p ><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>
                   <b>UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA</b><br />
					<b><?php echo $jadwal->nm_fak ?></font></b><br/>
                   <font size="3">Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517 <br/>
                   Email: rektorat@usn.ac.id; Website: https://usn.ac.id
                   </font></p>
        </td> 
		<td width="15%"></td>
        
        </tr>
       <tr><hr size="2"></hr></tr>
        <tr>
		<td width="5%"></td>
        
            <td align="center">
              <font size="3"> ABSENSI KEHADIRAN MAHASISWA<br/>
              PROGRAM STUDI <?php echo $jadwal->nm_prodi?></font>
        
            </td>
			<td width="5%"></td>
        
        </tr>
       
        </table>
        
       

<br />
<table class="" align="center">
<tr >
    <td width="160">MATAKULIAH</td><td width="10"> = </td><td ALIGN="LEFT" width="700"><?php echo $jadwal->nm_mtk?></td>
    
    <td align="LEFT" >KELAS</td><td width="10"> = </td><td ALIGN="LEFT"><?php echo $jadwal->kelas?></td>
    
</tr>
<tr>
<td >DOSEN PENGAMPU</td><td width="10"> = </td><td ALIGN="LEFT" ><?php echo $jadwal->nm_dosen ?></td>
<td align="LEFT"width="80">T.A/SEMESTER</td><td width="10"> = </td><td ALIGN="LEFT"><?php echo $jadwal->tahun_ajaran.'/'.$jadwal->semester?></td>
</tr>


</table>
		
		
        <table  width="100%" border="1px" style= "border-collapse:collapse">
        <thead >
        <tr>
        <th >No</th>
		<th >NIM</th>
		<th >NAMA</th>

		<th>I</th>
		<th >II</th>
		<th >III</th>
		<th >IV</th>
                <th >V</th>
                <th >VI</th>
                <th >VII</th>
                 <th >MID</th>
                <th >VIII</th>
                <th >IX</th>
                <th >X</th>
                <th >XI</th>
                <th >XII</th>
                <th >XIII</th>
                <th >XIV</th>
                <th >FINAL</th>
                
		
        </tr>
        </thead>
        <tbody style= "border-collapse:collapse">
		<?php
		$start=0;

            foreach ($listmhs as $row)
            {

            	
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $row->nim ?></td>
		      <td><?php echo $row->nm_mahasiswa?></td>
		    
                      <td width="3%"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
			                                  <td></td>
                      <td></td>
                </tr>
                <?php
				
            }
            
            ?>
        <tr><td colspan="4" align="right">Paraf Dosen Pengampu</td><td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>

                      			                                  <td></td>
                      <td></td></tr>
                     
                      </tbody>
                      <tfoot>
                           <tr><td colspan="11" border="0px">Kolaka,</td></tr>
                      </tfoot>
        </table>
	<p align="right">Kolaka</p>
</div>
    </body>
</html>