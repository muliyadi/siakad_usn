<style type="text/css">
    .error{
        color: red;
    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>EDIT DATA MAHASISWA</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
   <form   action="<?php echo base_url();?>umhs" method="post" class="form-user form-horizontal" id="fmahasiswa" onsubmit="return validasi_input(this)">

            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>

            <div class="well col-md-12">
               
                <h4 >DATA PRIBADI</h4>
                <hr align="center" size="1" color="#cccccc">
                <div class="form-group">
                    <label for="nim" class=" col-md-2" >NIM <font color="red"> (*)</font></label>
                    <div class="col-md-10">
                        <input type="text" class="required form-control" readonly="true" id="nim" value="<?php echo $mhs->nim ?>" name="nim" placeholder="NIM">

                    </div>

                </div>
                <div class="form-group">
                    <label for="nim" class=" col-md-2" >Nomor Induk Kependudukan  <font color="red"> (*)</font></label>
                    <div class="col-md-10">
                        <input type="text" class="required form-control"  id="nik" value="<?php echo $mhs->NIK ?>" name="nik" placeholder="NIK">

                    </div>

                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >NAMA MAHASISWA <font color="red"> (*)</font> <BR> Sesuai Nama di Ijazah</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nm_mahasiswa" id="nm_mahasiswa" value="<?php echo $mhs->nm_mahasiswa ?>" placeholder="NAMA MAHASISWA">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >TEMPAT LAHIR <font color="red"> (*)</font><br>
                    Sesuai Tempat Lahir di Ijazah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control required" id="tempat_lahir" name="tempat_lahir" value="<?php echo $mhs->tempat_lahir ?>" placeholder="TEMPAT LAHIR">
                    </div>

                </div>

                <div class="form-group">
                    <label for="nim" class="col-md-2" >TANGGAL LAHIR <font color="red"> (*)</font> <br>
                    Sesuai Tanggal Lahir di Ijazah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $mhs->tgl_lahir ?>" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >JENIS KELAMIN <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <select name="jns_kelamin" class="form-control">
                            <?php
                            if ($mhs->jns_kelamin=="L") {
                                ?>
                                <option value="L" selected="selected">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                                <?php
                            } else if ($mhs->jns_kelamin=="P") {
                                ?>
                                <option value="P" selected="selected">Perempuan</option>
                                <option value="L">Laki-Laki</option>
                                <?php
                            } else {
                                ?>
                                
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
               <div class="form-group">
			<label for="agama" class="col-md-2" >AGAMA <font color="red"> (*)</font></label>
			<div class="col-md-10">
			<select name="agama" id="agama" class="form-control">
<option value='1'>Islam</option>
			<?php
			foreach($listagama as $agama)
			{
    $selected = '';
    if($mhs->agama==$agama->id)
    {
        $selected = 'selected="selected"';
    }
    ?>
    <option value="<?php echo $agama->id; ?>" <?php echo $selected; ?>><?php echo $agama->agama?></option>

    <?php
    }
?>

</select>

     </div>
</div>
<div class="form-group">
			<label for="agama" class="col-md-2" >KEWARGANEGARAAN <font color="red"> (*)</font></label>
			<div class="col-md-10">
			<select name="negara" id="negara" class="form-control">
<option value='ID'>Indonesia</option>
			<?php
	
			foreach($listnegara as $negara)
			{
    $selected = '';
    if($mhs->kewarganegaraan==$negara->id)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $negara->id; ?>" <?php echo $selected; ?>><?php echo $negara->nm_negara?></option>

    <?php
    }
?>

</select>

     </div>
</div>
<div class="form-group">
<label for="provinsi" class="col-md-2" >Kecamatan <font color="red"> (*)</font></label>
<div class="col-md-5">
<input type="text" class="form-control" id="id_wilayah_kec" readonly name="id_wilayah_kec" value="<?php echo $mhs->id_wilayah_kec ?>" placeholder="ID Kecamatan">

    </div>
            <div class="col-md-2">
    <a href='#myModalKecamatan' class='btn btn-info btn-small'  data-toggle='modal' >Cari</a>
    </div>
    </div>

<div class="form-group">
<label for="nim" class="col-md-2" >Kelurahan (*)</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="kelurahan" name="kelurahan" value="<?php echo $mhs->kelurahan ?>" placeholder="Kelurahan">
</div>
</div>
<div class="form-group">
<label for="nim" class="col-md-2" >Dusun  (+)</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="dusun" name="dusun" value="<?php echo $mhs->dusun ?>" placeholder="Dusun">
</div>
</div>
<div class="form-group">
<label for="nim" class="col-md-2" >RW / RT  (+)</label>
<div class="col-sm-5">
<input type="text" class="form-control" id="rw" name="rw" value="<?php echo $mhs->rw ?>" placeholder="RW">
</div>
<div class="col-sm-5">
<input type="text" class="form-control" id="rt" name="rt" value="<?php echo $mhs->rt ?>" placeholder="RT">
</div>
</div>
<div class="form-group">
<label for="nim" class="col-md-2" >Jalan (+)</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="jalan" name="jalan" value="<?php echo $mhs->jalan ?>" placeholder="Alamat">
</div>
</div>
<div class="form-group">
<label for="nim" class="col-md-2" >JENIS TINGGAL <font color="red"> (*)</font></label>
<div class="col-sm-10">
<select name="kd_jenis_tinggal" id="kd_jenis_tinggal" class="form-control"  >
<?php
foreach($listjenis_tinggal as $jt)
{
    $selected = '';
    if($mhs->kd_jenis_tinggal==$jt->kd_jenis_tinggal)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jt->kd_jenis_tinggal; ?>" <?php echo $selected; ?>><?php echo $jt->nm_jenis_tinggal?></option>

    <?php
    }
?>

</select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nim" class="col-md-2" >Telp Rumah(+)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telp_rumah" name="telp_rumah" value="<?php echo $mhs->telp_rumah ?>" placeholder="telp_rumah">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nim" class="col-md-2" >NO HP <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $mhs->no_hp ?>" placeholder="No HP">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nim" class="col-md-2" >EMAIL <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $mhs->email ?>" placeholder="email">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="pend_ayah" class="col-md-2" >Jenis Pembiayaan <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                       	<select name="jns_pembiayaan" id="jns_pembiayaan" class="form-control"  >
<option value=''>Pilih</option>
			<?php
	
			foreach($listjns_pembiayaan as $jns_pembiayaan)
			{
    $selected = '';
    if($mhs->jns_pembiayaan ==$jns_pembiayaan->id_jns_pembiayaan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jns_pembiayaan->id_jns_pembiayaan; ?>" <?php echo $selected; ?>><?php echo $jns_pembiayaan->jenis_pembiayaan?></option>

    <?php
    }
?>

</select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >Terima KPS (+)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="terima_kps" name="terima_kps" value="<?php echo $mhs->terima_kps ?>" placeholder="Terima KPS [0 = Tidak, 1 = Ya]">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >No KPS (+)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_kps" name="no_kps" value="<?php echo $mhs->no_kps ?>" placeholder="Kosongkan saja jika tidak terima">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >PROGRAM STUDI <font color="red"> (*)</font></label>

                    <div class="col-sm-10">
                        <input type="text" readonly="false" class="form-control" id="kd_prodi" value="<?php echo $mhs->kd_prodi ?>" placeholder="NAMA PROGRAM STUDI">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >TAHUN ANGKATAN  <font color="red"> (*)</font></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="angkatan" name="angkatan" readonly="false" value="<?php echo $mhs->angkatan ?>" placeholder="TAHUN ANGKATAN">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >SEMESTER KE <font color="red"> (*)</font></label>
                    <div class="col-sm-2">
                        <input type="text"  class="form-control"  id="semester" name="semester" value="<?php echo $mhs->semester ?>" placeholder="semester">
                    </div>
                </div>
               
			<div class="form-group">
			<label for="jalur_masuk" class="col-md-2" >JALUR MASUK <font color="red"> (*)</font></label>
			<div class="col-md-10">
			<select name="jalur_masuk" id="jalur_masuk" class="form-control"  >
<option valus="pilih">Pilih</option>
			<?php
	
			foreach($listjalur as $jm)
			{
    $selected = '';
    if($mhs->jalur_masuk==$jm->id_jalur_masuk)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $jm->id_jalur_masuk; ?>" <?php echo $selected; ?>><?php echo $jm->jalur_masuk?></option>

    <?php
    }
?>

</select>

     </div>
</div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >NILAI UKT <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly="true" id="nilai_ukt" name="nilai_ukt" value="<?php echo $mhs->nilai_ukt ?>" placeholder="NILAI UKT">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >STATUS <font color="red"> (*)</font></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="status" readonly="true" name="status" value="<?php echo $mhs->status ?>" placeholder="STATUS">
                    </div>
                </div>

               

            </div>


            <div class="well"> 
                <h4 >DATA PENDIDIKAN SMA/SEDERAJAT</h4>
                <hr align="center" size="1" color="#cccccc">
                
                <div class="form-group">
    <label for="kapasitas" class="col-md-2" >NPSN <font color="red"> (*)</font></label>
    <div class="col-md-3">
        <input type="text" class="form-control" id="npsnx"  value="<?php echo $mhs->npsn?>" name="npsnx" placeholder="NPSN:Nomor Pokok Sekolah Nasional">
    </div>
    
     <div class="col-md-2">
    <a href='#myModal' class='btn btn-info btn-small'  data-toggle='modal' >Cari</a>
    </div>
</div>

                

     
                
                <div class="form-group">
                    <label for="nim" class="col-md-2" >NO INDUK SISWA NASIONAL <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="nisn" id="nisn" value="<?php echo $mhs->nisn ?>" placeholder="NIS">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >JURUSAN (IPA, IPS, BAHASA, LAIN)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jurusan_sma" name="jurusan_sma" value="<?php echo $mhs->jurusan_sma ?>" placeholder="JURUSAN">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="thn_tamat" class="col-md-2" >TAHUN LULUS <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="thn_tamat_sma" id="thn_tamat_sma" value="<?php echo $mhs->thn_tamat_sma ?>" placeholder="TAHUN LULUS">
                    </div>
                </div>
             
            </div>
    <div class="well"> 
                <h4 >DATA KELUARGA</h4>
                <hr align="center" size="1" color="#cccccc">
                <div class="form-group">
                    <label for="nim" class="col-md-2" >NO KK (+)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="no_kk" id="no_kk" value="<?php echo $mhs->no_kk ?>" placeholder="NO KK">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >NAMA AYAH (+)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_ayah" name="nm_ayah" value="<?php echo $mhs->nm_ayah ?>" placeholder="NAMA AYAH">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nim" class="col-md-2" >TGL LAHIR AYAH</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_lahir_ayah" name="tgl_lahir_ayah" value="<?php echo $mhs->tgl_lahir_ayah ?>" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pend_ayah" class="col-md-2" >PENDIDIKAN AYAH <font color="red"> (*)</font></label>
                    <div class="col-sm-10">
                       	<select name="pend_ayah" id="pend_ayah" class="form-control"  >

			<?php
	
			foreach($listjenjang_pendidikan as $row)
			{
    $selected = '';
    if($mhs->pend_ayah==$row->kd_jenjang_pendidikan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $row->kd_jenjang_pendidikan; ?>" <?php echo $selected; ?>><?php echo $row->jenjang_pendidikan?></option>

    <?php
    }
?>

</select>
                    </div>
                </div>
			<div class="form-group">
			<label for="penghasilan_ayah" class="col-md-2" >PENGHASILAN AYAH <font color="red"> (*)</font></label>
			<div class="col-md-10">
			<select name="penghasilan_ayah" id="penghasilan_ayah" class="form-control"  >

			<?php
	
			foreach($listpengortu as $row)
			{
    $selected = '';
    if($mhs->penghasilan_ayah==$row->kd_gol_penghasilan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $row->kd_gol_penghasilan; ?>" <?php echo $selected; ?>><?php echo $row->penghasilan?></option>

    <?php
    }
?>

</select>

     </div>
</div>
                <div class="form-group">
                    <label for="nm_ibu" class="col-md-2" >NAMA IBU <font color="red"> (*)</font></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="nm_ibu" name="nm_ibu" value="<?php echo $mhs->nm_ibu ?>" placeholder="NAMA IBU">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir_ibu" class="col-md-2" >TGL LAHIR IBU <font color="red"> (*)</font></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="tgl_lahir_ibu" name="tgl_lahir_ibu" value="<?php echo $mhs->tgl_lahir_ibu ?>" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pend_ibu" class="col-md-2" >PENDIDIKAN IBU <font color="red"> (*)</font></label>
                    <div class="col-md-10">
    <select name="pend_ibu" id="pend_ibu" class="form-control"  >
<option value=''>Pilih</option>
			<?php
	
			foreach($listjenjang_pendidikan as $row)
			{
    $selected = '';
    if($mhs->pend_ibu==$row->kd_jenjang_pendidikan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $row->kd_jenjang_pendidikan; ?>" <?php echo $selected; ?>><?php echo $row->jenjang_pendidikan?></option>

    <?php
    }
?>

</select>
            </div>
                </div>
            <div class="form-group">
			<label for="penghasilan_ibu" class="col-md-2" >PENGHASILAN IBU <font color="red"> (*)</font></label>
			<div class="col-md-10">
			<select name="penghasilan_ibu" id="penghasilan_ibu" class="form-control"  >

			<?php
	
			foreach($listpengortu as $rows)
			{
    $selected = '';
    if($mhs->penghasilan_ibu==$rows->kd_gol_penghasilan)
    {
        $selected = 'selected="selected"';
    }
    ?>

    <option value="<?php echo $rows->kd_gol_penghasilan; ?>" <?php echo $selected; ?>><?php echo $rows->penghasilan?></option>

    <?php
    }
?>

</select>

     </div>
</div>
            </div>




            <button class="btn btn-primary" id="submit">Simpan</button>


        <?php echo form_close();?>
    </div>
</div >
</div >


<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Pencarian Data Sekolah</h4>
                </div>
                <div class="modal-body">
                    <input type="text"  id='cari_sekolah'><button id="tombol_cari" class="btn btn-info btn-xs" >Cari</button> Ketik NPSN, Nama Sekolah, Alamat,Kecamatan
                    
                
            <table class="table table-bordered table-hover table-striped" id="tblsekolah">
            <thead>
                <tr>
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    <th>Kecamatan</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody id="show_data">
                 
            </tbody>
        </table>
                     <p>Tidak ketemu cari disini Nomor Pokok Sekolah Nasional (NPSN):<br>
                     Kemendikbud:<a href="http://dapo.dikdasmen.kemdikbud.go.id/pencarian">Cari NPSN</a><br>
                     Kemenag:<a href="http://emispendis.kemenag.go.id/emis2016v1/">Cari NPSN</a><br></p>   
                    </div>
                    
                </div>
                
            </div>
        </div>
<div class="modal fade" id="myModalKecamatan" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Pencarian Data Kecamatan</h4>
                </div>
                <div class="modal-body">
                    <input type="text"  id='text_cari_kecamatan'><button id="tombol_cari_kecamatan" class="btn btn-info btn-xs" >Cari</button> Ketik Nama Kecamatan atau Kabupaten
                    
                
            <table class="table table-bordered table-hover table-striped" id="tblkecmatan">
            <thead>
                <tr>
                    <th>ID Kecamatan</th>
                    <th> Kecamatan</th>
                    <th> Kabupaten</th>
                    <th>Pilih</th>
                </tr>
            </thead>
            <tbody id="show_data_kecamatan">
                 
            </tbody>
        </table>
                    
                    </div>
                    
                </div>
                
            </div>
        </div>






<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>

<script type="text/javascript">
    $(function() {
        $("#tgl_lahir").datepicker({
            format: "yyyy-mm-dd",
            todayHightLight: true,
            todayBtn: true
        })
    });

    $(function() {
        $("#tgl_lahir_ayah").datepicker({
            format: "yyyy-mm-dd",
            todayHightLight: true,
            todayBtn: true
        })
    });
    $(function() {
        $("#tgl_lahir_ibu").datepicker({
            format: "yyyy-mm-dd",
            todayHightLight: true,
            todayBtn: true
        })
    });
    

</script>
<script type="text/javascript">
function validasi_input(form){
 if (form.jalur_masuk.value=="pilih"){
    alert("Anda belum memilih jalur masuk!");
     form.jalur_masuk.focus();
    return (false);
 }
return (true);
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tombol_cari_kecamatan').click(function(){
            var id=$('#text_cari_kecamatan').val();
        var form_data = {
        id: id,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
            $.ajax({
                url: "<?php echo base_url().'mahasiswa/get_kec_by_name'?>",
                method : "POST",
                data : form_data,
                async : false,
                dataType : 'json',
                success: function(data){
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td class="tkd_kec">'+data[i].kd_kec+'</td>'+
                                '<td class="tnm_kecamatan">'+data[i].nm_kecamatan+'</td>'+
                                 '<td class="tnm_kecamatan">'+data[i].nm_kabupaten+'</td>'+
                               '<td><button class="pilihkecamatan">Pilih</button></td>'+
                                '</tr>';
                    }
                    $('#show_data_kecamatan').html(html);
                    
                }
            });
        });
    });
   
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tombol_cari').click(function(){
            var id=$('#cari_sekolah').val();
        var form_data = {
        id: id,
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
        ajax: '1'
        };
            $.ajax({
                url: "<?php echo base_url().'mahasiswa/get_sekolah_by_name'?>",
                method : "POST",
                data : form_data,
                async : false,
                dataType : 'json',
                success: function(data){
                    
                var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td class="tnpsn">'+data[i].npsn+'</td>'+
                                '<td class="tnm_sekolah">'+data[i].nm_sekolah+'</td>'+
                                '<td class="tkecamatan">'+data[i].nm_kecamatan+'</td>'+
                                '<td><button class="pilih3">Pilih</button></td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                    
                }
            });
        });
    });
   
</script>
<script type="text/javascript">
     $("#tblsekolah").on('click', '.pilih3', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("npsnx").value = currentRow.find(".tnpsn").html();
              $('#myModal').modal('hide');
            });
            
          
       
</script>
<script type="text/javascript">
    function validasi_input(form){
  var mincar = 16;
  if (form.nik.value.length < mincar){
    alert("Panjang NIK harusnya 16 Digit!");
    form.nik.focus();
    return (false);
  }
   return (true);
}
</script>

<script type="text/javascript">
function validasi_input(form){
  pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  if (!pola_email.test(form.email.value)){
    alert ('Penulisan Email tidak benar');
    form.email.focus();
    return false;
  }
  return (true);
}
</script>
<script type="text/javascript">
     $("#tblkecmatan").on('click', '.pilihkecamatan', function(e) {
            var currentRow = $(this).closest("tr");
            document.getElementById("id_wilayah_kec").value = currentRow.find(".tkd_kec").html();
             
                      $('#myModalKecamatan').modal('hide');
            });
            
$(document).ready(function() {
    $('#nik').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
     $('#rt').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
     $('#rw').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
     $('#no_hp').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
    $('#npsnx').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
        $('#semester').keyup(function () {  
      // setiap karakter yang diketik akan langsung dihapus   
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
     
   
    
});


	
$(document).ready(function() {

	   $('#submit').click(function() {

	        var sEmail = $('#email').val();

	        if ($.trim(sEmail).length == 0) {

	            alert('Please enter valid email address');

	            e.preventDefault();

	        }

	        if (validateEmail(sEmail)) {

	           

	        }

	        else {

	            alert('Perbaiki Email Anda');

	        }

	    });

	});
</script>


            
            