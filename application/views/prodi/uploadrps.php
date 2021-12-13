<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Upload RPS</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <?php echo form_open_multipart('prodi/uploadrps'); ?>
        <div class="form-group">
            <label for="pesan" class="col-sm-2">KODE MATAKULIAH</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly="true" name="kd_mtk" value="<?php echo $kd_mtk ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="pesan" class="col-sm-2">CARI FILE</label>
            <div class="col-sm-10">
                <input type="file" name="userfile" class="form-control">
            </div>
        </div>

        <input type="submit" name="upload" value="Upload" class="btn btn-primary">
        <?php echo form_close(); ?>
    </div >
</div >


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>



<script>
    $('#notifications').slideDown('slow').delay(1200).slideUp('slow');
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#fuploadrps").validate();
    });
</script>