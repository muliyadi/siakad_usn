<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR HASIL STUDI</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="krs" class="table table-bordered">
		<thead>
			<tr>
			<td>TAHUN AJARAN </td>
				<td>SEMESTER</td>
				<td>TOTAL SKS TELAH DIPROGRAM</td>
				<td>IPS Sebelumnya</td>
				<td>MAKS SKS YANG DAPAT DIPROGRAM</td>
				<td>AKSI </td>
			</tr>
		</thead>
		<tbody>
		<?php

		foreach ($listta as $keya) {
		?>
			<tr>
			<td><?php echo $keya->kd_tahun_ajaran?></td>
			<td><?php echo $keya->semester_ke?></td>
			<td><?php echo $keya->tot_sks?></td>
			<td><?php echo $keya->ips_sebelumnya?></td>
			<td><?php echo $keya->maks_sks?></td>
			<td>
				<a href="<?php echo base_url().'mahasiswa/khs/'.$keya->no_krs?>">Print KHS</a>
			</td>
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
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
</script>