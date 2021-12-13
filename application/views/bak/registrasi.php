<!-- Main content -->
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>REGISTRASI MAHASISWA TAHUN AJARAN <?php echo $kd_tahun_ajaran ;?></h3>
</div >
<div class="panel-body">
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<form action="<?php echo base_url();?>Bak/aregistrasi" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
            <table class='table table-bordered'>
                <tr><td>NoReg Bank <?php echo form_error('no_reg_bank') ?></td>
                    <td><input type="text"  id="no_reg_bank" name="no_reg_bank" autofocus="true" value="<?php echo $no_reg_bank; ?>" /> </td>
                <tr><td>Tgl Reg Bank <?php echo form_error('tgl_reg_bank') ?></td>
                    <td><input type="text"  name="tgl_reg_bank" id="tgl_reg_bank" placeholder="Tgl Reg Bank" value="<?php echo $tgl_reg_bank; ?>" /></td>
                <tr><td>NIM <?php echo form_error('nim') ?></td>
                    <td><input type="text" autofocus="true" class="text" name="nim" id="nim" placeholder="Nim" value="<?php echo $nim; ?>" /> <input id="cek" type="button" value="CEK" size="4"></td>
                 <tr><td>NAMA MAHASISWA <?php echo form_error('nm_mahasiswa') ?></td>
                    <td><input readonly="true" type="text" size="40" autofocus="true" name="nm_mahasiswa" id="nm_mahasiswa" placeholder="nm_mahasiswa"  /></input></td>
                 <tr><td>Program Studi <?php echo form_error('prodi') ?></td>
                    <td><input readonly="true" type="text" size="40" autofocus="true" name="prodi" id="prodi" placeholder="Program Studi"  /></input></td>
                    <tr><td>Jumlah UKT <?php echo form_error('ukt') ?></td>
                    <td><input readonly="true" type="text" size="40"  name="ukt" id="ukt" placeholder="UKT" readonly="true" /></input></td>
				<tr><td colspan='2'><button type="submit" id="simpan" class="btn btn-primary">Simpan</button> 
                    <a href="<?php base_url() ?>" class="btn btn-default">Cancel</a></td></tr>
            </table></form>
</div >
</div >



<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
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
        url: "<?php echo base_url().'bak/get_mahasiswa'?>",
        type: 'POST',
        dataType:'json',
        data: form_data,
        success: function(pesan) {
        if(pesan)
        {
        document.getElementById("nm_mahasiswa").value=pesan.nm_mahasiswa;
        document.getElementById("prodi").value=pesan.kd_prodi;
        document.getElementById("ukt").value=pesan.nilai_ukt;
        $('#simpan').focus();
        }else{
        alert('data tidak ada');
        document.getElementById("nm_mahasiswa").value='';
    }
        // alert(pesan.nm_mahasiswa);
         
        }
    });
});

  $(function() {
                        $("#tgl_reg_bank").datepicker({
                            format:"yyyy-mm-dd",
                            todayHightLight:true,    
                            todayBtn:true
                        })});


</script>

                        
 

                        
 