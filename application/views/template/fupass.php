<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM EDIT AKUN</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Bismillah/updateUser" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
     <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NAMA AKUN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nama" autofocus="true"  value="<?php echo $nama?>" name="nama" placeholder="Input nama akun anda ">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">EMAIL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email"  value="<?php echo $email?>" autofocus="true" name="email" placeholder="Input email yang aktif">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">PASSWORD LAMA</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="passlama" autofocus="true"  value="<?php echo $passlama?>" name="passlama" placeholder="Input password lama">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">PASSWORD BARU</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="passbaru" autofocus="true"  value="<?php echo $passbaru?>" name="passbaru" placeholder="Input password baru">
    </div>
    </div>
    
        
    <button id="simpan" class="btn btn-primary">Simpan</button>

</form>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>

 <script type="text/javascript">

           $('#krs').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
</script>