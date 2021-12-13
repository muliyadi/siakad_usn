
<div class="panel panel-primary">
<div class="panel-body">
   	Jumlah Mahasiswa Setiap Prodi<hr align="center" size="1" color="#cccccc">


 <table id="TableSiswa" border="1" align="center" cellpadding="10">
	<tr bgcolor="#FF9900" style="display: none;">
		<th>Prodi</th><th>Jumlah </th>
		
	</tr>
<?php
	$tot=0;
    foreach ($listdata as $data) {
	// $dataku2=sprintf('%0.2f',$data['jumlah']);
		echo "<tr bgcolor='#D5F35B' style='display:none;'>
              <td>$data[singkatan]</td>
              <td align='center'>$data[jumlah]</td>
              </tr>";
    }
    ?>

</table>
</div>
</div>
<div class="panel panel-primary">
    <div class="panel-body">
NILAI UKT SETIAP FAKULTAS<hr align="center" size="1" color="#cccccc">

<table id="TableSiswa2" border="0" align="center" cellpadding="10">
  <tr bgcolor="#FF9900" style="display: none;">
    <th>Prodi</th><th>Jumlah </th>
   
  </tr>
<?php
  $tot=0;
    foreach ($listdata2 as $data) {
      $dataku=sprintf('%0.2f',$data['jumlah']);
    echo "<tr bgcolor='#D5F35B' style='display:none;'>
              <td> $data[kd_fak]</td>
              <td align='center'>$dataku</td>

              </tr>";
    }
    ?>

</table>
</div>
</div>
<div class="panel panel-primary">
    <div class="panel-body">
JUMLAH MAHASISWA TELAH MEMBAYAR SPP SETIAP PRODI TAHUN AJARAN BERJALAN<hr align="center" size="1" color="#cccccc">

<table id="TableSiswa3" border="0" align="center" cellpadding="10">
  <tr bgcolor="#FF9900" style="display: none;">
    <th>Prodi</th><th>Jumlah </th>
   
  </tr>
<?php
  $tot=0;
    foreach ($listdata3 as $data) {
    echo "<tr bgcolor='#D5F35B' style='display:none;'>
              <td>$data[singkatan]</td>
              <td align='center'>$data[jumlah]</td>
              </tr>";
    }
    ?>

</table>
</div>
</div>
<!-- <button id="test">Test</button>
 -->
 <!-- <table id="TableSiswa" border="0" align="center" cellpadding="10">
    <tr bgcolor="#FF9900" > <th>Kelas</th> <th>Jumlah Siswa</th></tr>
    <tr bgcolor='#D5F35B' >
              <td>Kelas X</td>
              <td align='center'>16</td>
              </tr>
      <tr bgcolor='#D5F35B' >
              <td>Kelas XI IPA</td>
              <td align='center'>8</td>
              </tr><tr bgcolor='#D5F35B' >
              <td>Kelas XI IPS</td>
              <td align='center'>6</td>
              </tr><tr bgcolor='#D5F35B' >
              <td>Kelas XII Bahasa</td>
              <td align='center'>0</td>
              </tr>
</table>
 -->



<script src="<?php echo base_url() ?>assets/chart/JS/jquery-1.4.js"></script>
<script src="<?php echo base_url() ?>assets/chart/JS/jquery.fusioncharts.js"></script>

