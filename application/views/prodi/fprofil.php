<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Profil Prodi</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>Prodi/uprofil" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <div class="form-group">
                <label for="kd_dosen" class="col-sm-2">Kode Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kd_prodi"  value="<?php echo $prodi->kd_prodi ?>" name="kd_prodi" placeholder="KODE PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_prodi" class="col-sm-2">Nama Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nm_prodi"  value="<?php echo $prodi->nm_prodi ?>" name="nm_prodi" placeholder="NAMA PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">Ketua Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ka_prodi"  value="<?php echo $prodi->ka_prodi ?>" name="ka_prodi" placeholder="KETUA PRODI">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIDN Ketua Prodi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nidn"  value="<?php echo $prodi->nidn ?>" name="nidn" placeholder="NIDN Ketua Prodi">
                </div>
            </div>
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
                <label for="visi" class="col-sm-2">Visi</label>
                <div class="col-sm-10">
                    <textarea name="visi_misi" id="visi" class="texteditor"><?php echo $prodi->visi_misi?></textarea>
                </div>
            </div>
                            <div class="form-group">
                <label for="misi" class="col-sm-2">Misi</label>
                <div class="col-sm-10">
                    <textarea name="misi" id="misi" class="texteditor"><?php echo $prodi->misi?></textarea>
                </div>
            </div>
    

			
            <button class="btn btn-primary">Simpan</button>
        </form>

    </div >
</div >



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<!-- panggil ckeditor.js -->


<!-- setup selector -->


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