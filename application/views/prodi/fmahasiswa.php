    <style type="text/css">
     .error{
        color: red;
     }
    </style>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM DATA MAHASISWA</h3>
</div >
<div class="panel-body">

<form  action="<?php echo base_url();?>prodi/amahasiswa" id="formMahasiswa" method="post" class="form-user form-horizontal" role="form">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" class="form-control"  id="aksi" value="<?php echo $aksi?>" name="aksi" placeholder="aksi">

   <div class="well"> 
   <hr align="center" size="1" color="#cccccc">
    <div class="form-group">
    <label for="nim" class=" col-md-2" >NIM</label>
    <div class="col-md-10">
        <input type="text" class="required form-control"  id="nim" value="<?php echo $nim?>" name="nim" placeholder="NIM">
    </div>
    </div>
     <div class="form-group">
    <label for="nim" class="col-md-2" >NAMA MAHASISWA</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="nm_mahasiswa" value="<?php echo $nm_mahasiswa?>" placeholder="NAMA MAHASISWA">
    </div>
    </div>
    <div class="form-group">
        <label for="nim" class="col-md-2" >TEMPAT LAHIR</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $tempat_lahir?>" placeholder="TEMPAT LAHIR">
        </div>
              
    </div>

     <div class="form-group">
        <label for="nim" class="col-md-2" >TANGGAL LAHIR</label>
         <div class="col-sm-10">
            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir?>" placeholder="yyyy-mm-dd">
        </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >JENIS KELAMIN</label>
        <div class="col-sm-10">
        <select name="jns_kelamin" class="form-control">
                    <?php
                        if($jns_kelamin=="LAKI-LAKI")
                        {
                            ?>
                            <option value="LAKI-LAKI" selected="selected">LAKI-LAKI</option>
                            <option value="PAREMPUAN">PAREMPUAN</option>
                            <?php
                        }
                        else if($jns_kelamin=="PAREMPUAN")
                        {
                            ?>
                            <option value="PAREMPUAN" selected="selected">PAREMPUAN</option>
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <?php
                        }

                        else
                        {
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
    <label for="nim" class="col-md-2" >Agama</label>

<div class="col-md-10">
			<select name="agama" id="agama" class="form-control">
<option value=''>Pilih</option>
			<?php
	
			foreach($listagama as $agama)
			{
    $selected = '';
    if($agama==$agama->agama)
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
    <label for="nim" class="col-md-2" >PROGRAM STUDI</label>

    <div class="col-sm-10">
        <input type="text" readonly="false" class="form-control" id="kd_prodi" value="<?php echo $kd_prodi?>" placeholder="PROGRAM STUDI">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >TAHUN ANGKATAN</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?php echo $angkatan?>" placeholder="TAHUN ANGKATAN">
    </div>
    </div>
    <div class="form-group">
    <label for="semester" class="col-md-2" >SEMESTER</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="semester" name="semester" value="<?php echo $semester?>" placeholder="TAHUN ANGKATAN">
    </div>
    </div>

    <div class="form-group">
			<label for="jalur_masuk" class="col-md-2" >JALUR MASUK</label>
			<div class="col-md-10">
			<select name="jalur_masuk" id="jalur_masuk" class="form-control"  >
<option value=''>Pilih-</option>
			<?php
	
			foreach($listjalur as $jm)
			{
    $selected = '';
    if($jalur_masuk==$jm->jalur_masuk)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jm->jalur_masuk; ?>" <?php echo $selected; ?>><?php echo $jm->jalur_masuk?></option>

    <?php
    }
?>

</select>

     </div>
</div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >NILAI UKT</label>
        <div class="col-sm-10">
        <input type="text" class="form-control"   id="nilai_ukt" name="nilai_ukt" value="<?php echo $nilai_ukt?>" placeholder="NILAI UKT">
    </div>
    </div>
<div class="form-group">
			<label for="status" class="col-md-2" >STATUS</label>
			<div class="col-md-10">
			<select name="status" id="status" class="form-control"  >
<option valus=''>Pilih</option>
			<?php
	
			foreach($liststatus as $statusi)
			{
    $selected = '';
    if($status==$statusi->kd_status)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $statusi->kd_status; ?>" <?php echo $selected; ?>><?php echo $statusi->status_mhs?></option>

    <?php
    }
?>

</select>

     </div>
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
                        $("#tgl_lahir").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});

                $(function() {
                        $("#tgl_lahir_ayah").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});
                 $(function() {
                        $("#tgl_lahir_ibu").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});
            $('#tmahasiswa').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });

                </script>







