<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DAFTAR USULAN JUDUL SKRIPSI</h3>
</div >
<div class="panel-body">
<form action="<?php echo base_url();?>Prodi/aps" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<input type="hidden" name="aksi" value="<?php echo $aksi?>" />
	<input type="hidden" name="no_daftar" value="<?php echo $no_daftar?>" />
<div class="form-group">
<label for="tgl_reg_bank" class="col-md-2">TGL DAFTAR</label>
			<div class="col-md-10">
				<input type="text" class="form-control"    name="tgl_daftar" id="tgl_daftar" placeholder="Tgl Daftar" value="<?php echo $tgl_daftar; ?>" />
			</div>
			</div>
<div class="form-group">
    <label for="NIM" class="col-md-2" >MAHASISWA</label>
    <div class="col-md-2">
        <input type="text"  data-toggle="modal" autofocus="true" class="form-control required" value="<?php echo $nim ?>"  id="nim" name="nim" placeholder="NIM">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_mahasiswa" value="<?php echo $nm_mahasiswa ?>" placeholder="NAMA MAHASISWA">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='angkatan' value="<?php echo $angkatan ?>"  id="angkatan" placeholder="ANGKATAN">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari"  class="btn btn-small btn-primary" id="cek" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
<label for="judul" class="col-md-2">JUDUL PENELITIAN</label>
			<div class="col-md-10">
				<input type="text" class="form-control"   name="judul" id="judul" placeholder="Judul Penelitian" value="<?php echo $judul; ?>" />
			</div>
			</div>
<div class="form-group">
    <label for="kd_dosen" class="col-md-2" >DOSEN PEMBIMBING I</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen" class="form-control required" value="<?php echo $kd_dosen1 ?>"  id="kd_dosen" name="kd_dosen" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen" name='nm_dosen' value="<?php echo $nm_dosen1 ?>" placeholder="NAMA DOSEN">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung' id="jafung" value="<?php echo $jafung1 ?>" placeholder="Jafung">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari" data-toggle="modal" data-target="#myModaldosen" class="btn btn-small btn-primary" id="cmddosen" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
    <label for="kd_dosen2" class="col-md-2" >DOSEN PEMBIMBING II</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen2" class="form-control " value="<?php echo $kd_dosen2 ?>"  id="kd_dosen2" name="kd_dosen2" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen2" value="<?php echo $nm_dosen2 ?>" placeholder="NAMA DOSEN">
    </div>
        <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung2'  value="<?php echo $jafung2 ?>" id="jafung2" placeholder="Jafung">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari" data-toggle="modal" data-target="#myModaldosen2" class="btn btn-small btn-primary" id="cmddosen2" placeholder="KODE DOSEN">
    </div>
</div>

<button id="cmdsimpan" class="btn btn-primary">Simpan</button>
</form>
</div >
</div >
                <!-- Modal -->
                
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
                                            <th>NIDN</th>
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
                                            <th>NIK/NIDN</th>
                                            <th>NAMA DOSEN</th>
                                            <th>JAFUNG</th>
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
                                                <td class="tjafung2"><?php echo $d->jafung; ?></td>
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
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script type="text/javascript">

//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
           
                   
            $("#lookup2").on('click', '.pilih2', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen").value = currentRow.find(".tkd_dosen").html();
            document.getElementById("nm_dosen").value = currentRow.find(".tnm_dosen").html();
             document.getElementById("jafung").value = currentRow.find(".tjafung").html();
                      $('#myModaldosen').modal('hide');
            });
            $("#lookup22").on('click', '.pilih22', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen2").value = currentRow.find(".tkd_dosen2").html();
                       document.getElementById("nm_dosen2").value = currentRow.find(".tnm_dosen2").html();
            document.getElementById("jafung2").value = currentRow.find(".tjafung2").html();
                      $('#myModaldosen2').modal('hide');
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
          $("#fset_pembimbing").validate();
       });
    </script>
<script type="text/javascript">
$("#cek").on('click',function() 
{
var nimx=document.getElementById("nim").value;
      var form_data = {
        nim: nimx,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
    $.ajax({
        url: "<?php echo base_url().'prodi/get_mahasiswax'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("angkatan").value=pesan.angkatan;

        $('#judul').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

  $(function() {
                        $("#tgl_daftar").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});


</script>

