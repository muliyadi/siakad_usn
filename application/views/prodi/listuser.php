<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Daftar Dosen</h3>
    </div >
    <div class="panel-body">
        <table id="listdosen" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        User Id
                    </th>

                    <th>
                        Nama 
                    </th>
                    <th>
                        Level
                    </th>
                    <th>
                        Home Base
                    </th>
                    
                    <th>
                        Status
                    </th>
                    <th>
                        Aksi
                    </th>


                </tr>
            </thead>
            <tbody>
                <?php
                $start = 0;
                if ($listuser) {
                    foreach ($listuser as $r) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $r->userid ?>
                            </td>

                            <td>
                                <?php echo $r->nama ?>
                            </td>
                            <td>
                                <?php echo $r->level?>
                            </td>
                            <td>
                                <?php echo $r->home_base ?>
                            </td>

                            <td>
                                <?php echo $r->aktif ?>
                            </td>
                            
                            <td>
                                <a href="<?php echo base_url() . 'prodi/euser/' . $r->userid?>">Edit</a> |
                                <a href="<?php echo base_url() . 'prodi/duser/' . $r->userid ?>">Delete</a> 	
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div><a href="<?php echo base_url() ?>prodi/fdosen" class="btn btn-primary"> Tambah</a></div>
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
        "autoWidth": false
    });
</script>