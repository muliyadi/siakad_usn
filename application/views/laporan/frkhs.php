<style type="text/css">
    .error{
        color: red;
    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>PRINT KARTU HASIL STUDI MHASISWA</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
   <form   action="<?php echo base_url().'laporan/rkhs';?>" method="post" class="form-user form-horizontal" id="fmahasiswa">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
    <div class="well"> 
    
    <hr align="center" size="1" color="#cccccc">
    <div class="form-group">
			<label for="nim" class="col-sm-2">NIM</label>
			<div class="col-md-9">
			<input type="text" class="form-control" autofocus="true"  name="nim" id="nim" placeholder="Nim" /></div>
			<div  class="col-sm-1"><input id="cek" type="button" class="btn btn-primary " value="Cari"/></div>
			</div>
			
    <div class="form-group">
	<label for="negara" class="col-md-2" >Tahun Akademik</label>
	<div class="col-md-9">
	<select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="kd_tahun_ajaran form-control " >
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
        success: function(data) {
        if(data)
        {
       
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kd_tahun_ajaran+'>'+data[i].kd_tahun_ajaran+'</option>';
                        
                    }
                    $('.kd_tahun_ajaran').html(html);
            
       
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

</script>





