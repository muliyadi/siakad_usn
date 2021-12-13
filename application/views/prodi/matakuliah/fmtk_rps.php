<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Capaian Pembelajaran</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url('prodi/amtk_rps');?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" name="aksi" value="<?php echo $aksi?>">
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">Pertemuan Ke</label>
    <div class="col-sm-10">
       
    </div>
    </div>
        <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">Capaian Pembelajaran</label>
    <div class="col-sm-10">
        
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >Materi Pembelajaran</label>
    <div class="col-md-9">
       
    </div>
    </div>
	    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >Metode Pembelajaran</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="thn_akhir" name="thn_akhir" value="<?php echo $thn_akhir?>"   placeholder="TAHUN AKHIR">
    </div>
    </div>
	<div class="form-group">
    <label for="nim" class="col-md-2" >Indikator Penilaian</label>
        <div class="col-sm-10">
        
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >Bentuk Penilaian</label>
        <div class="col-sm-10">
        
    </div>
    </div>
        <div class="form-group">
    <label for="nim" class="col-md-2" >Bobot Penilaian</label>
        <div class="col-sm-10">
        
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