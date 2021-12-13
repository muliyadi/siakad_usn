<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DAFTAR SEKOLAH</h3>
    </div>
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>

        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <td>BENTUK</td>
                    <td>NPSN </td>
                    <td>NAMA SEKOLAH</td>
                    <td>KECAMATAN</td>
                    <td>KABUPATEN</td>
                    <td>PROPINSI</td>
                    <td>AKSI</td>


                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($list_sekolah as $r) {
                    ?>
                <tr>
                    <td><?php echo $start++ ?></td>
                    <td><?php echo $r->bentuk ?></td>
                    <td><?php echo $r->npsn ?></td>
                    <td><?php echo $r->nm_sekolah ?></td>
                    <td><?php echo $r->nm_kecamatan ?></td>
                    <td><?php echo $r->nm_kabupaten ?></td>
                    <td><?php echo $r->nm_propinsi ?></td>
                    <td></td>



                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!--  <a class="btn btn-primary" href="<?php echo base_url() ?>Prodi/input_sekolah">Tambah</a> -->
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">
$('#table').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": true
});
</script>