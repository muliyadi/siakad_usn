<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DAFTAR  REGISTRASI PEMILIH HMPS</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
     
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                        <td>PERIODE</td>
                       <td>NIM</td>
                    <td>STATUS</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($listdata as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        <td><?php echo $r->periode ?></td>
                        <td><?php echo $r->nim ?></td>
                        <td><?php echo $r->status ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="<?php echo base_url() ?>Prodi/freg_pemilih_hmps">Input</a>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

                       $('#test').DataTable({
                           "paging": true,
                           "lengthChange": true,
                           "searching": true,
                           "ordering": true,
                           "info": false,
                           "autoWidth": true
                       });
</script>