<form action="<?php echo base_url();?>Prodi/unilai_ujian" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>FORM NILAI UJIAN</h3>
</div >
<div class="panel-body">
         <div class="form-group">
                    <label for="nim" class="col-md-2" >JENIS UJIAN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_ujian" name="jenis_ujian" value="<?php echo $pendaftar->jenis_ujian ?>" readonly=true placeholder="NO DAFTAR">
                    </div>
                    
                </div>
     <div class="form-group">
                    <label for="nim" class="col-md-2" >NO DAFTAR</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_daftar" name="no_daftar" value="<?php echo $pendaftar->no_daftar ?>" readonly=true placeholder="NO DAFTAR">
                    </div>
                    
                </div>
<div class="form-group">
                    <label for="nim" class="col-md-2" >TGL DAFTAR</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_daftar" name="tgl_daftar" value="<?php echo $pendaftar->tgl_daftar ?>" readonly=true placeholder="NO DAFTAR">
                    </div>
</div>
<div class="form-group">
                    <label for="nim" class="col-md-2" >TGL UJIAN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_ujian" name="tgl_ujian" value="<?php echo $pendaftar->tgl_ujian ?>" readonly=true placeholder="NO DAFTAR">
                    </div>
</div>
<div class="form-group">
                    <label for="nim" class="col-md-2" >NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $pendaftar->nim ?>" readonly=true placeholder="NO DAFTAR">
                    </div>
</div>
<div class="form-group">
                    <label for="nim" class="col-md-2" >NAMA</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_mahasiswa" readonly=true name="nm_mahasiswa" value="<?php echo $pendaftar->nm_mahasiswa ?>" placeholder="NO DAFTAR">
                    </div>
</div>
<div class="form-group">
                    <label for="nim" class="col-md-2" >JUDUL</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $pendaftar->judul ?>" placeholder="NO DAFTAR">
                    </div>
</div>
<div class="form-group">
<label for="tgl_ujian" class="col-md-2">NILAI</label>
<div class="col-md-10">
<select name="nilai" id="nilai" class="form-control">
<?php

    foreach($lnilai as $d)
    {
    $selected = '';
    if($d->huruf==$pendaftar->nilai)
    {
        $selected = 'selected="selected"';
    }
   
        
            
    ?>

    <option value="<?php echo $d->huruf; ?>" <?php echo $selected; ?>><?php echo $d->huruf?></option>
    <?php
    }
    ?>
</select>
</div>

</div>
<div class="form-group">
<label for="lulus" class="col-md-2">LULUS</label>
<div class="col-md-10">
<select name="lulus" id="lulus" class="form-control">
                            <?php
                            if ($pendaftar->lulus=="Y") {
                                ?>
                                <option value="Y" selected="selected">Ya</option>
                                <option value="T">Tidak</option>
                                <?php
                            } else if ($pendaftar->lulus=="T") {
                                ?>
                                <option value="T" selected="selected">Tidak</option>
                                <option value="Y">Ya</option>
                                <?php
                            } else {
                                ?>
                                
                                <option value="Y">Ya</option>
                                <option value="T">Tidak</option>
                                <?php
                            }
                            ?>
                        </select>
</div>

</div>
<button id="cmdsimpan" class="btn btn-primary">Simpan</button>
</div>
</div>

</form>