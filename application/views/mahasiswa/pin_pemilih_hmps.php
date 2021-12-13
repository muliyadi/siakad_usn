<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>INPUT PIN PEMILIHAN ANDA</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>mahasiswa/fpilih_hmps" method="post" class="form-user form-horizontal" id="aktifta">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<div class="form-group">
    <label for="pin" class="col-sm-2">PIN</label>
   <div id="pin" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <input type="text" name="pin" id="pin" required="true" autofocus="true" class="form-control">

          </div>
    </div>
<button type="submit">Lanjut</button>
</form>
</div>
</div>