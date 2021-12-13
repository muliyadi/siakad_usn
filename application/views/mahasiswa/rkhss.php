<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM REPORT HASIL STUDI / SEMESTER</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>mahasiswa/previewKHS" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php $this->security->get_csrf_token_name();?>" value="<?php $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NIM</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="nim" readonly="true"  value="<?php echo $nim?>" name="nim" placeholder="NIM">
    </div>
    </div>

<div class="form-group">
    <label for="nm_dosen" class="col-sm-2">TAHUN AJARAN</label>
    <div class="col-sm-9">
        <input type="text" id="kd_tahun_ajaran" name="kd_tahun_ajaran" class="form-control" data-toggle="modal" data-target="#myModalta">
    </div>
    </div>
<button id="simpan" class="btn btn-primary">Preview</button>
</form>
</div>
</div>


<div class="modal fade" id="myModalta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">TAHUN AJARAN </h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE TA</th>
                                            <th>TAHUN AJARAN</th>
                                            <th>SEMESTER</th>
                                            <th>AKSI</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listta as $d) {
                                            ?>
                                            <tr>
                                                <td class="tkd_ta"><?php echo $d->kd_tahun_ajaran; ?></td>
                                                <td class="tnm_ta"><?php echo $d->tahun_ajaran; ?></td>
                                                 <td class="tnm_ta"><?php echo $d->semester; ?></td>
                                                <td><button class="pilih2 btn btn-small btn-primary">Pilih</button></td>
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

                <script type="text/javascript">
                $("#lookup2").on('click', '.pilih2', function(e) {
                var currentRow = $(this).closest("tr");
                document.getElementById("kd_tahun_ajaran").value = currentRow.find(".tkd_ta").html();
                $("#myModalta").modal('hide');

                 });

                 </script>
