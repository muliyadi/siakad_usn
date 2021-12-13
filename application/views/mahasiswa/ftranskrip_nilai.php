<style type="text/css">
    .error{
        color: red;
    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM TRANSKRIP NILAI</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
   <form   action="<?php echo base_url().'prodi/transkrip_nilai';?>" method="post" class="form-user form-horizontal" id="fmahasiswa">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
    <div class="well"> 
    
    <hr align="center" size="1" color="#cccccc">
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
			<label for="prodi" class="col-md-2">ANGKATAN</label>
			<div class="col-md-10">
				<input readonly="true" class="form-control" type="text" size="40" autofocus="true" name="angkatan" id="angkatan" placeholder="Program Studi"  />
			</div>
			</div>
    <div class="form-group">
	<label for="negara" class="col-md-2" >Tahun Akademik Awal</label>
	<div class="col-md-3">
	<select name="ta_awal" id="ta_awal" class="ta_awal form-control " >
            <option value=''>Pilih</option>
			
    </select>
     
	</div>
    </div>
    <div class="form-group">
	<label for="negara" class="col-md-2" >Tahun Akademik Akhir</label>
	<div class="col-md-3">
	<select name="ta_akhir" id="ta_akhir" class="ta_akhir form-control " >
            <option value=''>Pilih</option>
			
    </select>
     
	</div>
    </div>
    <button class="btn btn-primary">Preview</button>

    </div>
    

        <?php echo form_close();?>
    </div>
</div >
</div >

    


<script>
    $('#notifications').slideDown('slow').delay(600).slideUp('slow');
</script>






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
        url: "<?php echo base_url().'prodi/get_ta_mahasiswa'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("angkatan").value=pesan.kd_prodi;
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kd_tahun_ajaran+'>'+data[i].kd_tahun_ajaran+'</option>';
                        
                    }
                    $('.ta_awal').html(html);
            
        $('#simpan').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#kecamatan').change(function(){
            var id=$(this).val();
        var form_data = {
        id: id,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
            $.ajax({
                url: "<?php echo base_url().'mahasiswa/get_sekolah_by_kec'?>",
                method : "POST",
                data : form_data,
                async : false,
                dataType : 'json',
                success: function(data){
                    
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].npsn+'>'+data[i].nm_sekolah+'</option>';
                        
                    }
                    $('.sekolah').html(html);
                     
                }
            });
        });
    });
</script>



