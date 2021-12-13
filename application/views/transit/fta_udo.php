<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>INPUT TAHUN ANGKATAN</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   id="fdosen"action="<?php echo base_url(); ?>Prodi/fpa" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
           
		   <div class="form-group">
    <label for="kd_dosen" class="col-md-2" >DOSEN</label>
    <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" id="kd_dosen" name="kd_dosen" placeholder="KODE DOSEN">
    </div>
        <div class="col-sm-7">
        <input type="text" readonly="true"class="form-control" id="nm_dosen"  name="nm_dosen" placeholder="NAMA DOSEN">
    </div>
    <div class="col-md-1">
        <input type="button"value="Cari"  data-toggle="modal" data-target="#myModaldosen" class="btn btn-small btn-primary" id="kd_dosen" placeholder="KODE DOSEN">
    </div>
    </div>
		  <div class="form-group">
                <label for="angkatan" class="col-sm-2">ANGKATAN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="angkatan"  value="<?php echo $angkatan ?>" name="angkatan" placeholder="ANGKATAN">
                </div>
            </div>
			

            <button class="btn btn-primary">Lanjut</button>
        </form>

    </div >
</div >
<div class="modal fade" id="myModaldosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Dosen Prodi ></h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE DOSEN</th>
                                            <th>NAMA DOSEN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dosen as $d) {
                                            ?>
                                            <tr>
                                                <td class="tkd_dosen"><?php echo $d->kd_dosen; ?></td>
                                                <td class="tnm_dosen"><?php echo $d->nm_dosen; ?></td>
                                                <td width="10"><button class="btn btn-xs btn-primary pilih2">Pilih</button></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript">
       $(document).ready(function(){
          $("#fdosen").validate();
       });
    </script>
<script type="text/javascript">
	 $("#lookup2").on('click', '.pilih2', function(e) {
                var currentRow = $(this).closest("tr");
                document.getElementById("kd_dosen").value = currentRow.find(".tkd_dosen").html();
                 document.getElementById("nm_dosen").value = currentRow.find(".tnm_dosen").html();
                $('#myModaldosen').modal('hide');
                 });
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