<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR RENCANA STUDI </h3>
</div >
<div class="panel-body">
    
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<table>
<tr>
<td>NIM</td><td width='20' align=center>:</td>
<td><?php echo $mhs->nim;?></td>
</tr>
<tr>
<td>NAMA MAHASISWA</td><td width='20' align=center>:</td>
<td><?php echo $mhs->nm_mahasiswa;?></td>
</tr>

<tr>
<td>PROGRAM STUDI</td><td width='20' align=center>:</td>
<td><?php echo $mhs->kd_prodi;?></td>
</tr>
</table>



		<table id="krs" class="table table-bordered">
		<thead>
		<tr>
		<td>NO KRS </td>
		<td>TGL KRS </td>
		<td>TAHUN AJARAN </td>
        <td>SEMESTER</td>
		<td>JUMLAH SKS </td>
		<td>SETUJUI PA </td>
        <td>AKSI </td>
		</tr>
		</thead>
		<tbody>
		<?php

		foreach ($krs as $keya) {
		?>
			<tr>
			<td><?php echo $keya->no_krs?></td>
			<td><?php echo $keya->tgl_krs?></td>
			<td><?php echo $keya->tahun_ajaran. '/'.$keya->semester?></td>
			<td><?php echo $keya->semester_ke?></td>
            <td><?php echo $keya->tot_sks?></td>
            <td><?php echo $keya->setujui_pa?></td>
            
        <?php
        if($keya->setujui_pa=="Ya"){
        ?>
        <td> 
           
		<a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/vkrs/'.$keya->no_krs?>">Print</a> 
			
			</td>
		<?php
        }else
        {
            ?>
            <td> 
		<a class="btn btn-info btn-xs" href="<?php echo base_url().'mahasiswa/ekrs/'.$keya->no_krs?>">Edit</a>
				<a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/lihstkrs/'.$keya->no_krs?>">Print</a>
			</td>
            
            <?php
        }?>
			</tr>
			<?php
}?>
		</tbody>
		</table>
		<a class="btn btn-primary btn-xs" href="<?php echo base_url()?>fkrs">Tambah</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

           $('#krs').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
</script>
<script>
    $('#notifications').slideDown('slow').delay(6000).slideUp('slow');
</script>