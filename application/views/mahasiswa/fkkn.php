<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM PENDAFTARAN KULIAH KERJA NYATA (KKN)</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/akkn" method="post" class="form-user form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
     <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">TAHUN AKADEMIK</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" readonly id="kd_tahun_ajaran"  value="<?php echo $kd_tahun_ajaran?>" name="kd_tahun_ajaran" placeholder="Tahun Akademik">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-sm-2">NIM</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" readonly id="nim"  value="<?php echo $nim?>" name="nim" placeholder="NIM">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-sm-2">NAMA</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" readonly  id="nm_mahasiswa"  value="<?php echo $nm_mahasiswa?>" name="nm_mahasiswa" placeholder="Nama Mahasiswa">
    </div>
    </div>
    
    <div class="form-group">
    <label for="alasan" class="col-sm-2">Jumlah SKS</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" autofocus="true" readonly id="alasan"  value="<?php echo $jum_sks?>" name="jum_sks" placeholder="Jumlah SKS">


    
	</div>
	
	   </div>
            <div class="form-group">
            <label for="pesan" class="col-sm-2">TRANSKRIP NILAI (*.PDF)</label>
            <div class="col-sm-10">
                <input type="file" id="userfile" name="userfile"  class="form-control">
            </div>
           
        </div>
	
    

	
	
	
<button class="btn btn-primary">Daftar</button>
	</form>
<br>
<h4>Keterangan: "Jumlah SKS yang dihitung hanya SKS Matakuliah dengan nilai Lulus"</h4>
</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

                <script type="text/javascript">
               
			

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