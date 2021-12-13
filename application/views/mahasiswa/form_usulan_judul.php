<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM PENGAJUAN JUDUL</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/ajudul" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" name="no_daftar" value="<?php echo $no_daftar?>">
    <input type="hidden" name="aksi" value="<?php echo $aksi?>">
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">JUDUL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" autofocus="true" id="judul"  value="<?php echo $judul?>" name="judul" placeholder="judul skripsi">
    </div>
    </div>
        <div class="form-group">
    <label for="desk" class="col-sm-2">Deskripsi Singkat Latar Belakang Masalah dan Solusi</label>
    <div class="col-sm-9">
    <textarea name="deskripsi" class="form-control">
	<?php echo $deskripsi;?>
	</textarea>   
    
	</div>
	
	   </div>
    
	
    

	
	
	
<button class="btn btn-primary">Simpan</button>
	</form>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

                <script type="text/javascript">
               
				$(function() {
                        $("#lookup2").dataTable();
                    });


                $(function() {
                        $("#tmahasiswa").dataTable();
                    });

                </script>
				<script type="text/javascript">
				$(function() {
                        $("#tgl_lahir").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});
                
                </script>
				<script>   
					$('#notifications').slideDown('slow').delay(7000).slideUp('slow');
				</script>