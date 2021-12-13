<div class="panel panel-primary">
    <div class="panel-heading">
    <h3 class='panel-title'>Daftar Dosen</h3>
    </div >
    <div class="panel-body">
        <table id="listdosen" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        KODE/NIDN
                    </th>

                    <th>
                        Nama Dosen 
                    </th>
                    <th>
                        Jafung 
                    </th>
                    <th>
                        Tempat/Tgl Lahir
                    </th>
                    <th>
                        Jenis Kelamin
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        No Telp/HP
                    </th>
                    <th>
                        Email
                    </th>
                  
                    <th>
                        Status
                    </th>
                     



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
                    <img src="<?php echo $r->link_foto?>" width="60" height="80" "></td>
                            <td>
                                <?php echo $r->kd_dosen ?>/<?php echo $r->NIDN ?>
                            </td>

                            <td>
                                <?php echo $r->nm_dosen ?>
                            </td>
                            <td>
                                <?php echo $r->jafung ?>
                            </td>
                            <td>
                                <?php echo $r->tempat . '/' . $r->tgl_lahir ?>
                            </td>
                            <td>
                                <?php echo $r->jns_kelamin ?>
                            </td>

                            <td>
                                <?php echo $r->alamat ?>
                            </td>
                            <td>
                                <?php echo $r->telepon ?>
                            </td>
                            <td>
                                <?php echo $r->email ?>
                            </td>
                            
                            <td>
                                <?php echo $r->Status ?>
                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
      
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

    $('#listdosen').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });
</script>