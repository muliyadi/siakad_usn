<style type="text/css">
.img {
  padding:5px;
  background-color:orange;
  border-radius:20px;
} 
</style>

<div class="row">

   
<div class="col-md-4">
 <div class="panel panel-primary">
<div class="panel-heading"></div>
<div class="panel-body" align="center">
    <div id="grafik" >
  
     
</div>
</div> 
</div>
     
</div>
<div class="col-md-8">
 <div class="panel panel-primary">
<div class="panel-heading"></div>
<div class="panel-body" align="center">
    <div id="container">
  
     
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
            text: 'Data Mahasiswa Fakultas Per Angkatan '
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
        var chart2; 
        $(document).ready(function() {
              chart2 = new Highcharts.Chart(
              {
                  
                 chart: {
                    renderTo: 'grafik',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                     type: 'pie'
                 },   
                 title: {
                    text: 'Status Mahasiswa Fakultas'
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
                        foreach ($tabulasi2 as $rows) {
	  ?>
	   [ 
                                '<?php echo $rows['status'] ?>', <?php echo $rows['jumlah']; ?>
                            ],



<?php }
                        ?>
             
                    ]
                }]
                    
              });
        }); 
                    
    </script>