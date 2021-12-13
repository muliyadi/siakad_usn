<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Kuisioner</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>pjm/update_edom_soal" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">NO SOAL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="userid" readonly required value="<?php echo $nosoal?>" name="nosoal" placeholder="No Soal">
    </div>
    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">PERNYATAAN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="pertanyaan"   value="<?php echo $pertanyaan?>" name="pertanyaan" placeholder="NAMA USER">
    </div>
    </div>
    	<div class="form-group">
    <label for="kd_mtk" class="col-sm-2">KOMPETENSI</label>
   <div id="combox" class="col-sm-10"> <!-- sebagai indentitas combo box -->
  <?php 
    $list2=array();
    
    foreach($list_kategori as $row)
    {
        $test=$row->nm_kategori;
        $list2[$row->kd_kategori]=$test;
    }
    echo form_dropdown('kd_kategori',$list2,$kd_kategori,"class='form-control  drop_down'");    
    ?>
    
          </div>
    </div>
    
    <button id="simpan" class="btn btn-primary">Simpan</button>

</form>

</div>

</div>
				<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
