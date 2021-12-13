<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Usulan Judul Skripsi</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
		 <th>No Daftar</th>
        <th>Tgl Daftar</th>

		<th>Judul</th>
		<th>Deskripsi</th>

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

		<td ><?php echo $r->no_daftar?></td>
		<td ><?php echo $r->tgl_daftar?></td>
		<td width="45%"><?php echo $r->judul?></td>
        	<td ><?php echo $r->deskripsi?></td>
        	<td ><?php echo $r->status?></td>

	 
      
		<td > 
            
             <a class="btn btn-success btn-xs" href="<?php echo base_url().'mahasiswa/list_pembimbing_skripsi/'.$r->no_daftar?>"> Pembimbing</a> 
     
		    <a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/ejudul/'.$r->no_daftar?>"> Edit</a> 
		<a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/djudul/'.$r->no_daftar?>"> Hapus</a> 
           
          
		</td>

		
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>mahasiswa/fusul_judul">Tambah</a>
</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 







                            
           