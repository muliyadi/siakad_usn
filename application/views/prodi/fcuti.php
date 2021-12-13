 <!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>CUTI MAHASISWA TAHUN AJARAN <?php echo $kd_tahun_ajaran ;?></h3>
</div >
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<form action="<?php echo base_url();?>Prodi/acuti" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden"  id="aksi" class="form-control" name="aksi" autofocus="true" value="<?php echo $aksi; ?>" />
            
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
			<label for="ukt" class="col-md-2">JUMLAH UKT</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40"  name="ukt" id="ukt" placeholder="JUMLAH UKT" readonly="true" />
			</div>
			</div>
			<div class="form-group">
			<label for="no_reg_bank" class="col-md-2">NO. SK CUTI</label>
			<div class="col-md-10"><input type="text"  id="no_reg_bank" class="form-control" name="no_reg_bank" autofocus="true" value="<?php echo $no_reg_bank; ?>" />
			</div>
			</div>
			<div class="form-group">
			<label for="tgl_reg_bank" class="col-md-2">TGL SK CUTI</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="tgl_reg_bank" id="tgl_reg_bank" placeholder="Tgl Reg Bank" value="<?php echo $tgl_reg_bank; ?>" />
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
        document.getElementById("ukt").value=pesan.nilai_ukt;
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

                        
 

                        
 