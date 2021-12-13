 <!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>REGISTRASI PEMILIHAN HMPS DAN BEM</h3>
</div >
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<form action="<?php echo base_url();?>Prodi/areg_pemilih_hmps" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
  
		
			<div class="form-group">
			<label for="nim" class="col-sm-2">NIM</label>
			<div class="col-md-9">
			<input type="text" class="form-control" autofocus="true"  name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" /></div>
			<div  class="col-sm-1"><input id="cek" type="button" class="btn btn-primary " value="Cari"/></div>
			</div>
			<div class="form-group">
			<label for="nm_mahasiswa" class="col-md-2">NAMA MAHASISWA</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40" autofocus="true" name="nm_mahasiswa" id="nm_mahasiswa" placeholder="nm_mahasiswa"  />
			</div>
			</div>
			<div class="form-group">
			<label for="prodi" class="col-md-2">PROGRAM STUDI</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40" autofocus="true" name="prodi" id="prodi" placeholder="Program Studi"  />
			</div>
			</div>
			<div class="form-group">
			<label for="ukt" class="col-md-2">ANGKATAN</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40"  name="angkatan" id="angkatan" placeholder="JUMLAH UKT" readonly="true" />
			</div>
			</div>
			
			<button type="submit" id="simpan" class="btn btn-primary">Simpan</button> 
	
          

</form>
</div >
</div >

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">
$("#cek").on('click',function() 
{
var nimx=document.getElementById("nim").value;
      var form_data = {
        nim: nimx,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
    $.ajax({
        url: "<?php echo base_url().'prodi/get_mahasiswax'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("prodi").value=pesan.kd_prodi;
        document.getElementById("angkatan").value=pesan.angkatan;
        $('#no_reg_bank').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

  $(function() {
                        $("#tgl_reg_bank").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});


</script>
<script>   
    $('#notifications').slideDown('slow').delay(5000).slideUp('slow');
</script>

                        
 

                        
 