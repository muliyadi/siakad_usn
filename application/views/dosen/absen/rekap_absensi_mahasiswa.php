<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>REKAP ABSENSI MAHASISWA

</div >
<div class="panel-body table-responsive">
  
    
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="tabel" class="table  table-responsive">
		<thead>
			<tr>
			    <td>NO</td>
			<td>NIM</td>
				<td>NAMA MAHASISWA</td>
				<td>ANGKATAN</td>
				<td>STATUS</td>
			    <td>JUMLAH</td>
			</tr>
		</thead>
		<tbody>
		<?php
        if($list)
        {
            $no=1;
            
        //$nim=$this->session->userdata('userid');
		foreach ($list as $row) {
    
		?>
			<tr>
		    <td><?php echo $no++?></td>
			<td ><?php echo $row->nim;?></td>
		    	<td ><?php echo $row->nm_mahasiswa;?></td>
		    		<td ><?php echo $row->angkatan;?></td>
		    			<td ><?php echo $row->status;?></td>
		    				<td ><?php echo $row->jumlah;?></td>
	
			</tr>
			<?php
		}
}?>
		</tbody>
		</table>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

           $('#tabel').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
</script>




