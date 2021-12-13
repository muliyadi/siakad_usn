<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM SINKRON KEUANGAN</h3>
    </div >
    <div class="panel-body">
       <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>bak/sinkron_pembayaran" method="post" class="form-user form-horizontal" id="fuser">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
           <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Tahun Akademik</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="ta" id="ta" class="form-control"  >
  
<?php
	
    foreach($list as $d)
    {

    ?>

    <option value="<?php echo $d->kd_tahun_ajaran; ?>" ><?php echo $d->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select>

          </div>
    </div>
			
            

            <button class="btn btn-primary">Sinkron</button>
        </form>

    </div >
</div >


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>



<script>
    $('#notifications').slideDown('slow').delay(1200).slideUp('slow');
</script>
