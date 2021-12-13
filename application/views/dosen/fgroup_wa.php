<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Form Group WA </h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url().'dosen/create_group_wa_kelas'?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">KODE JADWAL</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="kd_jadwal"  value="<?php echo $kd_jadwal?>" name="kd_jadwal" placeholder="TAHUN AJARAN">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_mtk" class="col-sm-2">Link Group WA</label>
   <div id="group_wa" class="col-sm-10"> <!-- sebagai indentitas combo box -->
    <input type="text" name="group_wa" class="form-control" autofocus="true" placeholder="Ketik/Tempel Link Group WA Kelas Matakuliah disini" >

  </div>
    </div>
    <button id="simpan" class="btn btn-primary">Share</button>

</form>

</div >
</div >
                
                <!--batas akhir modal -->
                
              
                
                
                
               

