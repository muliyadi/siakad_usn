<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR JADWAL MATAKULIAH</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr><td>
			TGL PERMINTAAN AKSES
		</td>
	    <td>
			DOSEN PENGAMPU
		</td>
		<td>
			MATAKULIAH (SKS)
		</td>

		<td>
			KELAS
		</td>
		<td>
			PENJELASAN
		</td>
		<td>
			PROGRAM STUDI
		</td>

		
		<th>Status</th>
		<td>
			Aksi
		</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($list_permintaan as $r) {
    ?>
	<tr>
	<td><?php echo $r->tgl_usul?></td>
		<td><?php echo $r->nm_dosen.' - '.$r->NIDN?></td>
		<td><?php echo $r->nm_mtk.' ('.$r->sks.') '?></td>
		<td><?php echo $r->kelas?></td>
		<td><?php echo $r->penjelasan?></td>
		<td><?php echo $r->nm_prodi?></td>
		<td><?php echo $r->status?></td>
		<td>
		    
		    <a href="<?php echo base_url().'pddikti/setujui_permintaan_akses_nilai/'.$r->kd_jadwal?>" class="btn btn-info btn-xs" onclick="return confirm('Anda yakin?');" >Setujui</a>
		   <a href="<?php echo base_url().'pddikti/tolak_permintaan_akses_nilai/'.$r->kd_jadwal?>" class="btn btn-primary btn-xs" onclick="return confirm('Anda yakin?');" >Tolak</a>
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
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
                    </script>