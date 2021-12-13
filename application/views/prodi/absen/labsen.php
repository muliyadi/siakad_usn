<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR ABSENSI KULIAH
<br> <?php echo $matakuliah->nm_mtk?> Kelas <?php echo $matakuliah->kelas?></h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="krs" class="table table-bordered">
		<thead>
			<tr>
				<td>PERTEMUAN KE</td>
				<td>TGL PERTEMUAN</td>
				<td>DURASI ABSEN</td>
				<td>MATERI/SUB MATERI KULIAH</td>
			    <td>HADIR</td>
			    <td>IZIN</td>
			    <td>SAKIT</td>
			    <td>ALPA</td>
			    <td>TOTAL</td>
			    <td>AKTIF</td>
				<td>AKSI </td>
			</tr>
		</thead>
		<tbody>
		<?php
        if($list_absen)
        {
            
        
		foreach ($list_absen as $row) {

		?>
			<tr>
			<td><?php echo $row->pertemuan_ke?></td>
			<td><?php echo $row->tgl_pertemuan?></td>
			<td><?php echo $row->durasi_absen?></td>
			<td><?php echo $row->materi?></td>
			<td><?php echo $row->h?></td>
			<td><?php echo $row->i?></td>
			<td><?php echo $row->s?></td>
			<td><?php echo $row->a?></td>
			<td><?php echo $row->h+$row->i+$row->s+$row->a?></td>
			<td><?php echo $row->aktif?></td>
			<td>
			    <a href="<?php echo base_url().'prodi/tutup_absensi/'.$row->id_absen.'/'.$row->kd_jadwal?>" class="btn btn-warning btn-xs">Tutup</a>
				<a href="<?php echo base_url().'prodi/detail_absensi/'.$row->id_absen?>" class="btn btn-info btn-xs">Detail</a>
				
				<a href="<?php echo base_url().'prodi/dabsensi/'.$row->id_absen?>" class="btn btn-danger btn-xs">Hapus</a>
			</td>
			</tr>
			<?php
		}
}?>
		</tbody>
		</table>
	<a href="<?php echo base_url().'prodi/cpertemuan'.'/'.$kd_jadwal?>" class="btn btn-danger btn-sm">Tambah</a>
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