<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DAFTAR  REGISTRASI MAHASISWA TAHUN AJARAN : <?php echo $kd_tahun_ajaran; ?></h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
    
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>BANK </th>
                    <th>NO REGISTRASI </th>
                    <th>TGL REGISTRASI</th>
                    <th>NO REG BANK/TGL REG BANK</th>
                    <th>NIM</th>
                    <th>NAMA MAHASISWA</th>
                    <th>ANGKATAN</th>
                    <th>PRODI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($listdata as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        <td><?php echo $r->bank ?></td>
                        <td><?php echo $r->noreg ?></td>
                        <td><?php echo $r->tgl_reg_bak ?></td>
                        <td><?php echo $r->no_reg_bank . '/' . $r->tgl_reg_bank ?></td>
                        <td><?php echo $r->nim ?></td>
                        <td><?php echo $r->nm_mahasiswa ?></td>
                        <td><?php echo $r->angkatan ?></td>
                        <td><?php echo $r->kd_prodi ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
       <a class="btn btn-primary" href="<?php echo base_url() ?>bak/fsinkron_pembayaran">Sinkron UKT</a>
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