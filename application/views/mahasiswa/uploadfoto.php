<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>UPLOAD FOTO </h3>
       
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
          <form   id="fdosen"action="<?php echo base_url('mahasiswa/uploadfoto'); ?>" method="post"  enctype="multipart/form-data"  class="form-user form-horizontal">
        <div>
            <p>Foto Wajib Formal Berpakaian Kemeja Putih/ atau Jas Almamater USN</p>
        </div>
        <div class="form-group">
            <label for="nim" class="col-sm-2">NIM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly="true" name="nim" value="<?php echo strtoupper($nim); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="pesan" class="col-sm-2">FORMAT *.JPG</label>
            <div class="col-sm-10">
                <input type="file" id="userfile" name="userfile" onchange="tampilkanPreview(this,'preview')" class="form-control">
            </div>
           
        </div>
        <div class="form-group">
            <label for="pesan" class="col-sm-2">Size Maks 120kb</label>
           
            <div class="col-sm-10">
            <img id="preview" width="300px" height="400px" src="<?php echo base_url('doc/foto').'/'.$foto?>" class="img-responsive img-thumbnail" alt="Preview Image">
            </div>
        </div>
        

        <input type="submit" name="upload" value="Upload" class="btn btn-primary">
        <?php echo form_close(); ?>
    </div >
</div >


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script>
    $('#notifications').slideDown('slow').delay(1200).slideUp('slow');
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#fuploadrps").validate();
    });
</script>

<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{
  var gb = userfile.files;
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
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>