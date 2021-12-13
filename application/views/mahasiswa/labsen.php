<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>ABSENSI KULIAH

</div >
<div class="panel-body table-responsive">
  
    
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
		<table id="labsen" class="table  table-responsive">
		<thead>
			<tr>
			<td>MINGGU KE</td>
				<td>TGL PERTEMUAN</td>
				<td>DURASI ABSEN</td>
				<td>DOSEN PENGAMPU</td>
			    <td>MATAKULIAH</td>
			    <td>KELAS</td>
				<td>MATERI/SUB MATERI KULIAH</td>
				<td>STATUS ABSENSI</td>
				<td>AKSI </td>
			</tr>
		</thead>
		<tbody>
		<?php
        if($list)
        {
            
        //$nim=$this->session->userdata('userid');
		foreach ($list as $row) {
    
		?>
			<tr>
		
			<td ><?php echo $row['pertemuan_ke']?></td>
			<td><?php echo $row['tgl_pertemuan']?></td>
			<td><?php echo $row['durasi_absen'].' Menit'?></td>
			<td><?php echo $row['dosen']?></td>
			<td><?php echo $row['nm_mtk']?></td>
			<td><?php echo $row['kelas']?></td>
			<td><?php echo $row['materi']?></td>
			<TD><?php
	
		                   
						   $list=array();
						   
						   foreach($absenstatuss as $value)
						   {
							   $test=$value->status;
							   $list[$value->kode]=$test;
							  
						   }
		                    echo form_dropdown('status',$list,'',"class='form-control status'");    
		                    ?></TD>
				<td width="200"><label>	

			<button id="cmdabsen" class="btn btn-info cmdabsen">Absen</button>
		
			    <input type="hidden" id="id_absen" value="<?php echo $row['id_absen']?>"> <input type="hidden" id="link_kelas" value="<?php echo $row['link_kelas']?>"></label></td>
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

           $('#krs').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
</script>



<script type="text/javascript">
$("#labsen").on('click', '#cmdabsen', function(e) {
    
var currentRow = $(this).closest("tr");
    var id_absen = currentRow.find("#id_absen").val();
   var status = currentRow.find(".status").val();
      var link = currentRow.find("#link_kelas").val();

      var form_data = {
                                        id_absen: id_absen, status: status,
                                      <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'mahasiswa/ajax_save_absen'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                           alert(pesan);
                                        window.location.href =link;
                                         
                                        }
                                    });

    
});
        </script>
        
        <script type="text/javascript">
$("#labsen").on('click', '.tutup', function(e) {
    
var currentRow = $(this).closest("tr");
    var id_absen = currentRow.find("#id_absen").val();
   var status = currentRow.find(".status").val();
    

      var form_data = {
                                        id_absen: id_absen, status: status,
                                      <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'bismillah/logout'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function() {
                                          
                                    
                                         
                                        }
                                    });

    
});
        </script>

<script>
// Set a valid end date
var countDownDate = new Date("Feb 28, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the countdown date
  var distance = countDownDate - now;

  // Calculate Remaining Time
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the countdown is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>