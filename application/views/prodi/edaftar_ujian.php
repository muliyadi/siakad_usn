
<form action="<?php echo base_url();?>Prodi/adaftar_ujian" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<input type="hidden" name="aksi" value="<?php echo $aksi?>" />
	<div class="panel panel-primary">
<div class="panel-heading">
<h4 class='panel-title'>PENDAFTAR</h4>
</div >
<div class="panel-body">
	<div class="form-group">

 <label for="jenis_ujian" class="col-md-2" >JENIS PENDAFTARAN </label>
<div class="col-md-9">
	 <select name="jenis_ujian" id="jenis_ujian" class="form-control"  >
 

 
<?php
    
	foreach($listjenis_ujian as $row)
	{
    $selected = '';
    if($row->urutan === $pendaftar->urutan)
    {
        $selected = 'selected="selected"';
    
    }
   
    ?>

     <option value="<?php echo $row->urutan; ?>" <?php echo $selected; ?>><?php echo $row->jenis_ujian?></option>

    <?php
    }
?>  


</select>
</div>

</div>
<div class="form-group">
<label for="judul" class="col-md-2">NO DAFTAR UJIAN</label>
			<div class="col-md-9">
				<input type="text" class="form-control" readlonly="true"   name="no_daftar" id="no_daftar" placeholder="NO DAFTAR" value="<?php echo $pendaftar->no_daftar; ?>" />
			</div>
			<div class="col-md-1">
        <input type="button" value="Cari"  class="btn btn-small btn-primary" id="cek" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
<label for="judul" class="col-md-2">TGL DAFTAR UJIAN</label>
			<div class="col-md-9">
				<input type="text" class="form-control"   name="tgl_daftar" id="tgl_daftar" placeholder="TGL DAFTAR"  value="<?php echo $pendaftar->tgl_daftar; ?>" />
			</div>

</div>
<div class="form-group">
<label for="judul" class="col-md-2">NO DAFTAR JUDUL</label>
			<div class="col-md-9">
				<input type="text" class="form-control"   name="no_daftar_judul" id="no_daftar" placeholder="NO DAFTAR" value="<?php echo $pendaftar->no_daftar_judul; ?>" />
			</div>
			<div class="col-md-1">
        <input type="button" value="Cari"  class="btn btn-small btn-primary" id="cek" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
    <label for="NIM" class="col-md-2" >MAHASISWA</label>
    <div class="col-md-2">
        <input type="text" readonly="true"  class="form-control required" value="<?php echo $pendaftar->nim ?>"  id="nim" name="nim" placeholder="NIM">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_mahasiswa"  value="<?php echo $pendaftar->nm_mahasiswa ?>"   placeholder="NAMA MAHASISWA">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='angkatan' id="angkatan" value="<?php echo $pendaftar->angkatan ?>"   placeholder="ANGKATAN">
    </div>
    
</div>
<div class="form-group">
<label for="judul" class="col-md-2">JUDUL PENELITIAN</label>
			<div class="col-md-9">
				<input type="text" class="form-control"   name="judul" id="judul" placeholder="Judul Penelitian" value="<?php echo $pendaftar->judul; ?>" />
			</div>
</div>
<div class="form-group">
    <label for="kd_dosen_pembimbing1" class="col-md-2" >DOSEN PEMBIMBING I</label>
    <div class="col-md-2">
        <input type="text" readonly="true"  class="form-control required" value="<?php echo $kd_dosen_pembimbing1 ?>"  id="kd_dosen_pembimbing1" name="kd_dosen_pembimbing1" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen_pembimbing1" value="<?php echo $nm_dosen_pembimbing1 ?>" placeholder="NAMA DOSEN">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung_pembimbing1' id="jafung_pembimbing1" placeholder="Jafung">
    </div>

</div>
<div class="form-group">
    <label for="kd_dosen_pembimbing2" class="col-md-2" >DOSEN PEMBIMBING II</label>
    <div class="col-md-2">
        <input type="text" readonly="true"  class="form-control required" value="<?php echo $kd_dosen_pembimbing2 ?>"  id="kd_dosen_pembimbing2" name="kd_dosen_pembimbing2" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen_pembimbing2"  value="<?php echo $nm_dosen_pembimbing2 ?>" placeholder="NAMA DOSEN">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung_pembimbing2' id="jafung_pembimbing2" placeholder="Jafung">
    </div>

</div>
</div>
</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>SET PENGUJI</h3>
</div >
<div class="panel-body">
<div class="form-group">
    <label for="kd_dosen" class="col-md-2" >DOSEN PENGUJI I</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen" class="form-control required" value="<?php echo $kd_dosen_penguji1 ?>"  id="kd_dosen" name="kd_dosen1" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen"  value="<?php echo $nm_dosen_penguji1 ?>"placeholder="NAMA DOSEN">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung' value="<?php echo $jafung_penguji1 ?>" id="jafung" placeholder="Jafung">
    </div>
    <div class="col-md-1">
        <input type="button" autofocus="true" value="Cari" data-toggle="modal" data-target="#myModaldosen" class="btn btn-small btn-primary" id="cmddosen" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
    <label for="kd_dosen2" class="col-md-2" >DOSEN PENGUJI II</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen2" class="form-control " value="<?php echo $kd_dosen_penguji2 ?>"  id="kd_dosen2" name="kd_dosen2" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" value="<?php echo $nm_dosen_penguj2 ?>" id="nm_dosen2" placeholder="NAMA DOSEN">
    </div>
        <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung2' id="jafung2" value="<?php echo $jafung_penguji2 ?>" placeholder="Jafung">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari" data-toggle="modal" data-target="#myModaldosen2" class="btn btn-small btn-primary" id="cmddosen2" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
    <label for="kd_dosen2" class="col-md-2" >DOSEN PENGUJI III</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModaldosen3" class="form-control " value="<?php echo $kd_dosen_penguji3 ?>"  id="kd_dosen3" name="kd_dosen3" placeholder="KODE DOSEN">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_dosen3" value="<?php echo $nm_dosen_penguji3 ?>" placeholder="NAMA DOSEN">
    </div>
        <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" name='jafung3' id="jafung3" value="<?php echo $jafung_penguji3 ?>" placeholder="Jafung">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari" data-toggle="modal" data-target="#myModaldosen3" class="btn btn-small btn-primary" id="cmddosen3" placeholder="KODE DOSEN">
    </div>
</div>
</div>
</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>JADWAL UJIAN</h3>
</div >
<div class="panel-body">
<div class="form-group">
<label for="tgl_ujian" class="col-md-2">TGL UJIAN</label>
<div class="col-md-9">
<input type="date" class="form-control"   name="tgl_ujian" id="tgl_ujian" placeholder="TGL DAFTAR"  autofocus="true"  value="<?php echo $pendaftar->tgl_ujian; ?>" />
</div>

</div>
<div class="form-group">
<label for="tgl_ujian" class="col-md-2">JAM UJIAN</label>
			<div class="col-md-9">
				<input type="time" class="form-control"   name="jam_ujian" id="jam_ujian" placeholder="JAM UJIAN"  autofocus="true"  value="<?php echo $pendaftar->jam; ?>" />
			</div>

</div>
<div class="form-group">
<label for="tgl_ujian" class="col-md-2">RUANG UJIAN</label>
			<div class="col-md-9">
				<input type="text" class="form-control"   name="ruang_ujian" id="ruang_ujian" placeholder="RUANG UJIAN"  value="<?php echo $pendaftar->ruang; ?>" />
			</div>

</div>
</div>
</div>

<div class="panel panel-primary">

<div class="panel-body">
<button id="cmdsimpan" class="btn btn-primary">Simpan</button>

</div >
</div >
  </form>              <!-- Modal -->
                
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
                                 <div class="modal fade" id="myModaldosen3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Daftar Dosen USN</h4>
                            </div>
                            <div class="modal-body">
                                <table id="lookup23" class="table table-bordered table-hover table-striped">
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
                                            <tr class="pilih23" data-kddosen="<?php echo $d->kd_dosen; ?>">
                                                <td class="tkd_dosen3"><?php echo $d->kd_dosen; ?></td>
                                                <td class="tnm_dosen3"><?php echo $d->nm_dosen; ?></td>
                                                <td class="tjafung3"><?php echo $d->jafung; ?></td>
                                                <td><button class="btn btn-primary pilih23">Pilih</button></td>
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
             $("#lookup23").on('click', '.pilih23', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_dosen3").value = currentRow.find(".tkd_dosen3").html();
                       document.getElementById("nm_dosen3").value = currentRow.find(".tnm_dosen3").html();
            document.getElementById("jafung3").value = currentRow.find(".tjafung3").html();
                      $('#myModaldosen3').modal('hide');
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
                     $(function() {
                        $("#lookup23").dataTable();
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
var no_daftarx=document.getElementById("no_daftar").value;
      var form_data = {
        no_daftar: no_daftarx,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
    $.ajax({
        url: "<?php echo base_url().'prodi/get_data_pendaftar_judul'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
            document.getElementById("nim").value=pesan.nim;
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("angkatan").value=pesan.angkatan;
        document.getElementById("judul").value=pesan.judul;
document.getElementById("kd_dosen_pembimbing1").value=pesan.kd_dosen_pembimbing1;
document.getElementById("nm_dosen_pembimbing1").value=pesan.nm_dosen_pembimbing1;
document.getElementById("jafung_pembimbing1").value=pesan.jafung_pembimbing1;

document.getElementById("kd_dosen_pembimbing2").value=pesan.kd_dosen_pembimbing2;
document.getElementById("nm_dosen_pembimbing2").value=pesan.nm_dosen_pembimbing2;
document.getElementById("jafung_pembimbing2").value=pesan.jafung_pembimbing2;
      //  $('#no_reg_bank').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        }
     
         
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

