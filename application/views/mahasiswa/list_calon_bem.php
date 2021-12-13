<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pemilihan Ketua BEM FTI </h3>
</div >
<div class="panel-body">


<table id="test" class="table ">
<thead>
	<tr>
	
        <TH>Calon Ketua BEM</TH>
	</tr>
</thead>
<tbody>
<?php
    foreach ($list as $r) {
    ?>
	<tr>
        <input type="hidden" id="periode" value="<?php echo $r->periode?>">
         <input type="hidden" id="no_calon" value="<?php echo $r->no_calon?>">
        
       
       
        
			<td align="center"><h2>No Urut :<?php  echo $r->no_calon?> </h2><br>
			<?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= strtoupper($r->nim);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="200" height="220" ><br><?php echo $r->nim?> <br>
		<?php echo $r->nm_mahasiswa?><br><button  class="btn btn-success hadir">Pilih</button></td>
	
		
        

	

		
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

 $("#test").on('click', '.hadir', function(e) {
    var currentRow = $(this).closest("tr");
    var no_calon = currentRow.find("#no_calon").val();
    var periode = currentRow.find("#periode").val();
    var form_data = {
                                        no_calon: no_calon,
                                        periode: periode,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'mahasiswa/vote_bem'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                          
                                               alert("Tersimpan....Terimakasih sudah memilih, Anda masih bisa merubah pilihan bila belum yakin....!!!");
                                          
                                         
                                        }
                                    });
});

        $('#test').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
 </script>







                            
           