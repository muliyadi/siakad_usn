<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Form Prodi</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>bak/aprodi" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            			<div class="form-group">
			<label for="kd_mtk" class="col-sm-2">Fakultas</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_fak" id="kd_fak" class="form-control"  >
  
<?php
	
    foreach($listfakultas as $d)
    {
    $selected = '';
    if($kd_fak==$d->kd_fak)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $d->kd_fak; ?>" <?php echo $selected; ?>><?php echo $d->nm_fak?></option>

    <?php
    }
?>
<option></option>
</select>

          </div>
    </div>
            <div class="form-group">
                <label for="kd_dosen" class="col-sm-2">Kode Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kd_prodi"  value="<?php echo $kd_prodi ?>" name="kd_prodi" placeholder="KODE PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_prodi" class="col-sm-2">Nama Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nm_prodi"  value="<?php echo $nm_prodi ?>" name="nm_prodi" placeholder="NAMA PRODI">
                </div>
            </div>
             <div class="form-group">
                <label for="nm_prodi" class="col-sm-2">Singkatan Nama Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="singkatan"  value="<?php echo $singkatan ?>" name="singkatan" placeholder="NAMA PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">Ketua Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ka_prodi"  value="<?php echo $ka_prodi ?>" name="ka_prodi" placeholder="KETUA PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIDN Ka. Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nidn"  value="<?php echo $nidn ?>" name="nidn" placeholder="NIDN KA.PRODI">
                </div>
            </div>
<div class="form-group">
                <label for="ka_prodi" class="col-sm-2">KODE PDDIKTI</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kd_prodi_forlap"  value="<?php echo $kd_prodi_forlap ?>" name="kd_prodi_forlap" placeholder="KODE PRODI PDDIKTI">
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