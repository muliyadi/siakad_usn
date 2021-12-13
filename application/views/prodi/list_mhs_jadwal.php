<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR MAHASISWA KELAS  </h3>
</div >
<div class="panel-body">


<BR>

<table id="test" class="table ">
<thead>
	<tr>
		<th>NO</th>
		<th>FOTO</th>
       <th>MAHASISWA</th>
		<th>ANGKATAN</th>
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
                    <img src="<?php echo $foto?>" width="40" height="60" ">
             </td>
	
		<td><?php echo $r->nm_mahasiswa.'/'.$r->nim?></td>
		<td><?php echo $r->angkatan?></td>
        <td><?php echo $r->no_hp?></td>
		<td><a href="<?php echo base_url().'prodi/fpindah_kelas/'.$r->nim.'/'.$r->kd_jadwal?>"class="btn btn-info btn-xs" >Pindah Kelas</a>
		
		</td>

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>
<button id="tutup" class="btn btn-primary tutup">Tutup Kelas</button>
<br>
</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
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







                            
           