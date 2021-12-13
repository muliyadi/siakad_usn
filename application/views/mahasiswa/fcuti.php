<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM PENGAJUAN CUTI</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/acuti" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
     <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">TAHUN AKADEMIK</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" readonly id="kd_tahun_ajaran"  value="<?php echo $kd_tahun_ajaran?>" name="kd_tahun_ajaran" placeholder="judul skripsi">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-sm-2">NIM</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" readonly id="nim"  value="<?php echo $nim?>" name="nim" placeholder="judul skripsi">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-sm-2">NAMA</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" readonly  id="nm_mahasiswa"  value="<?php echo $nm_mahasiswa?>" name="nm_mahasiswa" placeholder="judul skripsi">
    </div>
    </div>
    
    <div class="form-group">
    <label for="alasan" class="col-sm-2">Alasan Cuti</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" autofocus="true" id="alasan"  value="<?php echo $alasan?>" name="alasan" placeholder="Alasan Cuti">


    
	</div>
	
	   </div>
    
	
    

	
	
	
<button class="btn btn-primary">Simpan</button>
	</form>
	<br>
Keterangan:<br>
           Dalam setiap kali cuti, hanya bisa 1 semester. Selanjutnya diperpanjang lagi jika masih akan melakukan cuti.
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