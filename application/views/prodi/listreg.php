<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DAFTAR  REGISTRASI MAHASISWA TAHUN AJARAN : <?php echo $kd_tahun_ajaran; ?></h3>
    </div >
    <div class="panel-body">
      
        Jadwal Registrasi : <?php echo $status_jspp ?>
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                      <td>NO REGISTRASI </td>
                        <td>TGL REGISTRASI</td>
                    <td>NO REG BANK/TGL REG BANK</td>
                    <td>NIM</td>
                    <td>NAMA MAHASISWA</td>
                    <td>ANGKATAN</td>
                   
                   
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
                       

                       
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
       <a class="btn btn-primary btn-sm" href="<?php echo base_url('prodi/fsinkron_pembayaran') ?>">Update Data SIDU</a>
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