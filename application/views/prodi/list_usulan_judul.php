<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Usulan Judul Skripsi Mahasiswa</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
		 <th>No Daftar</th>
        <th>Tgl Daftar</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Angkatan</th>
		<th>Judul</th>
		<th>Pembimbing</th>
		<th>Status</th>
	
		<td>Aksi</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>

		<td ><?php echo $r['no_daftar']?></td>
		<td ><?php echo $r['tgl_daftar']?></td>
		<td><?php echo $r['nim']?></td>
        	<td><?php echo $r['nm_mahasiswa']?></td>
        		<td><?php echo $r['angkatan']?></td>
		<td width="45%"><?php echo $r['judul']?></td>




          	<td><?php echo $r['pembimbing']?></td>

        <td><?php echo $r['status']?></td>
		<td ><a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/edit_usulan_judul/'.$r['no_daftar']?>"> Edit</a> <a class="btn btn-primary btn-xs" href="<?php echo base_url().'prodi/hapus_usulan/'.$r['no_daftar']?>"> Hapus</a> 
           
          <a class="btn btn-success btn-xs" href="<?php echo base_url().'prodi/usulan_judul_lulus/'.$r['no_daftar']?>"> Lulus</a>
		</td>

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>prodi/fdaftar_judul">Tambah</a>
</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
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







                            
           