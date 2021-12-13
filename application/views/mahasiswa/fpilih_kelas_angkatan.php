<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pilih Kelas Angkatan</h3>
</div >
<div class="panel-body">
	
    <form   action="<?php echo base_url();?>mahasiswa/kelas_gabung" method="post" class="form-user form-horizontal" id="aktifta">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Kelas</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
  <?php 
    $list2=array();
    
    foreach($list_kelas as $row)
    {
        $test=$row->kelas;
        $list2[$row->kd_kelas]=$test;
    }
    echo form_dropdown('kd_kelas',$list2,$kd_kelas,"class='form-control  drop_down'");    
    ?>
    
          </div>
    </div>
<button type="submit">Pilih</button>
</form>
</div>

</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>LIST KELAS ANGKATAN</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="krs" class="table table-bordered">
		<thead>
			<tr>
			    <td>ANGKATAN</td>
			    <td>KELAS </td>
				<td>KUOTA </td>
				<td>JUMLAH </td>

			</tr>
		</thead>
		<tbody>
		<?php
       
		foreach ($list_kelas as $keya) {
		     $jum=0;
		    foreach($list_jumlah as $row)
		    {
		        
		    if($keya->kd_kelas==$row->kd_kelas)
		    {
		        $jum=$row->jumlah;
		?>
			
			<?php
}

}?>
<tr>
		    <td><?php echo $keya->angkatan?></td>
			<td><?php echo $keya->kelas?></td>
			<td><?php echo $keya->kuota?></td>
			<td><?php echo $jum?></td>
		
			</tr>
<?php

}?>
		</tbody>
		</table>
	
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

           $('#krs').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
</script>