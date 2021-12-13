<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Ujian Mahasiswa</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th width="2%">No</th>
		 <th width="8%">No Daftar</th>
        <th width="5%">Tgl Daftar</th>
        <th width="8%" >Jenis Ujian</th>
		<th>Judul</th>
        <th>Jadwal Ujian</th>
         <th>Status</th>
		<th width="10%">Naskah</th>
		<td>Aksi</td>
			<td>Print</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 1;
	if($list)
	{
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
		<td ><?php echo $r->no_daftar?></td>
		<td ><?php echo $r->tgl_daftar?></td>
        <td ><?php echo $r->jenis_ujian?></td>
		<td><?php echo $r->judul?></td>
		  <td><?php echo date('l', strtotime($r->tgl_ujian)).','.$r->tgl_ujian.'/ '.$r->jam?></td>
		  <td><?php echo $r->status?></td>
<td><a class="btn btn-info btn-xs" href=<?php echo base_url('doc/naskah').'/'.$r->link_draft?>>Unduh</a></td>
	
        </td>
		<td width="10%">
            <a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/list_penguji/'.$r->no_daftar?>"> Penguji</a> 
            		     
		      <a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/edit_ujian/'.$r->no_daftar?>"> Edit</a> 
		       <a class="btn btn-warning btn-xs" href="<?php echo base_url().'mahasiswa/delete_ujian/'.$r->no_daftar?>"> Delete</a> 
		</td>
	    <td>
	        <a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/berita_acara_ujian/'.$r->no_daftar?>"> Berita Acara</a>
		     <a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/form_nilai/'.$r->no_daftar?>"> Form Nilai</a> 
		     <a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/lembar_koreksi/'.$r->no_daftar?>"> Lembar Koreksi</a>
		    
	    </td>

		
	</tr>
	<?php
                            }
	}
                            ?>
</tbody>
</table>
 <a class="btn btn-primary btn-small"  href="<?php echo base_url()?>mahasiswa/daftar_ujian">Daftar</a>
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







                            
           