<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM INPUT DOSEN PENGAMPUH</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Prodi/ajd" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	
	<input type="hidden" name="kd_jadwal" value="<?php echo $kd_jadwal?>" />


<div class="form-group">
    <label for="NIM" class="col-md-2" >MATAKULIAH</label>
    <div class="col-md-2">
        <input type="text"  readonly="true" data-toggle="modal"  class="form-control required" value="<?php echo $nm_mtk ?>"  id="nm_mtk" name="nm_mtk" placeholder="NIM">
    </div>
    
    <label for="kd_dosen" class="col-md-1" >SEMESTER</label>
    <div class="col-md-1">
        <input type="text" readonly="true" class="form-control" name='semester' id="semester" value="<?php echo $semester ?>"placeholder="SEMESTER">
    </div>
    <label for="kd_dosen" class="col-md-1" >SKS</label>
    <div class="col-md-1">
        <input type="text" readonly="true" class="form-control" id="sks" value="<?php echo $sks ?>"placeholder="SKS">
    </div>
    <label for="kd_dosen" class="col-md-1" >KELAS</label>
    <div class="col-md-1">
        <input type="text" readonly="true"  class="form-control" id="kelas" name='kelas' value="<?php echo $kelas ?>" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
<label for="NIM" class="col-md-2" >Bentuk Kelas</label>

   <div id="combox" class="col-sm-2"> <!-- sebagai indentitas combo box -->
   <select name="kd_jenis_subtansi" id="kd_jenis_subtansi" class="form-control"  >
  
<?php
	
    foreach($ljs as $js)
    {

    ?>

    <option value="<?php echo $js->kd_jenis_subtansi; ?>" ><?php echo $js->nm_jenis_subtansi?></option>

    <?php
    }
?>

</select>

          </div>
<div class="col-md-6">
        <input type="text"   class="form-control required" value="<?php echo $subtansi ?>"  id="subtansi" name="subtansi" placeholder="Subtansi">
    </div>
</div>
<div class="form-group">
<label for="kd_dosen" class="col-md-2" >DOSEN KE</label>
    <div class="col-md-1">
        <input type="text"   class="form-control required" value="<?php echo $dosen_ke ?>"  autofocus="true" id="dosen_ke" name="dosen_ke" placeholder="ISI = 1,2,3">
    </div>
    <label for="kd_dosen" class="col-md-1" >NAMA DOSEN</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen" class="form-control required" value="<?php echo $nm_dosen ?>"  id="nm_dosen" name="nm_dosen" placeholder="NAMA DOSEN">
    </div>
    <label for="kd_dosen" class="col-md-1" >KODE DOSEN</label>
    <div class="col-md-1">
        <input type="text" readonly="true" class="form-control" id="kd_dosen" name='kd_dosen' value="<?php echo $kd_dosen ?>" placeholder="KODE DOSEN">
    </div>
    <label for="kd_dosen" class="col-md-1" >JAFUNG</label>
     <div class="col-md-1">
        <input type="text" readonly="true" class="form-control" name='jafung' id="jafung" value="<?php echo $jafung ?>" placeholder="Jafung">
    </div>
</div>

<div class="form-group">
<label for="kd_dosen" class="col-md-2" >JUMLAH PERTEMUAN</label>
    <div class="col-md-2">
        <input type="number"   class="form-control required" value="<?php echo $jumlah_pertemuan ?>"  id="jumlah_pertemuan" name="jumlah_pertemuan" placeholder="JUMLAH PERTEMUAN">
    </div>

<label for="kd_dosen" class="col-md-1" >DARI TOTAL PERTEMUAN</label>
     <div class="col-md-1">
        <input type="text" class="form-control" name='total_pertemuan' id="total_pertemuan" value="16" placeholder="total_pertemuan">
    </div>
    </div>
<div class="form-group">
<label for="kd_dosen" class="col-md-2" >JUMLAH SKS</label>
    <div class="col-md-2">
        <input type="text" readonly="true"   class="form-control" value="<?php echo $jumlah_sks ?>"  id="jumlah_sks" name="jumlah_sks" placeholder="JUMLAH SKS">
    </div>
</div>





<button id="cmdsimpan" class="btn btn-primary">Simpan</button>
</form>
</div >
</div >
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>DAFTAR DOSEN PENGAMPUH</h3>
</div >
<div class="panel-body">
<table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>

                    <th>
                       DOSEN KE
                    </th>
                    <th>
                        KODE DOSEN/NIDN 
                    </th>
                    <th>
                        NAMA DOSEN
                    </th>
                    <th>
                        JAFUNG
                    </th>
                    <th>
                        JUMLAH SKS
                    </th>
                   <th>STATUS</th>
                     



                </tr>
            </thead>
            <tbody>
                <?php
                $start = 0;
                if ($list) {
                    foreach ($list as $r) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $r->dosen_ke ?>
                            </td>
                            <td>
                                <?php echo $r->kd_dosen ?>/<?php echo $r->NIDN ?>
                            </td>

                            <td>
                                <?php echo $r->nm_dosen ?>
                            </td>
                            <td>
                                <?php echo $r->jafung ?>
                            </td>
                            <td>
                                <?php echo $r->jumlah_sks ?>
                            </td>
                            <td>
                               
                            <a  class="btn btn-primary btn-xs" href="<?php echo base_url() . 'prodi/djd/' . $r->kd_jadwal.'/'.$r->kd_dosen ?>">Batal</a> 
                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
      </div>
      </div>
                <!-- Modal -->
                
                <!--batas akhir modal -->
                <div class="modal fade" id="myModaldosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Dosen</h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>KODE DOSEN</th>
                                            <th>NAMA DOSEN</th>
                                            <th>JAFUNG</th>

                                            
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
                                                <td class="tjafung"><?php echo $d->jafung; ?></td>
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
                 
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script type="text/javascript">


           
                   
            $("#lookup2").on('click', '.pilih2', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen").value = currentRow.find(".tkd_dosen").html();
            document.getElementById("nm_dosen").value = currentRow.find(".tnm_dosen").html();
             document.getElementById("jafung").value = currentRow.find(".tjafung").html();
                      $('#myModaldosen').modal('hide');
                      
            });
           
                        
             $(function() {
                        $("#lookup").dataTable();
                    });

            $(function() {
                        $("#lookup2").dataTable();
                    });
                 
                     $(function() {
                        $("#lookup22").dataTable();
                    });
                    
                    
                </script>
                



<script type="text/javascript">
    $(document).ready(function() {
        $("#jumlah_pertemuan").keyup(function() {
            var jumlah_pertemuan  = $("#jumlah_pertemuan").val();
var total_pertemuan  = $("#total_pertemuan").val();
            var sks = $("#sks").val();

            var jumlah_sks = parseInt(jumlah_pertemuan) / parseInt(total_pertemuan) * parseInt(sks);
            $("#jumlah_sks").val(jumlah_sks);
        });
    });
</script>

