<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Pilih Tahun Akademik</h3>
</div >
<div class="panel-body">
    <form   action="<?php echo base_url();?>prodi/lap_registrasi" method="post" class="form-user form-horizontal" id="lap_registrasi">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Tahun Akademik</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
  
  
<?php 
        $list=array();
		foreach($list_ta as $value)
		{
		    $test=$value->kd_tahun_ajaran;
			$list[$value->kd_tahun_ajaran]=$test;
		}
        echo form_dropdown('kd_tahun_ajaran',$list,$kd_ta,"class='form-control  drop'");    
        ?>


          </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Jenis Registrasi</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <?php 
        $list=array();
		foreach($list_jenis_registrasi as $value)
		{
		    $test=$value->nm_registrasi;
			$list[$value->kd_registrasi]=$test;
		}
        echo form_dropdown('jenis_registrasi',$list,$jenis_registrasi,"class='form-control  drop'");    
        ?>
   

          </div>
    </div>
    
    <div class="form-group">
		<label for="angkatan" class="col-sm-2">Tahun Angkatan</label>
		<div class="col-sm-10">
		<?php 
        $list=array();
		foreach($list_angkatan as $value)
		{
		    $test=$value->tahun;
			$list[$value->tahun]=$test;
		}
        echo form_dropdown('angkatan',$list,'',"class='form-control  angkatan'");    
        ?>
        </div>
	</div>
					


    
    
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Status</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
   <select name="status" id="status" class="form-control"  >

    <option value="Sudah">Sudah</option>
        <option value="Belum">Belum</option>

    

</select>

          </div>
    </div>
    
<button type="submit">Pilih</button>
</form>
</div>
</div>