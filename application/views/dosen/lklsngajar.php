<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Kelas yang diampuh Tahun Ajaran <?php echo $this->session->userdata('kd_tahun_ajaran');?>  </h3>
</div >
<div class="panel-body">

<table id="test" class="table table-responsive">
<thead>
	<tr>
		<td>NO</th>
	    	
		<td>PRODI</th>
	
		<td>KODE JADWAL</th>
			<td>JADWAL</th>
		<td>MATAKULIAH</th>
        	

		<td>SKS</th>
			<td>SEMESTER</td>
		<td>KELAS</td>
			<td>JUMLAH PERTEMUAN</td>
	        <td>JUMLAH SKS</td>
	          <td>GROUP CHAT</td>
	<td align="center">STATUS</th>
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
	   
		<td><?php echo $r->nm_prodi?></td>
	
        <td><?php echo $r->kd_jadwal?></td>
        	<td><?php echo $r->hari.'/'.$r->jam?></td>
		<td><?php echo $r->nm_mtk?></td>
	
		<td><?php echo $r->sks?></td>
			<td><?php echo $r->semester_ke?></td>
		<td><?php echo $r->kelas?></td>
				<td><?php echo $r->jumlah_pertemuan?></td>
		<td><?php echo $r->jumlah_sks?></td>
		<td><?php if($r->group_wa)
		{
		    ?>
		    <a class="btn btn-xs btn-success" href="<?php echo $r->group_wa?>" target="_blank"> Chat Group</a>
		<?php   
		}
		?></td>
		 <td><?php echo $r->status_nilai?></td>

		<td align="left">
		    <?php
		    if($r->status_nilai=="Tertutup" )
		    {
		        ?>
		    <a class="btn btn-primary btn-xs" href="<?php echo base_url() . 'dosen/permintaan_akses_nilai/' .$r->kd_jadwal?>">Ajukan Akses</a>
		    	<a class="btn btn-info btn-xs" href="<?php echo base_url() . 'dosen/nilai_kelas/' .$r->kd_jadwal?>">Print Nilai</a>
			
		    <?php
		    }else
		    {
		        ?>
		        <a class="btn btn-success btn-xs" href="<?php echo base_url() . 'dosen/create_group_wa/' .$r->kd_jadwal?>" target="_blank">Setting Chat Group </a>
		        <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'dosen/labsen/' .$r->kd_jadwal?>" target="_blank">Absen</a>
		         <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'dosen/list_mhs_jadwal/' .$r->kd_jadwal?>" target="_blank">List Mahasiswa</a>
		         <a class="btn btn-primary btn-xs" href="<?php echo base_url() . 'dosen/list_mhs_kelas/' .$r->kd_jadwal?>">Input Nilai</a>
		         <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'dosen/nilai_kelas/' .$r->kd_jadwal?>">Print Nilai</a>
			   <!--<a class="btn btn-primary btn-xs" href="<?php echo base_url() . 'dosen/list_mhs_kelas/' .$r->kd_jadwal?>">Input Nilai</a>
		    	<a class="btn btn-info btn-xs" href="<?php echo base_url() . 'dosen/nilai_kelas/' .$r->kd_jadwal?>">Print Nilai</a>
			    <a class="btn btn-warning btn-xs" href="<?php echo base_url() . 'dosen/nilai_kelas_excel/' .$r->kd_jadwal?>">Export Excel</a>-->
			    
		    <?php
		        
		    }
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
            "info": false,
            "autoWidth": false
        });
                    </script>