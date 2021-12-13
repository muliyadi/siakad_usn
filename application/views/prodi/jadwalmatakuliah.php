<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>JADWAL KELAS MATAKULIAH</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Prodi/ajm" method="post" class="form-user form-horizontal" id="fjadwal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<input type="hidden" name="aksi" value="<?php echo $aksi?>" />
<input type="hidden" name="kd_jadwal" value="<?php echo $kd_jadwal?>" />

	<div class="form-group">
    <label for="kd_tahun_ajaran" class="col-md-2" >TAHUN AJARAN</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="<?php echo $kd_tahun_ajaran?>" readonly="true" required="true" id="kd_tahun_ajaran" name="kd_tahun_ajaran" placeholder="TAHUN AJARAN">
    </div>
</div>
<div class="form-group">
    <label for="kd_prodi" class="col-md-2" >PROGRAM STUDI</label>
    <div class="col-md-1">
        <input type="text" readonly="true" value="<?php echo $kd_prodi?>" required="true" class="form-control" id="kd_prodi" name="kd_prodi" placeholder="PRODI">
    </div>
	    <div class="col-md-8">
        <input type="text" readonly="true" value="<?php echo $nm_prodi?>"  class="form-control" id="nm_prodi" name="nm_prodi" placeholder="PRODI">
    </div>
</div>
<div class="form-group">
    <label for="kd_mtk" class="col-md-2" >MATA KULIAH</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModal" value="<?php echo $kd_mtk ?>" class="form-control required" name="kd_mtk" id="kd_mtk" placeholder="KODE MTK">
    </div>
    <div class="col-md-7">
         <input type="text" readonly="true" class="form-control" id="nm_mtk" value="<?php echo $nm_mtk?>" placeholder="NAMA MTK">
    </div>
    <div class="col-md-1">
        <input type="button"  value="Cari" data-toggle="modal" data-target="#myModal" class="btn btn-small btn-primary" id="cmdmtk">
    </div>
</div>


<div class="form-group">
    <label for="kd_dosen" class="col-md-2" >KELAS</label>
    <div class="col-md-9">
        <input type="text" class="form-control required" id="kelas" name="kelas" value="<?php echo $kelas ?>" placeholder="KELAS">
    </div>
</div>
<div class="form-group">
    <label for="hari" class="col-md-2" >HARI</label>
    <div class="col-md-9">
        <select name="hari" id="hari" class="form-control"  >
  
<?php
	
    foreach($listhari as $d)
    {
    $selected = '';
    if($hari==$d->hari)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $d->hari; ?>" <?php echo $selected; ?>><?php echo $d->hari?></option>

    <?php
    }
?>
<option></option>
</select>

     </div>
</div>
<div class="form-group">
    <label for="jam" class="col-md-2" >JAM</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="jam" value="<?php echo $jam?>" name="jam" placeholder="JAM">
    </div>
</div>
<div class="form-group">
    <label for="kd_ruang" class="col-md-2" >RUANG</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="kd_ruang" value="<?php echo $kd_ruang?>" data-toggle="modal" data-target="#myModalruang"  name="kd_ruang" placeholder="RUANG">
    </div>
    <div class="col-md-1">
        <input type="button" data-toggle="modal" value="Cari" data-target="#myModalruang" class="btn btn-small btn-primary" id="cmdmtk">
    </div>
</div>
<div class="form-group">
    <label for="kapasitas" class="col-md-2" >KUOTA</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="kapasitas" value="<?php echo $kapasitas?>" name="kapasitas" placeholder="KUOTA">
    </div>
</div>
<div class="form-group">
    <label for="kapasitas" class="col-md-2" >LINK KELAS ONLINE </label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="link_virtual" value="<?php echo $link_virtual?>" name="link_virtual" placeholder="LINK ZOOM/GMEET">
    </div>
</div>
<button id="cmdsimpan" class="btn btn-primary">Simpan</button>
</form>
</div >
</div >
                <!-- Modal -->
                <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Matakuliah </h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>MATAKULIAH</th>
                                            <th>SKS</th>
                                            <th>SEMESTER</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($matakuliah as $r) {
                                            ?>
                                            <tr class="pilih" data-kdmtk="<?php echo $r->kd_mtk; ?>">
                                                <td class="tkd_mtk"><?php echo $r->kd_mtk; ?></td>
                                                <td class="tnm_mtk"><?php echo $r->nm_mtk; ?></td>
                                                <td class="tsks"><?php echo $r->sks; ?></td>
                                                <td class="tsemester"><?php echo $r->semester_ke; ?></td>
                                               <td><button class="btn btn-small btn-primary pilih">Pilih</button></td> 
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
                <!--batas akhir modal -->
                <div class="modal fade" id="myModaldosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Dosen USN</h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE DOSEN</th>
                                            <th>NAMA DOSEN</th>
                                            <th>HOME BASE</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dosen as $d) {
                                            ?>
                                            <tr class="pilih2" data-kddosen="<?php echo $d->kd_dosen; ?>">
                                                <td class="tkd_dosen"><?php echo $d->kd_dosen; ?></td>
                                                <td class="tnm_dosen"><?php echo $d->nm_dosen; ?></td>
                                                <td class="tprodi_dosen"><?php echo $d->kd_prodi; ?></td>
                                                <td><button class="btn btn-primary pilih2">Pilih</button></td>
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
                 <div class="modal fade" id="myModaldosen2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Dosen USN</h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup22" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE DOSEN</th>
                                            <th>NAMA DOSEN</th>
                                            <th>HOME BASE</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dosen as $d) {
                                            ?>
                                            <tr class="pilih22" data-kddosen="<?php echo $d->kd_dosen; ?>">
                                                <td class="tkd_dosen2"><?php echo $d->kd_dosen; ?></td>
                                                <td class="tnm_dosen2"><?php echo $d->nm_dosen; ?></td>
                                                <td class="tprodi_dosen"><?php echo $d->kd_prodi; ?></td>
                                                <td><button class="btn btn-primary pilih22">Pilih</button></td>
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
                <div class="modal fade" id="myModalruang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Ruang Kelas</h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup3" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE</th>
                                            <th>RUANG</th>
                                            <th>KAPASITAS</th>
                                            <th>FASILITAS</th>
                                            <th>GEDUNG</th>
                                             <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($ruang as $ruangan) {
                                            ?>
                                            <tr class="pilih2" data-kddosen="<?php echo $ruangan->kd_ruang; ?>">
                                            <td class="tkd_ruang"><?php echo $ruangan->kd_ruang; ?></td>
                                                <td class="tnm_ruang"><?php echo $ruangan->nm_ruang; ?></td>
                                                <td class="tkap_maksimal"><?php echo $ruangan->kap_maksimal; ?></td>
                                                <td class="tfasilitas"><?php echo $ruangan->fasilitas; ?></td>
                                                <td class="tgedung"><?php echo $ruangan->gedung; ?></td>
                                                <td><button class="btn btn-primary pilih3">Pilih</button></td>
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

//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
            $("#lookup").on('click', '.pilih', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_mtk").value = currentRow.find(".tkd_mtk").html();
            document.getElementById("nm_mtk").value = currentRow.find(".tnm_mtk").html();
            $('#myModal').modal('hide');
            });
                   
            $("#lookup2").on('click', '.pilih2', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen").value = currentRow.find(".tkd_dosen").html();
            document.getElementById("nm_dosen").value = currentRow.find(".tnm_dosen").html();
                      $('#myModaldosen').modal('hide');
            });
            $("#lookup22").on('click', '.pilih22', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen2").value = currentRow.find(".tkd_dosen2").html();
            document.getElementById("nm_dosen2").value = currentRow.find(".tnm_dosen2").html();
                      $('#myModaldosen2').modal('hide');
            });
                        $("#lookup3").on('click', '.pilih3', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_ruang").value = currentRow.find(".tkd_ruang").html();
            document.getElementById("kapasitas").value = currentRow.find(".tkap_maksimal").html();
                      $('#myModalruang').modal('hide');
            });
             $(function() {
                        $("#lookup").dataTable();
                    });

            $(function() {
                        $("#lookup2").dataTable();
                    });
                  $(function() {
                        $("#lookup3").dataTable();
                    });
                     $(function() {
                        $("#lookup22").dataTable();
                    });
                </script>
                

<script type="text/javascript">
$(document).ready(function(){
    $("#simpan").click(function(){
        var data = $('.form-user').serialize();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url().'/prodi/ajm';?>",
            data: data,
            success: function() {
              
                    alert('sukses tersimpan');

              
                

            }
        });
    });


});
</script>
<script type="text/javascript">
       $(document).ready(function(){
          $("#fjadwal").validate();
       });
    </script>
