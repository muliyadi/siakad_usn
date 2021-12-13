<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>PESAN</h3>
    </div >
    <div class="panel-body">
       <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>prodi/apesan" method="post" class="form-user form-horizontal" id="fuser">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
           
            <input type="hidden" value="<?php echo $aksi ?>" name="aksi">
            <div class="form-group">
                <label for="pesan" class="col-sm-2">PESAN SINGKAT</label>
                <div class="col-sm-10">
                    <textarea name='pesan'  class="form-control">
                        <?php echo $pesan ?>
                    </textarea>
                    
                </div>
            </div>

            <button class="btn btn-primary">Kirim</button>
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