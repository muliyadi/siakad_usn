<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR KRS MAHASISWA BIMBINGAN </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-responsive">
<thead>
	<tr>
            <th>NAMA MAHASISWA</th>
		<th>TAHUN AJARAN</th>
		<th>NO KRS</th>
		<th>TGL KRS</th>
		
		<td>SEMESTER</td>
		<td>IPS SEBELUMNYA</td>
		<td>MAKS SKS</td>
		<td>TOTAL SKS</td>
		<th>SETUJUI</th>
		<td>AKSI</td>


	</tr>
</thead>
<tbody>
<?php

    foreach ($listkrs as $r) {
    ?>
	<tr>
            <td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->kd_tahun_ajaran?></td>
		<td><?php echo $r->no_krs?></td>
		<td><?php echo $r->tgl_krs?></td>
		
		
                <td><?php echo $r->semester_ke?></td>
		<td><?php echo $r->ips_sebelumnya?></td>
		<td><?php echo $r->maks_sks?></td>
		<td><?php echo $r->tot_sks?></td>
		<td><?php echo $r->setujui_pa?></td> 
		<td>
			<?php 
			 
			
			echo anchor(site_url('dosen/setujui_krsmb/'.$r->no_krs),'<i class="fa fa-pencil-square-o"> Setujui</i>',array('title'=>'Setujui')); 
			echo ' | '; 
			echo anchor(site_url('dosen/batal_setujui_krsmb/'.$r->no_krs),'<i class="fa fa-pencil-square-o"> Batal</i>',array('title'=>'Batal')); 
			echo ' | '; 
			echo anchor(site_url('dosen/ekrs/'.$r->no_krs),'<i class="fa fa-eye"> Detail</i>',array('title'=>'Detail KRS'));
			
			
			?>
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
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>