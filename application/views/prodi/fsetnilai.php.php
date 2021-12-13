<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>MATAKULIAH</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <br>
        <form   action="<?php echo base_url(); ?>Prodi/asetnilai" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <input type="hidden" name="aksi" value="<?php echo $aksi ?>"/>
            <div class="form-group">
                <label for="kd_mtk" class="col-sm-2">KODE KURIKULUM</label>
                <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
                    <select name="kd_kurikulum" id="kd_kurikulum" class="form-control"  >

                        <?php
                        foreach ($listkurikulum as $d) {
                            $selected = '';
                            if ($kd_kurikulum == $d->kd_kurikulum) {
                                $selected = 'selected="selected"';
                            }
                            ?>

                            <option value="<?php echo $d->kd_kurikulum; ?>" <?php echo $selected; ?>><?php echo $d->nm_kurikulum ?></option>

    <?php
}
?>
                        <option></option>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="nhuruf" class="col-sm-2">Nilai Huruf</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nhuruf"  value="<?php echo $nhuruf ?>" name="nhuruf" placeholder="KODE MATAKULIAH">
                </div>
            </div>
            <div class="form-group">
                <label for="nangka" class="col-sm-2">Nilai Angka</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nangka" value="<?php echo $nangka ?>" name="nangka" placeholder="NAMA MATAKULIAH">
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
            format: "yyyy-mm-dd",
            todayHightLight: true,
            todayBtn: true
        })
    });

</script>
<script>
    $('#notifications').slideDown('slow').delay(30000).slideUp('slow');
</script>