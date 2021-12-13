
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
        <title>SIAKAD USN Kolaka</title>

    </head>
<body>


<div class="container" style="width: 40%">
        <canvas id="chartkurs"></canvas>
</div>





<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/chartJs/Chart.bundle.min.js') ?>"></script>
<script type="text/javascript">
var ctx = document.getElementById("chartkurs");
var myChart = new Chart(ctx, {
type:'pie',
data: {
 
  labels : [<?php 
  foreach ($list as $keya) 
  {
  	echo "'".$keya->kd_prodi."'".',';
  }?>],
  datasets : [{
    label : 'Dataset 1',
        data : [
            <?php
            foreach ($list as $key) {
        	echo $key->jumlah.',';
        }?>
                      ], 
backgroundColor: [
    "#41fbca",
    "#e56e14",
     "#fffff"
            ],
hoverBackgroundColor: [
      "#41fbca",
      "#e56e14",
       "#fffff"
          ]
    }
  ]
}
});
</script>
</body>
           
</html>