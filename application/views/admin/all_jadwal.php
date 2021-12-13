<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR JADWAL MATAKULIAH</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
<thead>
	<tr>
	    
	    <th>
			PROGRAM STUDI
		</th>
		<th>
			TAHUN AKADEMIK
		</th>
		
	    <td>
			KODE JADWAL 
		</td>
		<td>
			MATAKULIAH 
		</td>
		<td>
			SEMESTER / SKS
		</td>
		<td>
			KELAS
		</td>
			<td>
			DOSEN PENGAMPU
		</td>
		<td>
			HARI / JAM /RUANG KULIAH
		</td>

		<td>
			KAPASITAS | TERISI
		</td>
		<td>TERSISA</td>
	
	
		<td>
			STATUS
		</td>
	</tr>
</thead>
<tbody>
<?php
	$start = 0;
    foreach ($data as $r) {
    ?>
	<tr>
	     <input type="hidden" id="kd_jadwal" value="<?php echo $r->kd_jadwal?>">
	   
	    	<td>
			<?php echo $r->nm_prodi?>
		</td>
	    <td><?php echo $r->kd_tahun_ajaran?>
		</td>
	    

		<td><?php echo $r->kd_jadwal?>
		</td>
		<td>
			<?php echo $r->nm_mtk.'/'.$r->kd_mtk?>
		</td>
		<td>
			 <?php echo $r->semester_ke.' / '. $r->sks?>
		</td>
		<td>
			<?php echo $r->kelas?>
		</td>
		<td>
			<?php echo $r->nm_dosen.'/'.$r->kd_dosen?>
		</td>
		<td>
			<?php echo $r->hari.'/'.$r->jam.'/'.$r->kd_ruang?>
		</td>

		<td>
			<?php echo $r->kapasitas?><?php echo ' |';?> <?php echo $r->terisi;?>
		</td>
		<td><?php echo $r->kapasitas-$r->terisi?></td>
	
				
		<td>
           
            <select name="status" id="status" class="form-control update"   >

			<?php
	
			foreach($lstatus as $status)
			{
    $selected = '';
    if($r->status==$status->status)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $status->status; ?>" <?php echo $selected; ?>><?php echo $status->status?></option>

    <?php
    }
?>

</select>
        </td>
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary" href="<?php echo base_url()?>prodi/fjm">Tambah</a>
</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">
$("#test").on('change', '.update', function(e) {
var currentRow = $(this).closest("tr");
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
  
    var status = currentRow.find("#status").val();

      var form_data = {
                                        
                                        kd_jadwal: kd_jadwal,
                                        status: status,
                                      
                                        
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'bak/buka_jadwal'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Update");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});
                         $('#test').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
                    </script>