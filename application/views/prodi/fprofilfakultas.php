<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Profil Fakultas</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>Prodi/uprofil_fakultas" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <div class="form-group">
			<label for="kd_mtk" class="col-sm-2">Fakultas</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_fak" id="kd_fak" class="form-control"  >
  
<?php
	
    foreach($listfakultas as $d)
    {
    $selected = '';
    if($prodi->kd_fak==$d->kd_fak)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $d->kd_fak; ?>" <?php echo $selected; ?>><?php echo $d->nm_fak?></option>

    <?php
    }
?>

</select>

          </div>
    </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">Dekan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dekan"  value="<?php echo $fakultas->dekan ?>" name="dekan" placeholder="KETUA PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIP/NIDN Dekan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip_dekan"  value="<?php echo $fakultas->nip_dekan ?>" name="nip_dekan" placeholder="NIDN Ketua Prodi">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">Wakil Dekan I</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="wd1"  value="<?php echo $fakultas->wd1 ?>" name="wd1" placeholder="Wakil Dekan I">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIP/NIDN Wakil Dekan I</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip_wd1"  value="<?php echo $fakultas->nip_wd1 ?>" name="nip_wd1" placeholder="NIP/NIDN WD1">
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
    $('#notifications').slideDown('slow').delay(7000).slideUp('slow');
</script>