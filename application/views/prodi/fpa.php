<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>PENASEHAT AKADEMIK</h3>
</div >
<div class="panel-body">
<form   action="<?php echo base_url();?>Prodi/apa" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
    <input type="hidden" class="form-control" id="aksi" value="<?php echo $aksi?>" name="aksi" placeholder="Aksi">
	<div class="form-group">
    <label for="kd_dosen" class="col-md-2" >DOSEN</label>
    <div class="col-md-2">
        <input type="text" readonly="true" class="form-control" id="kd_dosen" name="kd_dosen" value="<?php echo $kd_dosen?>" placeholder="KODE DOSEN">
    </div>
        <div class="col-sm-8">
        <input type="text" readonly="true" class="form-control" id="nm_dosen" name="nm_dosen" value="<?php echo $nm_dosen?>"   placeholder="NAMA DOSEN">
    </div>

    </div>
    <div class="form-group">
    <label for="nm_dosen" class="col-sm-2">Tahun Angkatan Mahasiswa</label>
    <div class="col-sm-10">
        <input type="text" readonly="true" class="form-control" id="thn_angkatan"  value="<?php echo $thn_angkatan?>" name="thn_angkatan" placeholder="TAHUN ANGKATAN">
    </div>
    </div>
	 <table id="tmahasiswa" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30">NO</th>
                                            <th>NIM</th>
                                            <th>NAMA MAHASISWA</th>
                                            <th>ANGKATAN</th>
                                            <th>STATUS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach ($listmhs as $mhs) {
                                            ?>
                                            <tr>
                                            <td><?php echo $no++?></td>
                                                <td class="tnim"><input type='checkbox' name='mhs[]' value='<?php echo $mhs->nim; ?>'/> <?php echo $mhs->nim; ?>
                                                     
                                                </td>
                                                <td class="tnm_mhs"><?php echo $mhs->nm_mahasiswa; ?></td>
                                                 <td class="tangkatan"><?php echo $mhs->angkatan; ?></td>
                                                <td class="tkd_prodi"><?php echo $mhs->status; ?></td>
                                               
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                                <button id="simpan" data-target="#myModal" data-toggle="modal" class="btn btn-primary">Simpan</button>

 
	


  
	
</form>
</div >
</div >
                
                <!--batas awal  modal -->
               
              
                
                <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/angular.js')?>"></script>
                <script src="<?php echo base_url('assets/js/app.js')?>"></script>

                <script type="text/javascript">



                $(function() {
                        $("#lookup2").dataTable();
                    });



                         $('#tmahasiswa').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                </script>
				