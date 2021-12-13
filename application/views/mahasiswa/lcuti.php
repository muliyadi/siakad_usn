<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>List CUTI</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="krs" class="table table-bordered">
		<thead>
			<tr>
			    <td>TAHUN AKADEMIK</td>
			<td>NO CUTI </td>
				<td>TGL PENGAJUAN </td>
				
				<td>ALASAN</td>
				<td>APPROVE PA</td>
				<td>APPROVE PRODI</td>
				<td>APPROVE BAAK</td>
					<td>AKSI</td>
			</tr>
		</thead>
		<tbody>
		<?php

		foreach ($list as $keya) {
		?>
			<tr>
			    <td><?php echo $keya->kd_tahun_ajaran?></td>
			<td><?php echo $keya->no_cuti?></td>
			<td><?php echo $keya->tgl_cuti?></td>
			
			<td><?php echo $keya->alasan?></td>
			<td><?php echo $keya->approve_pa?></td>
			<td><?php echo $keya->approve_prodi?></td>
			<td><?php echo $keya->approve_bak?></td>
			<td><a class="btn btn-warning btn-xs" href="<?php echo base_url('mahasiswa/edit_cuti').'/'.$keya->no_cuti?>">Edit</a><a class="btn btn-primary btn-xs" href="<?php echo base_url('mahasiswa/hapus_cuti').'/'.$keya->no_cuti?>">Hapus</a></td>
			</tr>
			<?php
}?>
		</tbody>
		</table>
		<a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/fcuti'?>">Tambah</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

           $('#krs').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
</script>