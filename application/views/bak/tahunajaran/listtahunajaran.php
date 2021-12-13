<div class="panel panel-primary">
<div class="panel-heading">
<h6 class='panel-title'>DATA TAHUN AKADEMIK </h6>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
		<th>KODE TA</th>
		<td>TAHUN AJARAN</td>
		<td>SEMESTER</td>
		<td>DESKRIPSI</td>
		<td>AKTIF</td>
		<td>AKSI</td>
		
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
		<td>
			<?php echo $r->kd_tahun_ajaran?>
		</td>
		<td>
			<?php echo $r->tahun_ajaran?>
		</td>
		<td>
			<?php echo $r->semester?>
		</td>
		<td>
			<?php echo $r->keterangan?>
		</td>
		<td>
			<?php echo $r->aktif?>
		</td>
		<td>
		    <?php 
		        if($r->aktif=='ya')
		    {
		        ?>
		        <a href="<?php echo base_url('bak/noaktif_ta').'/'.$r->kd_tahun_ajaran?>" class="btn btn-xs btn-default">Non Aktif</a>
			    
		    <?php
		    }else
		    {
		        ?>
		        <a href="<?php echo base_url('bak/aktif_ta').'/'.$r->kd_tahun_ajaran?>" class="btn btn-xs btn-info">Aktif</a>
			    
		    <?php
		    }
		    ?>
		    
			<a href="<?php echo base_url('bak/edit_ta').'/'.$r->kd_tahun_ajaran?>" class="btn btn-xs btn-warning">Edit</a>
			<a href="<?php echo base_url('bak/delete_ta').'/'.$r->kd_tahun_ajaran?>" class="btn btn-xs btn-danger">Delete</a>
		</td>
		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a href="<?php echo base_url()?>bak/fta" class="btn btn-sm btn-primary">Tambah Data</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#test').DataTable({
                             "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
                    </script>