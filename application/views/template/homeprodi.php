<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
   <div class="panel-heading"><h3 class="panel-title" align="center">PROGRAM STUDI <?php echo $prodi->nm_prodi?></h3></div>
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
<div class="col-md-12">
 <div class="panel panel-success">
<div class="panel-heading">Informasi  </div>
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

</div>
</div> 
</div>
</div>
<div class="row">
<div class="col-md-12">
 <div class="panel panel-success">
<div class="panel-body">
   
	  
 <div id="grafik" >
</div>
</div> 
</div>
</div>
    
<div class="row">
<div class="col-md-6">
<div class="panel panel-info">

<div class="panel-body">
  <div id="container" >

</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-info">

<div class="panel-body">
<div id="container_lulus">
    
</div>
</div>
</div>

</div>


</div>
<div class="row">
    <div class="col-md-3">
<div class="panel panel-info">

<div class="panel-body">
  <div id="container2" >

</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="panel panel-info">

<div class="panel-body">
<div id="container3">
    
</div>
</div>
</div>
</div>
    
<div class="col-md-3">
<div class="panel panel-info">

<div class="panel-body">
<div id="container_tidak_aktif">
    
</div>
</div>
</div>

</div>
<div class="col-md-3">
<div class="panel panel-info">

<div class="panel-body">
<div id="container_cuti">
    
</div>
</div>
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
            text: 'Grafik Mahasiswa Per Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
<?php      
  
foreach ($listdata as $key2) {
	  ?>
	  {
		  name: '<?php echo $key2['angkatan']; ?>',
		  data: [<?php echo $key2['jumlah']; ?>]
	  },



<?php }?>
]
});
}



);
</script>

<script type="text/javascript">
	var chart2;
$(document).ready(function() {
      chart2 = new Highcharts.Chart({
         chart: {
            renderTo: 'container2',
            type: 'column'
         },   
         title: {
            text: 'Grafik Mahasiswa Registrasi Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
         
              series:             
            [
<?php      
  
foreach ($listdata4 as $row) {
	  ?>
	  {
		  name: '<?php echo $row['angkatan']; ?>',
		  data: [<?php echo $row['jumlah']; ?>]
	  },



<?php }?>
]
});
}
);
</script>
<script type="text/javascript">
	var chart3;
$(document).ready(function() {
      chart3 = new Highcharts.Chart({
         chart: {
            renderTo: 'container3',
            type: 'column'
         },   
         title: {
            text: 'Grafik Mahasiswa KRS Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
         
              series:             
            [
<?php      
  
foreach ($listdata3 as $row) {
	  ?>
	  {
		  name: '<?php echo $row['angkatan']; ?>',
		  data: [<?php echo $row['jumlah']; ?>]
	  },



<?php }?>
]
});
}
);
</script>

<script>
        var chart; 
        $(document).ready(function() {
              chart = new Highcharts.Chart(
              {
                  
                 chart: {
                    renderTo: 'grafik',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                     type: 'pie'
                 },   
                 title: {
                    text: 'Grafik Jumlah Mahasiswa'
                 },
                 tooltip: {
                    formatter: function() {
                        return '<b>'+
                        this.point.name +'</b>: '+ (this.point.y);
                    }
                 },
                 
                
                 plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: 'green',
                            formatter: function() 
                            {
                                return '<b>' + this.point.name + '</b>: ' + (this.point.y)+'-'+Highcharts.numberFormat(this.percentage, 2) +' % ';
                            }
                        }
                    }
                 },
                           series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                    <?php
                        foreach ($listdata0 as $row) {
	  ?>
	   [ 
                                '<?php echo $row['status'] ?>', <?php echo $row['jumlah']; ?>
                            ],



<?php }
                        ?>
             
                    ]
                }]
                    
              });
        }); 
                    
    </script>
<script type="text/javascript">
	var chartcuti;
$(document).ready(function() {
      chartcuti = new Highcharts.Chart({
         chart: {
            renderTo: 'container_cuti',
            type: 'column'
         },   
         title: {
            text: 'Grafik Mahasiswa CUTI Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
         
              series:             
            [
<?php      
  
foreach ($listdata2 as $row) {
	  ?>
	  {
		  name: '<?php echo $row['angkatan']; ?>',
		  data: [<?php echo $row['jumlah']; ?>]
	  },



<?php }?>
]
});
}
);
</script>
<script type="text/javascript">
	var chartlulus;
$(document).ready(function() {
      chartlulus = new Highcharts.Chart({
         chart: {
            renderTo: 'container_lulus',
            type: 'column'
         },   
         title: {
            text: 'Grafik Mahasiswa Lulus Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
         
              series:             
            [
<?php      
  
foreach ($listdata5 as $row) {
	  ?>
	  {
		  name: '<?php echo $row['angkatan']; ?>',
		  data: [<?php echo $row['jumlah']; ?>]
	  },



<?php }?>
]
});
}
);
</script>
<script type="text/javascript">
	var charttidakaktif;
$(document).ready(function() {
      charttidakaktif = new Highcharts.Chart({
         chart: {
            renderTo: 'container_tidak_aktif',
            type: 'column'
         },   
         title: {
            text: 'Grafik Mahasiswa Tidak Aktif Angkatan '
         },
         xAxis: {
            categories: ['Angkatan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
         
              series:             
            [
<?php      
  
foreach ($listdata6 as $row) {
	  ?>
	  {
		  name: '<?php echo $row['angkatan']; ?>',
		  data: [<?php echo $row['jumlah']; ?>]
	  },



<?php }?>
]
});
}
);
</script>