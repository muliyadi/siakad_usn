<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Daftar Mahasiswa Bimbingan Skripsi <?php echo $this->session->userdata('kd_tahun_ajaran');?>  </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-responsive">
<thead>
	<tr>
		<th>NO</th>
			<th>FOTO</th>
	
		
		<th>NIM</th>
		<th>NAMA</th>
		<th>JUDUL</th>
			<th>PEMBIMBING KE</th>
		<th>STATUS</th>
        <th>NO HP</th>
		
		<td>AKSI</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>
		<td><?php echo $start++ ?></td>
		 <td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= strtoupper($r->nim);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80" >
                    </td>
		
		<td><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->judul?></td>
		<td><?php echo $r->pembimbing_ke?></td>
		<td><?php echo $r->status?></td>
        <td><?php echo $r->no_hp?></td>
        
		<td> <a class="btn btn-info btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%2C%20bgmn%20perkembangan%20skripsinya....%3F">Chat</a>
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