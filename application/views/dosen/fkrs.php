<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>RENCANA STUDI MAHASISWA</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url().'dosen/setujui_krsmb/'.$krsh->no_krs?>" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">TAHUN AJARAN</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="kd_tahun_ajaran"  value="<?php echo $krsh->kd_tahun_ajaran?>" name="kd_tahun_ajaran" placeholder="TAHUN AJARAN">
    </div>
    </div>
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">NO KRS</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="no_krs"  value="<?php echo $krsh->no_krs?>" name="no_krs" placeholder="NO KRS">
    </div>
    </div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >MAHASISWA</label>
    <div class="col-md-2">
        <input type="text" class="form-control" id="nim" value="<?php echo $krsh->nim?>" name="nim" placeholder="NIM">
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" id="nm_mahasiswa" value="<?php echo $krsh->nm_mahasiswa?>" name="nm_mahasiswa" placeholder="NAMA MAHASISWA">
    </div>

    <div class="col-md-2">
        <input type="text" class="form-control" id="angkatan" value="<?php echo $krsh->angkatan?>" name="angkatan" placeholder="ANGKATAN">
    </div>
        <div class="col-md-1">
        <input type="text" class="form-control" id="semester" value="<?php echo $krsh->semester?>" name="semester" placeholder="SEMESTER KE">
    </div>
    </div>
    <div class="form-group">
    <label for="ips" class="col-sm-2">IPS[Sebelumnya]</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" id="ips" value="<?php echo $ips?>" name="ips" placeholder="IPS">

    </div>
    <label for="ips" class="col-sm-2">MAKS SKS</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" id="maks_sks" value="<?php echo $maks_sks?>" name="maks_sks" placeholder="IPS">
        
    </div>
    </div>
    <div class="well">
        <h4>Matakuliah yang diprogram</h3>
    <table id="tmahasiswa" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="20">NO</th>
                                            <th>MATAKULIAH</th>
                                             <th>SKS</th>
                                            <th>KURIKULUM</th>
                                            <th>DOSEN</th>
                                            <th>KELAS</th>
                                            <th>RUANG/JADWAL</th>
                  


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        if($krsd)
                                        {
                                             foreach ($krsd as $mtk) {
                                          
                                            ?>
                                            <tr class="pilih" >
                                            <td><?php echo $no++?></td>

                                                <td ><?php echo $mtk->kd_mtk.' | '.$mtk->nm_mtk?></td>
                                                 <td class="sks"><?php echo $mtk->sks?></td>
                                                <td class=""><?php echo $mtk->kd_kurikulum?></td>
                                                    
                                                <td class=""><?php echo $mtk->nm_dosen.' | '.$mtk->kd_dosen; ?></td>
                                                <td class=""><?php echo $mtk->kelas?></td>
                                                <td class=""><?php echo $mtk->kd_ruang.'/'.$mtk->hari.'|'.$mtk->jam ?></td>
                      
                                            </tr>
                                        
                                       
                                            <?php
                                        }
                                        }
                                        ?>
                                    </tbody>
                                </table> 

                                <button id="simpan" class="btn btn-primary">Setujui KRS</button>
    </div>
    
</form>

</div >
</div >
                
                <!--batas akhir modal -->
                
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/angular.js')?>"></script>
                <script src="<?php echo base_url('assets/js/app.js')?>"></script>

                <script type="text/javascript">


            $('#tmahasiswa').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });

                </script>

