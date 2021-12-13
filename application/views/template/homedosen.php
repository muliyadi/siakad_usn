<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
   <div class="panel-heading"><h3 class="panel-title" align="center">PROGRAM STUDI <?php echo $prodi->nm_prodi?></h3></div>
    <div class="panel-body">
        
    <p style="text-align: center">
    <?php echo '<h4 style="text-align: center">Visi</h3><h5 style="text-align: center">'.$prodi->visi_misi;?></h5>
    <?php echo '<h4 style="text-align: center">Misi</h3><h5 style="text-align: center">'.$prodi->misi;?></h5>
    
    </p>
    </div>
</div>
</div>
    

</div>
<div class="row">
    <div class="col-md-4">
<div class="panel panel-primary">
<div class="panel-heading">Jadwal Kuliah</div>
<table id="" border="1" align="center" cellpadding="10"class="table" >
	<tr>
	    <th>Jadwal</th>
		<th>Matakuliah</th>
		<th>SKS</th>
		<th>Kelas</th>
		<th>Ruang</th>
		<th>Prodi</th>
	</tr>
<?php
    foreach ($list3 as $row3) {
        ?>
		<tr>
		    <td align='left'><?php echo $row3->hari.','.$row3->jam?></td>
            <td align='left'><?php echo $row3->nm_mtk?></td>
            <td align='center'><?php echo $row3->sks?></td>
            <td align='left'><?php echo $row3->kelas?></td>
             <td align='left'><?php echo $row3->kd_ruang?></td>
            <td align='left'><?php echo $row3->kd_prodi?></td>
        </tr>
    <?php
    }
    ?>

</table>
</div>
</div>
    <div class="col-md-4">
<div class="panel panel-primary">
<div class="panel-heading">Kalender Akademik</div>

<table id="" border="1" align="center" cellpadding="10"class="table" >
	<tr>
	    <th>Kegiatan Akademik</th>
		<th>Dari Tanggal</th>
		<th>Sampai Tanggal</th>
		<th>Aktif</th>
	</tr>
<?php
    foreach ($kalender_akademik as $ka) {
        ?>
		<tr>
		    <td align='left'><?php echo $ka->nm_kegiatan?></td>
            <td align='left'><?php echo date('d F Y', strtotime($ka->dari_tanggal));?></td>
            <td align='left'><?php echo date('d F Y', strtotime($ka->sampai_tanggal));?></td>
            <td align='left'><?php echo $ka->aktif?></td>
        </tr>
    <?php
    }
    ?>

</table>
</div>
</div>
    <div class="col-md-4">
<div class="panel panel-primary">
<div class="panel-heading">Jumlah Mahasiswa Bimbingan Belum Lulus</div>

 <table id="" border="1" align="center" cellpadding="10"class="table" >
	<tr>
		<th>Tahun Akademik</th><th>Pembimbing Ke- </th><th>Jumlah</th>
	</tr>
<?php
	$tot=0;
    foreach ($list1 as $row) {
	// $dataku2=sprintf('%0.2f',$data['jumlah']);
		echo "<tr >
              <td>$row->kd_tahun_ajaran</td>
              <td align='center'>$row->pembimbing_ke</td>
              <td align='center'>$row->jumlah</td>
              </tr>";
    }
    ?>

</table>

</div>

</div>
</div>


<div class="row">

    <div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">Jadwal Ujian Lengkap</div>
<table id="" border="1" align="center" cellpadding="10"class="table" >
	<tr>
	    <th>Jadwal</th>
	    <th>Jenis Ujian</th>
	    <th>NIM</th>
	    <th>Nama Mahasiswa</th>
	    <th>Judul</th>
		<th>Pembimbing </th>
		<th>Penguji</th>

	
		
	</tr>
<?php
if($jadwalujianlengkap)
{
    foreach ($jadwalujianlengkap as $row3) {
        
        
         
        ?>
		<tr>
		     <td><?php echo $row3['tgl_ujian'].', '.$row3['jam']?></td>
		    <td align='left'><?php echo $row3['jenis_ujian']?></td>
		    <td><?php echo $row3['nim']?></td>
		     <td align='left'><?php echo $row3['nm_mahasiswa']?></td>
		     <td align='left'><a href=<?php echo $row3['link_draft'] ?>><?php echo $row3['judul']?></a></td>
            <td align='left'><?php echo $row3['pembimbing']?></td>

             <td align='left'><?php echo $row3['penguji']?></td>

           


        </tr>
    <?php
    }
}
    ?>

</table>
</div>


</div> 


 <script src="https://jouteetu.net/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async></script>
 <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url() ?>assets/chart/JS/jquery.fusioncharts.js"></script>
<script>
    $('#notifications').slideDown('slow').delay(7000).slideUp('slow');
</script>

<script type="text/javascript">

$('#TableSiswa').convertToFusionCharts({
        swfPath: "<?php echo base_url() ?>assets/chart/Charts/",
        type: "MSColumn3D",
        data: "#TableSiswa",
		height: "300",
        width: "700",
		
        dataFormat: "HTMLTable"
    });



</script>