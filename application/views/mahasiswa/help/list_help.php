<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>List Help </h6>
    </div >
    <div class="panel-body">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>No Aduan</td>
                    <td>Tanggal Aduan</td>
                    <td>Isi Aduan</td>
                    <th>Tanggal Respon> </th>
                    <td>Isi Respon</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
 
                foreach ($list_help as $r) {
                    ?>
                    <tr>


                        <td>
                            <?php echo $r->no_aduan ?>
                        </td>

                        <td>
                            <?php echo ($r->tgl_aduan) ?>
                        </td>
                        <td>
                            <?php echo $r->isi_aduan ?>
                        </td>
                        <td>
                            <?php echo $r->tgl_respon ?>
                        </td>
                        <td>
                            <?php echo $r->respon ?>
                        </td>
                        <td>
                            <?php echo $r->status ?>
                        </td>
                        


                    </tr>
                         <?php
                        }
                        ?>
            </tbody>

        </table>
        <a href="<?php echo base_url('mahasiswa/input_help')?>" class="btn btn-primary btn-xs">Tambah</a>
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