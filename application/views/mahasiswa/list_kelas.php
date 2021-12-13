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
					<td>AKSI</td>
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
			<td><a class="btn btn-info btn-xs" href="<?php echo base_url('mahasiswa/kelas_gabung').'/'.$keya->kd_kelas?>">Gabung</a><a class="btn btn-primary btn-xs" href="<?php echo base_url('mahasiswa/keluar_kelas').'/'.$keya->kd_kelas?>">Keluar</a></td>
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