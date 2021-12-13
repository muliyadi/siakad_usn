<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Usulan DO</h3>
</div >
<div class="panel-body">
<form   action="" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
 

    <table class="table table-bordered table-hover table-striped" id="tmahasiswa" >
<thead>
	<tr>
	

        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th>NO HP</th>
		<th>NILAI UKT</th>
	    <th>BANTUAN</th>
		<th>STATUS</th>
		
		
	<?php
foreach($listta as $ta)
{
    ?>

    <td align="center"><?php echo 'SKS '.$ta->kd_tahun_ajaran?></td>
    <?php
}
?>
	<th style="align:center">TOT.SKS</th>
		<th  style="align:center">IPK</th>
		<th  style="align:center">TOT. TIDAK AKTIF</th>
		<th>AKSI</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	$tot_tidak_aktif=0;
	$tot_tidak_aktif_2=0;
$tot_tidak_aktif_3=0;
$tot_tidak_aktif_4=0;
    foreach ($list as $r) {
    ?>
	<tr >
	   
		<td align="center" > <?php echo $r['nim']?> <input type="hidden" id="nim" value="<?php echo $r['nim']?>"></td>
		<td><?php echo $r['nm_mahasiswa']?></td>
		<td align="center"><?php echo $r['angkatan']?></td>
			<td align="center"><?php echo $r['no_hp']?></td>
        <td><?php echo $r['ukt']?></td>
        <td><?php echo $r['beasiswa']?></td>
   
     <td><?php echo $r['status']?></td>
<?php
$jum=0;
foreach($listta as $ta)
{
    if($r[$ta->kd_tahun_ajaran]==0)
    {
       $jum=$jum+1; 
        ?>
        <td align="center" style="background-color: red;"><?php echo $r[$ta->kd_tahun_ajaran]?></td>
        <?php
    }else
    {
        ?>
         <td align="center" ><?php echo $r[$ta->kd_tahun_ajaran]?></td>
        <?php
    }
    ?>
    <?php
}
?>
<td align="center"><?php echo $r['jum_sks']?></td>
<?php
if($r['ipk']>=3.5)
    {
        ?>
        	<td align="center" ><?php echo round($r['ipk'],2). '*';?></td>
        <?php
    }else
    {
        ?>
        	<td align="center" ><?php echo round($r['ipk'],2)?></td>
        <?php
    }
    ?>
			<td align="center"><?php echo $jum?></td>
			<td>
	<?php
	if($jum>='3' and  $r['status']!='K' )
	{
	  ?> 
	  <a href="<?php echo base_url('prodi/save_mhs_keluar').'/'.$r['nim']?>" class="btn btn-info btn-xs">Keluar</a></td>
	<?php
	}elseif($jum>0 and ($r['status']!='K' ))
	{
	    ?>
	     <a href="#" class="btn btn-info btn-xs tidak_aktif">Tidak Aktif</a></td>
	<?php
	    
	}
	?>
	</tr>
	<?php
	if($jum=='2')
	{
	    $tot_tidak_aktif_2=$tot_tidak_aktif_2+1;
	}elseif($jum=='3')
	{
	    $tot_tidak_aktif_3=$tot_tidak_aktif_3+1;
	}elseif($jum>3)
	{
	    $tot_tidak_aktif_4=$tot_tidak_aktif_4+1;
	}
                            }
                            ?>
</tbody>

</table>
	 

 
	


  
	
</form>
</div >
</div >
                
                <!--batas awal  modal -->
               
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/angular.js')?>"></script>
                <script src="<?php echo base_url('assets/js/app.js')?>"></script>

                <script type="text/javascript">



                $(function() {
                        $("#lookup2").dataTable();
                    });



                         $('#tmahasiswa').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
                </script>
                
                <script type="text/javascript">
$("#tmahasiswa").on('click', '.tidak_aktif', function(e) {
    
var currentRow = $(this).closest("tr");

var nim = currentRow.find("#nim").val();
 
    

      var form_data = {

                                        nim: nim,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'prodi/tidak_aktif'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                           alert(pesan);
                                    
                                         
                                        }
                                    });

    
});
        </script>

				