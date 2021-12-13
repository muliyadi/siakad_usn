<form   action="<?php echo base_url(); ?>Prodi/apa" method="post" class="form-user form-horizontal">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class='panel-title'>Edit Perwalian Dosen</h3>
        </div >
        <div class="panel-body">

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <div class="form-group">
                <label for="no_pa" class="col-sm-2">No PA</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="true" id="no_pa" value="<?php echo $datah->no_pa ?>" name="no_pa" placeholder="TAHUN ANGKATAN">
                </div>
            </div>
            <div class="form-group">
                <label for="tgl_pa" class="col-sm-2">Tgl PA</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tgl_pa" value="<?php echo $datah->tgl_pa ?>" name="tgl_pa" placeholder="TAHUN ANGKATAN">
                </div>
            </div>
            <div class="form-group">
                <label for="kd_dosen" class="col-md-2" >DOSEN</label>
                <div class="col-md-2">
                    <input type="text" readonly="true" class="form-control" id="kd_dosen" value="<?php echo $datah->kd_dosen ?>"  name="kd_dosen" placeholder="KODE DOSEN">
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" readonly="true" id="nm_dosen" value="<?php echo $datah->nm_dosen ?>" placeholder="NAMA DOSEN">
                </div>
                <div class="col-md-1">
                    <input type="button"value="Cari"  data-toggle="modal" data-target="#myModaldosen" class="btn btn-small btn-primary" id="kd_dosen" placeholder="KODE DOSEN">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_dosen" class="col-sm-2">Tahun Angkatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="thn_angkatan" value="<?php echo $datah->thn_angkatan ?>" name="thn_angkatan" placeholder="TAHUN ANGKATAN">
                </div>
            </div>  
            <table id="tmahasiswa2" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="30">NO</th>
                        <th>NIM</th>
                        <th>NAMA MAHASISWA</th>
                        <th>ANGKATAN</th>
                        <th>STATUS</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($listmhs as $mhs) {
                        $cek = 'tidak';
                        foreach ($data as $mhs2) {

                            if ($mhs2->nim == $mhs->nim) {
                                $cek = 'sama';
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                        <?php
                        if ($cek == 'sama') {
                            ?>
                                <td class="tnim"><input checked="checked" type="checkbox" name="mhs[]" value="<?php echo $mhs->nim; ?>"> <?php echo $mhs->nim; ?>

                                </td>
                                <?php
                            } else {
                                ?>
                                <td class='tnim'><input  type='checkbox' name='mhs[]' value='<?php echo $mhs->nim; ?>'/> <?php echo $mhs->nim; ?>

                                </td>
                                <?php
                            }
                            ?>

                            <td class="tnm_mhs"><?php echo $mhs->nm_mahasiswa; ?></td>
                            <td class="tangkatan"><?php echo $mhs->angkatan; ?></td>
                            <td class="tkd_prodi"><?php echo $mhs->status; ?></td>

                        </tr>

                            <?php
                        }
                        ?>
                </tbody>
            </table> 
            <button id="simpan"  class="btn btn-primary">Simpan</button>


        </div >
    </div >

</form>

<!--batas awal  modal -->
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
                                <td><button class="btn btn-small btn-primary pilih2">Pilih</button></td>
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
<script src="<?php echo base_url('assets/js/angular.js') ?>"></script>
<script src="<?php echo base_url('assets/js/app.js') ?>"></script>

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



</script>
<script>
    $('#tmahasiswa2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false
    });
</script>
