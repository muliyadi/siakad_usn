<form action="<?php echo base_url();?>Prodi/nilai_ujian" method="post" class="form-user form-horizontal" id="fset_pembimbing">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>HASIL UJIAN</h3>
</div >
<div class="panel-body">
     <div class="form-group">
                    <label for="nim" class="col-md-2" >NO HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_daftar" name="no_daftar" value="<?php echo $pendaftar->no_daftar ?>" placeholder="No HP">
                    </div>
                </div>
<div class="form-group">
<label for="tgl_ujian" class="col-md-2">NILAI</label>
<div class="col-md-9">
<select name="nilai" id="nilai">
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
<div class="col-md-9">
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
</div>
</div>

</form>