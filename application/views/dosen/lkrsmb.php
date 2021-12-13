<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>KRS Mahasiswa Bimbingan Tahun Ajaran <?php echo $this->session->userdata('kd_tahun_ajaran');?> </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-responsive">
<thead>
	<tr>
		<th>TA</th>
		<th>NO KRS</th>
		<th>TGL KRS</th>
		<th>NIM</th>
		<td>NAMA</td>
		<td>ANGKATAN</td>
		<td>NO HP</td>
		<td>PRODI</td>
		<td>STATUS KRS</td>
		<td>AKSI</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
		<td><?php echo $r->kd_tahun_ajaran?></td>
		<td><?php echo $r->no_krs?></td>
		<td><?php echo $r->tgl_krs?></td>
		<td><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->angkatan?></td>
		<td><?php echo $r->no_hp?></td>
		
		<td><?php echo $r->kd_prodi?></td>
		<td><?php echo $r->setujui_pa?></td> 
		<td>
		     <a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum....!!!%20Sy%20perhatihan%20KRS%20Anda%20belum%20disetujui....Tolong%20segera%20menghadap%20ke%20Dosen%20PAnya%20masing-masing.%20Terimakasih">Chat WA</a>
			<?php 
			 
				echo anchor(site_url('dosen/transkrip_nilai/'.$r->nim),'<i class="btn btn-info fa fa-eye"> Transkrip Nilai</i>',array('title'=>'Transkrip Nilai'));
            
			echo anchor(site_url('dosen/batal_setujui_krsmb/'.$r->no_krs),'<i class="btn btn-primary fa  fa-pencil-square-o"> Batal</i>',array('title'=>'Batal')); 
            
			echo anchor(site_url('dosen/ekrs/'.$r->no_krs),'<i class="btn btn-info fa fa-eye"> Detail</i>',array('title'=>'Detail KRS'));
			
			
			?>
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
            "info": true,
            "autoWidth": true
        });
                    </script>