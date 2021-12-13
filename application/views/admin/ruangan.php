<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM DATA DOSEN</h3>
    </div >
    <div class="panel-body">
       <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>admin/simpan" method="post" class="form-user form-horizontal" id="fuser">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

            <div class="form-group">
                <label for="userid" class="col-sm-2">kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="userid"  name="kd_ruang"  placeholder="User ID">
                </div>
            </div>
			<div class="form-group">
                <label for="nama" class="col-sm-2">Nama Ruang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="nama" name="nm_ruang"   placeholder="Nama User">
                </div>
            </div>
			<div class="form-group">
                <label for="userid" class="col-sm-2">Kapasitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="password"  name="kap_maksimal" placeholder="Password">
                </div>
            </div>
			<div class="form-group">
                <label for="userid" class="col-sm-2">Fasilitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="repassword"  name="fasilitas" placeholder="Ulang Password">
                </div>
            </div>
					<div class="form-group">
                <label for="userid" class="col-sm-2">Gedung</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="repassword"  name="gedung" placeholder="Ulang Password">
                </div>
            </div>


            

            <button class="btn btn-primary">Simpan</button>
        </form>

    </div >
</div >


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>



<script>
    $('#notifications').slideDown('slow').delay(1200).slideUp('slow');
</script>
<script type="text/javascript">
       $(document).ready(function(){
          $("#fuser").validate();
       });
    </script>