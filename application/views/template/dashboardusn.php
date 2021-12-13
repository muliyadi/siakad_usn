
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
  <div id="container5" >

</div>
</div>
</div>
</div>
</div>
<div class="row">

<div class="col-md-4">
<div class="panel panel-info">

<div class="panel-body">
  <div id="container2" >

</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="panel panel-info">

<div class="panel-body">
  <div id="container3" >

</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="panel panel-info">

<div class="panel-body">
  <div id="container4" >

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
            text: 'Data Mahasiswa USN Per Angkatan '
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
  
foreach ($tabulasi as $key2) {
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
	var chart;
$(document).ready(function() {
      chart = new Highcharts.Chart({
         chart: {
            renderTo: 'container2',
            type: 'column'
         },   
         title: {
            text: 'Data Mahasiswa USN Registrasi SPP PerAngkatan '
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
  
foreach ($tabulasi2 as $key2) {
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
	var chart;
$(document).ready(function() {
      chart = new Highcharts.Chart({
         chart: {
            renderTo: 'container3',
            type: 'column'
         },   
         title: {
            text: 'Data Mahasiswa USN Registrasi Cuti PerAngkatan '
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
  
foreach ($tabulasi3 as $key2) {
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
	var chart;
$(document).ready(function() {
      chart = new Highcharts.Chart({
         chart: {
            renderTo: 'container4',
            type: 'column'
         },   
         title: {
            text: 'Data Mahasiswa USN Tidak Registrasi PerAngkatan '
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
  
foreach ($tabulasi4 as $key2) {
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
	var chart;
$(document).ready(function() {
      chart = new Highcharts.Chart({
         chart: {
            renderTo: 'container5',
            type: 'column'
         },   
         title: {
            text: 'Data Mahasiswa USN Lulus PerAngkatan '
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
  
foreach ($tabulasi5 as $key2) {
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
