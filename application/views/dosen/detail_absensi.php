<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DETAIL ABSENSI </h3>
</div >
<div class="panel-body">



<table id="test" class="table ">
<thead>
	<tr>
		<th>NO</th>
        <th>FOTO</th>
		<th>NAMA MAHASISWA</th>
		<th>ANGKATAN</th>
		<th>NO HP</th>
		<th>STATUS</th>
		<th>AKSI</th>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list_absensi as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
        <td align="center"><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= $r->nim;
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80" "><br>
                    NIM:<?php echo $r->nim?>
                    </td>
		
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
			<td><a class="btn btn-success btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%21"><?php echo $r->no_hp?></a>

		</td>

        	<td><?php echo $r->status?></td>

            <td><a class="btn btn-warning btn-xs" href="<?php echo base_url('dosen/tolak_absen').'/'.$r->id_absen.'/'.$r->nim?>">Tolak</a></td>
        
	

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>

</div>

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







                            
           