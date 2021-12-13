<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR UJIAN </h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/update_ujian"  method="post" enctype="multipart/form-data" class="form-user form-horizontal">
   
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jenis Pendaftaran</label>
   <div id="combox" class="col-sm-8"> <!-- sebagai indentitas combo box -->
   <select name="jenis_ujian" id="jenis_ujian" class="form-control"  >
  
<?php
	
			foreach($listjnsujian as $jns_ujian)
			{
    $selected = '';
    if($jns_ujian->urutan==$urutan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jns_ujian->urutan; ?>" <?php echo $selected; ?>><?php echo $jns_ujian->jenis_ujian?></option>

    <?php
    }
?>

</select>

          </div>
          		



    </div>
    
        <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">No Daftar Ujian</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="no_daftar"  name="no_daftar" placeholder="No Daftar Ujian" value="<?php echo $no_daftar?>" >
    
    </div>
    
    </div>
     <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">Tgl Daftar Ujian</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="tgl_daftar"  name="tgl_daftar" placeholder="Tgl Daftar Ujian" value="<?php echo $tgl_daftar?>" >
    
    </div>
    
    </div>
      
    

    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">No Daftar Judul</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="no_daftar_judul"  name="no_daftar_judul" placeholder="no_daftar_judul" value="<?php echo $no_daftar_judul?>" >
    
    </div>
    
    </div>
        

    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">Judul</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="judul" value="<?php echo $judul?>"  name="judul" placeholder="judul">
    
    </div>
    
    </div>

    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">Upload Ulang Naskah<br>Size<=2MB</label>
    <div class="col-sm-3">
        <input type="file" class="form-control" autofocus="true"  name="link_draft" >
    </div>
    <div class="col-sm-6">
        <input type="text" class="form-control" autofocus="true"  name="link" value="<?php echo $link?>" >
    </div>
    </div>

    
	
    

	
	
	
<button class="btn btn-primary" name='upload'  id="upload">Simpan</button>
	</form>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

                
				<script>   
					$('#notifications').slideDown('slow').delay(7000).slideUp('slow');
				</script>

                <script type="text/javascript">
$("#ok").on('click',function() 
{

var urutanx=document.getElementById("jenis_ujian").value;

      var form_data = {
        urutan: urutanx,
        
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
    $.ajax({
        url: "<?php echo base_url().'mahasiswa/get_last_data'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
          
        if(pesan)
        {
        document.getElementById("no_reff").value=pesan.no_daftar;
        document.getElementById("judul").value=pesan.judul;
       $('#simpan').removeAttr("disabled", "disabled");
        
        }else{
        alert('Belum dapat mendaftar...!, Judul Penelitian/Ujian sebelumnya belum diterima...!!!');
        document.getElementById("judul").value='';
         document.getElementById("no_reff").value='';
          $('#simpan').attr("disabled", "disabled");
    }
        
         
        }
    });
});
</script>