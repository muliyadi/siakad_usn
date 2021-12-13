<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM DATA DOSEN</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   id="fdosen"action="<?php echo base_url(); ?>Prodi/adosen" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <input type="hidden" value="<?php echo $aksi ?>" name="aksi">
            <div class="form-group">
                <label for="kd_dosen_lama" class="col-sm-2">NIK/KODE LAMA</label>
                <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control required" id="kd_dosen_lama"  value="<?php echo $kd_dosen_lama ?>" name="kd_dosen_lama" placeholder="Isi dengan Nomor Induk Kepegawaian USN">
                </div>
            </div>
			<div class="form-group">
                <label for="kd_dosen" class="col-sm-2">NIK/KODE BARU</label>
                <div class="col-sm-10">
                    <input type="text" autofocus="true" class="form-control required" id="kd_dosen"  value="<?php echo $kd_dosen ?>" name="kd_dosen" placeholder="Isi dengan Nomor Induk Kepegawaian USN yang baru">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_dosen" class="col-sm-2">NIDN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nidn" value="<?php echo $nidn ?>" name="nidn" placeholder="NIDN">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_dosen" class="col-md-2" >NAMA DOSEN</label>
                <div class="col-md-10">
                    <input type="text" class="form-control required" id="nm_dosen" name="nm_dosen" value="<?php echo $nm_dosen ?>" placeholder="ISI NAMA LENGKAP">
                </div>
            </div>
            <div class="form-group">
                <label for="jns_kelamin" class="col-md-2" >JENIS KELAMIN</label>
                <div class="col-sm-10">
                    <select name="jns_kelamin" class="form-control">
                        <?php
                        if ($jns_kelamin == "LAKI-LAKI") {
                            ?>
                            <option value="LAKI-LAKI" selected="selected">LAKI-LAKI</option>
                            <option value="PEREMPUAN">PEREMPUAN</option>
                            <?php
                        } else if ($jns_kelamin == "PEREMPUAN") {
                            ?>
                            <option value="PEREMPUAN" selected="selected">PEREMPUAN</option>
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <?php
                        } else {
                            ?>
                            <option value="-" selected="selected">Pilih -</option>
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <option value="PEREMPUAN">PEREMPUAN</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-md-2" >ALAMAT</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" placeholder="ISI ALAMAT LENGKAP">
                </div>
            </div>
            <div class="form-group">
                <label for="tempat" class="col-md-2" >TEMPAT/TGL LAHIR</label>
                <div class="col-md-5">
                    <input type="text" class="form-control required" id="tempat" name="tempat" value="<?php echo $tempat ?>"  placeholder="ISI TEMPAT LAHIR">
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir ?>" placeholder="yyyy-mm-dd">
                </div>
            </div>
            <div class="form-group">
                <label for="telepon" class="col-md-2" >TELEPON</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="telepon"  value="<?php echo $telepon ?>"  name="telepon" placeholder="ISI NO TELEPON ATAU HP">
                </div>
            </div>
            <div class="form-group">
                <label for="nim" class="col-md-2" >AGAMA</label>
                <div class="col-sm-10">
                    <select name="agama" width='40' class="form-control">
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="HINDU">HINDU</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="KONGHUCU">KONGHUCU</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-md-2" >EMAIL</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="email"  value="<?php echo $email ?>"  name="email" placeholder="ISI EMAIL ISTITUSI --------@USN.AC.ID">
                </div>
            </div>
                         <div class="form-group">
                <label for="alamat" class="col-md-2" >Home Base</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="email"  value="<?php echo $kd_prodi ?>"  name="kd_prodi" placeholder="KODE HOME BASE">
                </div>
            </div>
            <div class="form-group">
                <label for="nim" class="col-md-2" >STATUS</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control required">
                        <?php
                        if ($status == "Tetap") {
                            ?>
                            <option value="Tetap" selected="selected">Tetap</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="LB">LB</option>
                            <?php
                        } else if ($status == "Kontrak") {
                            ?>
                            <option value="Kontrak" selected="selected">Kontrak</option>
                            <option value="LB">LB</option>
                            <option value="Tetap">Tetap</option>
                            <?php
                        } else if ($status == "LB") {
                            ?>
                            <option value="LB" selected="selected">LB</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Tetap">Tetap</option>
                            <?php
                        } else {
                            ?>
                            <option value="-" selected="selected">Pilih -</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Tetap">Tetap</option>
                            <option value="LB">LB</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>

    </div >
</div >


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