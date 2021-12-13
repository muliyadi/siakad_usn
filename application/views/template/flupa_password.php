<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM RESET PASSWORD</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Bismillah/reset" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">EMAIL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email"   name="email" placeholder="ALAMAT EMAIL">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">PASSWORD</label>
    <div class="col-sm-9">
        <input type="password" class="form-control" id="password"  value="<?php echo $passbaru?>" name="password" placeholder="PASSWORD BARU">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">KETIK ULANG PASSWORD</label>
    <div class="col-sm-9">
        <input type="password" class="form-control" id="password2"  name="password2" placeholder="KETIK ULANG PASSWORD DIATAS">
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