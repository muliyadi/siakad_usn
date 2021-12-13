<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>KURIKULUM</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>Prodi/akurikulum" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" name="aksi" value="<?php echo $aksi?>">
    <div class="form-group">
    <label for="kd_dosen" class="col-sm-2">KODE KURIKULUM</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="kd_kurikulum"  value="<?php echo $kd_kurikulum?>" name="kd_kurikulum" placeholder="KODE KURIKULUM">
    </div>
    </div>
        <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NAMA KURIKULUM</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nm_kurikulum" value="<?php echo $nm_kurikulum?>" name="nm_kurikulum" placeholder="NAMA KURIKULUM">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >TAHUN AWAL</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="thn_awal" name="thn_awal" value="<?php echo $thn_awal?>" placeholder="TAHUN AWAL">
    </div>
    </div>
	    <div class="form-group">
    <label for="nm_dosen" class="col-md-2" >TAHUN AKHIR</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="thn_akhir" name="thn_akhir" value="<?php echo $thn_akhir?>"   placeholder="TAHUN AKHIR">
    </div>
    </div>
	<div class="form-group">
    <label for="nim" class="col-md-2" >AKTIF</label>
        <div class="col-sm-10">
        <select name="aktif" class="form-control">
                    <?php
                        if($aktif=="Ya")
                        {
                            ?>
                            <option value="Ya" selected="selected">Ya</option>
                            <option value="Tidak">Tidak</option>
                            <?php
                        }
                        else if($aktif=="Tidak")
                        {
                            ?>
                            <option value="Tidak" selected="selected">Tidak</option>
                            <option value="Ya">Ya</option>
                            <?php
                        }

                        else
                        {
                            ?>
                            <option value="-" selected="selected">Pilih -</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
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