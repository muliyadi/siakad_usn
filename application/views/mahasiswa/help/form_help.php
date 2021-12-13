<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM ADUAN</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form   action="<?php echo base_url();?>mahasiswa/simpan_help" method="post" class="form-user form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
     <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">ISI ADUAN</label>
    <div class="col-sm-10">
        <textarea class="form-control"></textarea>
    </div>
    </div>
    <button class="btn btn-primary btn-xs">Simpan</button>
	</form>
<br>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

               