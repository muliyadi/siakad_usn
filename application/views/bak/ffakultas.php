<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Form Fakultas</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   action="<?php echo base_url(); ?>bak/ufakultas" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            		
            <div class="form-group">
                <label for="kd_dosen" class="col-sm-2">Kode Fakultas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kd_fak"  value="<?php echo $kd_fak ?>" name="kd_fak" autofocus=true placeholder="KODE FAKULTAS">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_prodi" class="col-sm-2">Nama Fakultas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nm_fak"  value="<?php echo $nm_fak ?>" name="nm_fak" placeholder="NAMA FAKULTAS">
                </div>
            </div>
             <div class="form-group">
                <label for="nm_prodi" class="col-sm-2">Dekan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dekan"  value="<?php echo $dekan ?>" name="dekan" placeholder="NAMA DEKAN">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIP/NIDN Dekan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip_dekan"  value="<?php echo $nip_dekan ?>" name="nip_dekan" placeholder="NIP/NIDN DEKAN">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">WD1</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="wd1"  value="<?php echo $wd1 ?>" name="wd1" placeholder="WAKIL DEKAN I">
                </div>
            </div>
            <div class="form-group">
                <label for="ka_prodi" class="col-sm-2">NIP/NIDN WD1</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip_wd1"  value="<?php echo $nip_wd1 ?>" name="nip_wd1" placeholder="NIP/NIDN WD1">
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