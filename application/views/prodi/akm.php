 <!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM AKTIVITAS KULIAH MAHASISWA <?php echo $kd_tahun_ajaran ;?></h3>
</div >
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<form id="reg" action="<?php echo base_url();?>Prodi/aakm" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
            <div class="form-group">
			<label for="no_reg_bank" class="col-md-2">TAHUN AJARAN</label>
			<div class="col-md-10"><input type="text"  id="kd_tahun_ajaran" class="form-control" placeholder="Contoh:20151 atau 20152" name="kd_tahun_ajaran" autofocus="true" value="<?php echo $kd_tahun_ajaran; ?>" />
			</div>
			</div>
			
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
			<label for="tgl_reg_bank" class="col-md-2">IPK</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="ipk" id="ipk" placeholder="Contoh: 3.05" value="<?php echo $ipk; ?>" />
			</div>
			</div>
			<div class="form-group">
			<label for="ukt" class="col-md-2">IPS</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40"  name="ips" id="ips" placeholder="Contoh: 3.05"  />
			</div>
			</div>
			<div class="form-group">
			<label for="ukt" class="col-md-2">SKS SEMESTER</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40"  name="sks_semester" id="sks_semester" placeholder="JUMLAH SKS SEMESTER" />
			</div>
			</div>
			<div class="form-group">
			<label for="ukt" class="col-md-2">SKS TOTAL</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40"  name="sks_total" id="sks_total" placeholder="TOTAL SKS"  />
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
        url: "<?php echo base_url().'bak/get_mahasiswa'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("prodi").value=pesan.kd_prodi;
        document.getElementById("ukt").value=pesan.nilai_ukt;
        $('#simpan').focus();
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
    $('#notifications').slideDown('slow').delay(2000).slideUp('slow');
</script>

                        
 

                        
 