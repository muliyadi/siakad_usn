<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Verifikasi Email</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Bismillah/registrasi_akun" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">USER ID</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="userid" readonly required value="<?php echo $userid?>" name="userid" placeholder="USER ID">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NAMA AKUN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nama"  readonly value="<?php echo $nama?>" name="nama" placeholder="NAMA USER">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">EMAIL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email" required  value="<?php echo $email?>" name="email" placeholder="INPUT EMAIL ANDA YANG VALID DAN AKTIF">
    </div>
    </div>
    <button id="simpan" class="btn btn-primary">Simpan</button>

</form>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
