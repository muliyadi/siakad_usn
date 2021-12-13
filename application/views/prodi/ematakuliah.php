<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>MATAKULIAH</h3>
</div >
<div class="panel-body">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<br>
<form   action="<?php echo base_url();?>prodi/amatakuliah" method="post" class="form-user form-horizontal" id="ematakuliah">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" class="form-control required" readonly="true" required id="kd_mtk_lama"  value="<?php echo $kd_mtk_lama?>" name="kd_mtk_lama" placeholder="FORMAT=MKWN.KODEPRODI.SEMESTER.NOURUT">
    
     <input type="hidden" name="aksi" value="<?php echo $aksi?>"/>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">KURIKULUM</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="kd_kurikulum" id="kd_kurikulum" class="form-control"  >
  
<?php
	
    foreach($listkurikulum as $d)
    {
    $selected = '';
    if($kd_kurikulum==$d->kd_kurikulum)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $d->kd_kurikulum; ?>" <?php echo $selected; ?>><?php echo $d->nm_kurikulum?></option>

    <?php
    }
?>
<option></option>
</select>

          </div>
    </div>
    <div class="form-group">
    <label for="kd_jenis_mtk" class="col-md-2" >GROUP MATAKULIAH</label>
    <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
	<select name="kd_jenis_mtk" id="kd_jenis_mtk" class="form-control required">
<?php
    foreach($listgroupmtk as $d)
    {
    $selected = '';
    if($kd_jenis_mtk==$d->kd_jenis_mtk)
    {
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $d->kd_jenis_mtk; ?>" <?php echo $selected; ?>><?php echo $d->jenis_matakuliah?></option>
    <?php
    }
?>
</select>
          
          </div>
    </div>
	
	<div class="form-group">
    <label for="kd_mtk_lama" class="col-sm-2">KODE MTK LAMA</label>
    <div class="col-sm-10">
        <input type="text" class="form-control required" readonly="true" required id="kd_mtk_lamax"  value="<?php echo $kd_mtk_lamax?>" name="kd_mtk_lamax" placeholder="FORMAT=MKWN.KODEPRODI.SEMESTER.NOURUT">
    </div>
    </div>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">KODE MTK BARU</label>
    <div class="col-sm-10">
        <input type="text" class="form-control " autofocus="true" id="kd_mtk"  value="<?php echo $kd_mtk_lamax?>" name="kd_mtk" placeholder="KODE MATAKULIAH">
    </div>
    </div>
        <div class="form-group">
    <label for="nm_mtk" class="col-sm-2">NAMA MATA KULIAH</label>
    <div class="col-sm-10">
        <input type="text" class="form-control required" id="nm_mtk" value="<?php echo $nm_mtk?>" name="nm_mtk" placeholder="NAMA MATAKULIAH">
    </div>
    </div>
    <div class="form-group">
    <label for="sks" class="col-md-2" >SKS TEORI</label>
    <div class="col-md-10">
        <input type="text" class="form-control required" id="sks_teori" name="sks_teori" value="<?php echo $sks_teori?>" placeholder="SKS TEORI">
    </div>
    </div>
	<div class="form-group">
    <label for="sks_praktikum_lab" class="col-md-2" >SKS PRAKTIKUM LAB</label>
    <div class="col-md-10">
        <input type="text" class="form-control required" id="sks_praktikum_lab" name="sks_praktikum_lab" value="<?php echo $sks_praktikum_lab?>"   placeholder="JUMLAH SKS PRAKTIKUM LAB">
    </div>
    </div>
	<div class="form-group">
    <label for="sks_praktikum_lapangan" class="col-md-2" >SKS PRAKTIKUM LAPANGAN</label>
    <div class="col-md-10">
        <input type="text" class="form-control required" id="sks_praktikum_lapangan" name="sks_praktikum_lapangan" value="<?php echo $sks_praktikum_lapangan?>"   placeholder="JUMLAH SKS PRAKTIKUM LAB">
    </div>
    </div>

	<div class="form-group">
    <label for="semester_ke" class="col-md-2" >SEMESTER KE</label>
    <div class="col-md-10">
        <input type="text" class="form-control required" id="semester_ke" name="semester_ke" value="<?php echo $semester_ke?>"   placeholder="SEMESTER KE">
    </div>
    </div>
	 <div class="form-group">
                <label for="semester" class="col-md-2" >SEMESTER (GANJIL/GENAP)</label>
                <div class="col-sm-10">
                    <select name="semester" class="form-control">
                        <?php
                        if ($semester == "Ganjil") {
                            ?>
                            <option value="Ganjil" selected="selected">GANJIL</option>
                            <option value="Genap">GENAP</option>
                            <?php
                        } else if ($semester == "Genap") {
                            ?>
                            <option value="Genap" selected="selected">GENAP</option>
                            <option value="Ganjil">Ganjil</option>
                            <?php
                        } else {
                            ?>
                            <option value="" selected="selected">Pilih</option>
                            <option value="Ganjil">GANJIL</option>
                            <option value="Genap">GENAP</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
		<div class="form-group">
    <label for="semester" class="col-md-2" >CP Program Studi</label>
    <div class="col-md-10">
       
        <textarea class="form-control" id="cp_prodi" name="cp_prodi" autofocus placeholder="CP Prodi"><?php echo $cp_prodi?></textarea>
    </div>
    </div>
    		<div class="form-group">
    <label for="semester" class="col-md-2" >CP Matakuliah</label>
    <div class="col-md-10">
        
        <textarea class="form-control" id="cp_matakuliah" name="cp_matakuliah" ><?php echo $cp_matakuliah?></textarea>
    </div>
    </div>
    		<div class="form-group">
    <label for="semester" class="col-md-2" >Deskripsi Matakuliah</label>
    <div class="col-md-10">
        
         <textarea class="form-control" id="deskripsi_mk" name="deskripsi_mk"><?php echo $deskripsi_mk?></textarea>
    </div>
    </div>
	<div class="form-group">
    <label for="prasyarat_mk" class="col-md-2" >PRASAYARAT MATAKULIAH 1</label>
    <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->

           
<select name="prasyarat_mk" id="prasyarat_mk" class="form-control"  >
 <option value="" >Pilih</option>
<?php
	
    foreach($listmatakuliah as $d)
    {
    $selected = '';
    if($prasyarat_mk==$d->kd_mtk)
    {
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $d->kd_mtk; ?>" <?php echo $selected; ?>><?php echo $d->nm_mtk?></option>
	
    <?php
    }
?>
<option></option>
</select>
          </div>
    </div>
		<div class="form-group">
    <label for="semester" class="col-md-2" >Nilai Minimal Matakuliah Prasarat 1</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="prasyarat_nilai_mk" name="prasyarat_nilai_mk" value="<?php echo $prasyarat_nilai_mk?>"   placeholder="Prasarat Nilai">
    </div>
    </div>
	<div class="form-group">
    <label for="prasyarat_mk2" class="col-md-2" >PRASAYARAT MATAKULIAH 2</label>
    <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->

           
<select name="prasyarat_mk2" id="prasyarat_mk2" class="form-control"  >
<option value="" >Pilih</option>
<?php
	
    foreach($listmatakuliah as $d)
    {
    $selected = '';
    if($prasyarat_mk2==$d->kd_mtk)
    {
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $d->kd_mtk; ?>" <?php echo $selected; ?>><?php echo $d->nm_mtk?></option>
	
    <?php
    }
?>
<option></option>
</select>
          </div>
    </div>
		<div class="form-group">
    <label for="semester" class="col-md-2" >Nilai Minimal Matakuliah Prasarat 2</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="prasyarat_nilai_mk2" name="prasyarat_nilai_mk2" value="<?php echo $prasyarat_nilai_mk2?>"   placeholder="Prasarat Nilai">
    </div>
    </div>
	
	
<button class="btn btn-primary">Simpan</button>
	</form>

</div >
</div >
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

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
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});
                
                </script>
				<script>   
    $('#notifications').slideDown('slow').delay(30000).slideUp('slow');
</script>
<script type="text/javascript">
       $(document).ready(function(){
          $("#ematakuliah").validate();
       });
    </script>