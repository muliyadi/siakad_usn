<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>FORM DATA DOSEN</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form   id="fdosen"action="<?php echo base_url(); ?>dosen/udosen" method="post"  enctype="multipart/form-data"  class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2"> </label>
    <div class="col-sm-10">
         <img id="preview" width="120" height="120" src="<?php echo $dosen->link_foto?>" class="img-responsive img-thumbnail" alt="Preview Image">
         <br>Format *.jpg Size Max 512Kb
    </div>
    </div>
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">Foto </label>
    <div class="col-sm-10">
        <input type="file" class="form-control" autofocus="true"  name="link_foto" id="link_foto" onchange="tampilkanPreview(this,'preview')">
    </div>
    </div>
     
            <div class="form-group">
                <label for="kd_dosen" class="col-sm-2">NIK/KODE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" id="kd_dosen"  value="<?php echo $dosen->kd_dosen ?>" name="kd_dosen" placeholder="ISI DENGAN Nomor Induk Kepegawaian USN">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_dosen" class="col-sm-2">NIDN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nidn" value="<?php echo $dosen->NIDN ?>" name="nidn" placeholder="NIDN">
                </div>
            </div>
            <div class="form-group">
                <label for="nm_dosen" class="col-md-2" >NAMA DOSEN</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nm_dosen" name="nm_dosen" value="<?php echo $dosen->nm_dosen ?>" placeholder="ISI NAMA LENGKAP">
                </div>
            </div>
            <div class="form-group">
                <label for="jns_kelamin" class="col-md-2" >JENIS KELAMIN</label>
                <div class="col-sm-10">
                    <select name="jns_kelamin" class="form-control">
                        <?php
                        if ($dosen->jns_kelamin == "Laki-Laki") {
                            ?>
                            <option value="Laki-Laki" selected="selected">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <?php
                        } else if ($dosen->jns_kelamin == "Perempuan") {
                            ?>
                            <option value="Perempuan" selected="selected">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <?php
                        } else {
                            ?>
                            <option value="-" selected="selected">Pilih -</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-md-2" >ALAMAT</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $dosen->alamat ?>" placeholder="ISI ALAMAT LENGKAP">
                </div>
            </div>
            <div class="form-group">
                <label for="tempat" class="col-md-2" >TEMPAT/TGL LAHIR</label>
                <div class="col-md-5">
                    <input type="text" class="form-control required" id="tempat" name="tempat" value="<?php echo $dosen->tempat ?>"  placeholder="ISI TEMPAT LAHIR">
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $dosen->tgl_lahir ?>" placeholder="yyyy-mm-dd">
                </div>
            </div>
            <div class="form-group">
                <label for="telepon" class="col-md-2" >TELEPON</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="telepon"  value="<?php echo $dosen->telepon ?>"  name="telepon" placeholder="ISI NO TELEPON ATAU HP">
                </div>
            </div>
           <div class="form-group">
			<label for="agama" class="col-md-2" >AGAMA</label>
			<div class="col-md-10">
			<select name="agama" id="agama" class="form-control">
<option value=''>Pilih</option>
			<?php
	
			foreach($listagama as $agama)
			{
    $selected = '';
    if($dosen->agama==$agama->agama)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $agama->agama; ?>" <?php echo $selected; ?>><?php echo $agama->agama?></option>

    <?php
    }
?>

</select>

     </div>
</div>
            <div class="form-group">
                <label for="alamat" class="col-md-2" >EMAIL</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="email"  value="<?php echo $dosen->email ?>"  name="email" placeholder="ISI EMAIL ISTITUSI --------@USN.AC.ID">
                </div>
            </div>
            <div class="form-group">
			<label for="agama" class="col-md-2" >JAFUNG</label>
			<div class="col-md-10">
			<select name="jafung" id="jafung" class="form-control">
<option value=''>Pilih</option>
			<?php
	
			foreach($listjafung as $jafung)
			{
    $selected = '';
    if($dosen->jafung==$jafung->jafung)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jafung->jafung; ?>" <?php echo $selected; ?>><?php echo$jafung->jafung?></option>

    <?php
    }
?>

</select>

     </div>
</div>
             
            <div class="form-group">
                <label for="status" class="col-md-2" >STATUS</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                        <?php
                        if ($dosen->Status == "Tetap") {
                            ?>
                            <option value="Tetap" selected="selected">Tetap</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="LB">LB</option>
                            <?php
                        } else if ($dosen->Status == "Kontrak") {
                            ?>
                            <option value="Kontrak" selected="selected">Kontrak</option>
                            <option value="LB">LB</option>
                            <option value="Tetap">Tetap</option>
                            <?php
                        } else if ($dosen->Status == "LB") {
                            ?>
                            <option value="LB" selected="selected">LB</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Tetap">Tetap</option>
                            <?php
                        } else {
                            ?>
                            <option value="" selected="selected"></option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Tetap">Tetap</option>
                            <option value="LB">LB</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
<div class="form-group">
                <label for="alamat" class="col-md-2" >HOMEBASE</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" readonly id="email"  value="<?php echo $dosen->kd_prodi ?>"  name="kd_prodi" placeholder="Homebase">
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
<script>
function tampilkanPreview(link_foto,idpreview)
{
  var gb = link_foto.files;
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus jpg");
      }
  }
}
</script>