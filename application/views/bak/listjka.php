<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>KALENDER AKADEMIK</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    <td>
			WAKTU PELAKSANAAN
		</td>


		<td>
			KEGIATAN 
		</td>


		<td>
			AKTIF
		</td>
		<td>
			AKSI
		</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
	    <td>
			<?php echo date('d-m-Y', strtotime($r->dari_tanggal))?> - <?php echo date('d-m-Y', strtotime($r->sampai_tanggal))?>
		</td>

		<td>
			<?php echo $r->nm_kegiatan.'/'.$r->kd_kegiatan?>
		</td>

		<td>
			<?php echo $r->aktif?>
		</td>
		<td>
		    
		    	<a href="<?php echo base_url('bak/oja').'/'.$r->kd_tahun_ajaran.'/'.$r->kd_kegiatan?>" class="btn btn-xs btn-primary">Buka</a>
		    		<a href="<?php echo base_url('bak/cja').'/'.$r->kd_tahun_ajaran.'/'.$r->kd_kegiatan?>" class="btn btn-xs btn-success">Tutup</a>
		    		<a href="<?php echo base_url('bak/eja').'/'.$r->kd_tahun_ajaran.'/'.$r->kd_kegiatan?>" class="btn btn-xs btn-info">Edit</a>

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
	<a href="<?php echo base_url('bak/fja')?>" class="btn btn-sm btn-primary">Tambah Data</a>

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
            "autoWidth": true
        });
                    </script>