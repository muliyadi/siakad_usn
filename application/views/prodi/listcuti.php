<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DATA  MAHASISWA CUTI TAHUN AJARAN : <?php echo $kd_tahun_ajaran; ?></h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        Jadwal Registrasi : <?php echo $status_jspp ?>
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                    <td>NO REG CUTI </td>
                        <td>TGL REG CUTI</td>
                    <td>NO REG BAAK/TGL REG BAAK</td>
                    <td>NIM</td>
                    <td>NAMA MAHASISWA</td>
                    <td>ANGKATAN</td>
                    <td>PRODI</td>
                    <td>AKSI</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($listdata as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        <td><?php echo $r->noreg ?></td>
                        <td><?php echo $r->tgl_reg_bak ?></td>
                        <td><?php echo $r->no_reg_bank . '/' . $r->tgl_reg_bank ?></td>
                        <td><?php echo $r->nim ?></td>
                        <td><?php echo $r->nm_mahasiswa ?></td>
                        <td><?php echo $r->angkatan ?></td>
                        <td><?php echo $r->kd_prodi ?></td>
                        <td><a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/ereg/' . $r->noreg ?>">Edit</a> 
                        <a class="btn btn-primary btn-xs"href="<?php echo base_url() . 'prodi/dreg/' . $r->noreg ?>" onclick="return confirm('Anda yakin?');">Delete</a> </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="<?php echo base_url() ?>Prodi/fcuti">Tambah</a>
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