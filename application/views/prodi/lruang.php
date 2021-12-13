<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>List Ruang Kuliah </h6>
    </div >
    <div class="panel-body">
        <div class="table table-responsive">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>NO.</td>
                    <td>KODE RUANG</td>
                    <td>NAMA RUANGAN</td>
                    <th>KAPASITAS </th>
                    <td>FASILITAS</td>
                    <td>AKSI</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($list_ruang as $r) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $start++ ?>
                        </td>
                         <td>
                            <?php echo $r->kd_ruang ?>
                        </td>
                        <td>
                            <?php echo $r->nm_ruang ?>
                        </td>

                        <td>
                            <?php echo $r->kap_maksimal ?>
                        </td>
                       
                        <td>
                            <?php echo $r->fasilitas ?>
                        </td>

                        

                        <td>

                            <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/eruang/' . $r->kd_ruang ?>">Edit</a>
                            <a  class="btn btn-primary btn-xs" href="<?php echo base_url() . 'prodi/druang/' . $r->kd_ruang ?>">Delete</a> 
                        </td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
        </div>
        <a class="btn btn-primary" href="<?php echo base_url() ?>prodi/iruang">Tambah</a>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

    $('#test').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true

    });
</script>