 <!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM PENDAFTARAN YUDISIUM TAHUN AKADEMIK <?php echo $ta?></h3>
</div >
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 

<form action="<?php echo base_url();?>Prodi/ayudisium" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden"  id="aksi" class="form-control" name="aksi" autofocus="true" value="<?php echo $aksi; ?>" />
            
			<div class="form-group">
			<label for="nim" class="col-sm-2">NIM</label>
			<div class="col-md-9">
			<input type="text" class="form-control" autofocus="true"  name="nim" id="nim" placeholder="NIM" /></div>
			<div  class="col-sm-1"><input id="cek" type="button" class="btn btn-primary " value="Cari"/></div>
			</div>
			<div class="form-group">
			<label for="nm_mahasiswa" class="col-md-2">NAMA MAHASISWA (*Sesuai Ijazah)</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40" autofocus="true" name="nm_mahasiswa" id="nm_mahasiswa" placeholder="nm_mahasiswa"  />
			</div>
			</div>
			<div class="form-group">
			<label for="ukt" class="col-md-2">ANGKATAN</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40"  name="angkatan" id="angkatan" placeholder="ANGKATAN" />
			</div>
			</div>
			<div class="form-group">
			<label for="judul" class="col-md-2">JUDUL PENELITIAN</label>
			<div class="col-md-9">
				<input  class="form-control" type="text" size="40" autofocus="true" name="judul" id="judul" placeholder="JUDUL PENELITIAN"  />
			</div>
			
			</div>
			<div class="form-group">
			<label for="judul" class="col-md-2">TGL UJIAN</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40" autofocus="true" name="tgl_ujian" id="tgl_ujian" placeholder="TGL UJIAN"  />
			</div>
			</div>
			<div class="form-group">
			<label for="nilai" class="col-md-2">NILAI</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40" autofocus="true" name="nilai" id="nilai" placeholder="NILAI"  />
			</div>
			</div>
			<div class="form-group">
			<label for="ipk" class="col-md-2">IPK</label>
			<div class="col-md-10">
				<input  class="form-control" type="text" size="40" autofocus="true" name="ipk" id="ipk" placeholder="IPK"  />
			</div>
			</div>
			
			
			<div class="form-group">
			<label for="ipk" class="col-md-2">Status</label>
			<div class="col-md-10">
				<select name="status" id="status" class="form-control">
				    <option values="Diterima">Diterima</option>
				    <option values="Ditolak">Ditolak</option>
				    
				</select>
			</div>
			</div>
				<div class="form-group">
			<label for="ket" class="col-md-2">Keterangan</label>
			<div class="col-md-10">
			 <textarea rows="10" cols="1" id="ket" name="ket" class="form-control"></textarea>
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
        document.getElementById("nim").value=pesan.nim;
        document.getElementById("angkatan").value=pesan.angkatan;
        
      
        $('#no_reg_bank').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        document.getElementById("angkatan").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

</script>
<script type="text/javascript">
$("#judul").on('click',function() 
{
var nimx=document.getElementById("nim").value;
      var form_data = {
        nim: nimx,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
    $.ajax({
        url: "<?php echo base_url().'prodi/get_skripsi'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("judul").value=pesan.judul;
        document.getElementById("nilai").value=pesan.nilai;
        document.getElementById("tgl_ujian").value=pesan.tgl_ujian;
        $('#ipk').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("judul").value='';
        document.getElementById("nilai").value='';
         document.getElementById("tgl_ujian").value='';
         $('#nim').focus();
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

</script>
<script>   
    $('#notifications').slideDown('slow').delay(5000).slideUp('slow');
</script>

                        
 

                        
 