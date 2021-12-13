<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data KRS Mahasiswa </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-responsive">
<thead>
	<tr>
		<th>TAHUN AKADEMIK</th>
		<th>NO KRS</th>
		<th>TGL KRS</th>
        <th>IPS SEBELUMNYA</th>
        <th>MAKS. SKS</th>
        <th>JUMLA SKS</th>
		<td>STATUS </td>
		<td>AKSI</td>


	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
		<td><?php echo $r->kd_tahun_ajaran?></td>
		<td><?php echo $r->no_krs?></td>
		<td><?php echo $r->tgl_krs?></td>
<td><?php echo $r->ips_sebelumnya?></td>
<td><?php echo $r->maks_sks?></td>
<td><?php echo $r->tot_sks?></td>
		<td><?php echo $r->setujui_pa?></td> 
		<td>
			
			    <a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/reset_krs/'.$r->no_krs?>">Reset</a>
				<a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/vkrs/'.$r->no_krs.'/'.$r->nim?>">Detail</a>
		
		
			
		
		</td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#test').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
                    </script>