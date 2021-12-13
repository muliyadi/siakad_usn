<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM INPUT NILAI MAHASISWA</h3>
</div >
<div class="panel-body">
    <h4>INFORMASI: BUAT JADWAL/KELAS KULIAH TERLEBIH DAHULU</h5>
<form action="<?php echo base_url();?>Prodi/anilai_mhs_ta" method="post" class="form-user form-horizontal" id="fjadwal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	


	<div class="form-group">
    <label for="kd_tahun_ajaran" class="col-md-2" >TAHUN AKADEMIKA</label>
    <div class="col-md-9">
     <select name="kd_tahun_ajaran" id="kd_tahun_ajaran" class="form-control"  >
  
<?php
	
    foreach($listta as $ta)
    {
    
    ?>

    <option value="<?php echo $ta->kd_tahun_ajaran; ?>" ><?php echo $ta->kd_tahun_ajaran?></option>

    <?php
    }
?>

</select>
    </div>
</div>


<div class="form-group">
    <label for="kd_dosen2" class="col-md-2" >Matakuliah</label>
    <div class="col-md-2">
        <input type="text" readonly="true" data-toggle="modal" data-target="#myModalmtk" class="form-control "  id="kd_mtk" name="kd_mtk" placeholder="KODE MATAKULIAH">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true" class="form-control" id="nm_mtk" placeholder="NAMA MATAKULIAH">
    </div>
     <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" id="sks" placeholder="SKS">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari" data-toggle="modal" data-target="#myModalmtk" class="btn btn-small btn-primary" id="cmddosen" placeholder="KODE DOSEN">
    </div>
</div>
<div class="form-group">
    <label for="kd_dosen" class="col-md-2" >KELAS</label>
    <div class="col-md-9">
        <input type="text" class="form-control required" id="kelas" autofocus="true" name="kelas" placeholder="KELAS">
    </div>
</div>
<div class="form-group">
    <label for="kd_prodi" class="col-md-2" >NIM</label>
    <div class="col-md-2">
        <input type="text"  class="form-control required" id="nim" name="nim" autofocus="true" placeholder="NIM">
    </div>
    <div class="col-md-5">
        <input type="text" readonly="true"  class="form-control required" name="nm_mahasiswa" id="nm_mahasiswa" placeholder="NAMA MAHASISWA">
    </div>
	<div class="col-md-2">
        <input type="text" readonly="true" class="form-control required"   id="angkatan" name="angkatan" placeholder="ANGKATAN">
    </div>
    <div class="col-md-1">
        <input type="button" value="Cari"  class="btn btn-small btn-primary" id="cmdmhs" placeholder="">
    </div>
</div>
<div class="form-group">
    <label for="jam" class="col-md-2" >NILAI</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="nilai"  name="nilai" placeholder="NILAI : A, B, C, D, E atau A, AB, B, BC, C, CD, D, E">
    </div>
</div>

<button id="cmdsimpan" class="btn btn-primary">Simpan</button>
</form>
</div >
</div >
                <!-- Modal -->
                <div class="modal fade " id="myModalmtk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        foreach ($listmtk as $r) {
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
                

                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script type="text/javascript">

            $("#lookup").on('click', '.pilih', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("kd_mtk").value = currentRow.find(".tkd_mtk").html();
            document.getElementById("nm_mtk").value = currentRow.find(".tnm_mtk").html();
            document.getElementById("sks").value = currentRow.find(".tsks").html();
            $('#myModalmtk').modal('hide');
            });
                   
            
             $(function() {
                        $("#lookup").dataTable();
                    });

          
                </script>
<script type="text/javascript">
$("#cmdmhs").on('click',function() 
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
        $('#kelas').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
        document.getElementById("angkatan").value='';
        }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

 

</script>                
<script type="text/javascript">
       $(document).ready(function(){
          $("#fjadwal").validate();
       });
    </script>
