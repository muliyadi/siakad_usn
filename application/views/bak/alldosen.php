<div class="panel panel-primary">
    <div class="panel-heading">
    <h3 class='panel-title'>DATA DOSEN </h3>
     
    </div >
    <div class="panel-body">
        <table id="listdosen" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                     <th>
                        HOME BASE
                    </th>
                  
                    <th>
                        NIK/NIDN
                    </th>
                    <th>
                       NAMA DOSEN
                    </th>
                    <th>
                        TEMPAT/TGL LAHIR
                    </th>
        
                    <th>
                        ALAMAT
                    </th>
                    <th>
                        NO HP
                    </th>
                   
                   
                    <th>
                        STATUS
                    </th>
                    <th>AKSI</th>
                     



                </tr>
            </thead>
            <tbody>
                <?php
                $start = 0;
                if ($listdosen) {
                    foreach ($listdosen as $r) {
                        ?>
                        <tr>
                             <td>
                                <?php echo $r->nm_prodi ?>
                            </td>
                          
                            <td>
                                <?php echo $r->kd_dosen ?>/<?php echo ' '. $r->NIDN ?>
                            </td>

                            <td>
                                <?php echo $r->nm_dosen ?>
                            </td>
                            <td>
                                <?php echo $r->tempat . '/ ' . $r->tgl_lahir ?>
                            </td>
                  

                            <td>
                                <?php echo $r->alamat ?>
                            </td>
                            <td>
                                <?php echo $r->telepon ?>
                            </td>
                           
                           
                            <td>
                                <?php echo $r->Status ?>
                            </td>
                          
                            <td>
                                <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'bak/edosen/' . $r->kd_dosen ?>">Edit</a> 
                            <a class="btn btn-warning btn-xs"href="<?php echo base_url() . 'bak/ddosen/' . $r->kd_dosen ?>" onclick="return confirm('Anda yakin?');">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <a class="btn btn-primary btn-small" href="<?php echo base_url()?>bak/fdosen">Tambah Data</a>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

    $('#listdosen').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });
</script>