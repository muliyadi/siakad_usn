<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DATA REGISTRASI MAHASISWA</h3>
    </div >
    <div class="panel-body">
        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
       
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                     <td>TAHUN AKADEMIK</td>
                     <td>JENIS REGISTRASI</td> 
                      <td>NO REGISTRASI </td>
                        <td>TGL REGISTRASI</td>
                    <td>NO REG BANK</td>
                    <td>TGL REG BANK</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($list as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        <td><?php echo $r->kd_tahun_ajaran ?></td>
                        <td><?php echo $r->jns_registrasi ?></td>
                        <td><?php echo $r->noreg ?></td>
                        <td><?php echo $r->tgl_reg_bak ?></td>
                        <td><?php echo $r->no_reg_bank ?></td>
                        <td><?php echo $r->tgl_reg_bank ?></td>
                       
                       

                     
                    </tr>
                    <?php
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

                       $('#test').DataTable({
                           "paging": true,
                           "lengthChange": true,
                           "searching": true,
                           "ordering": true,
                           "info": false,
                           "autoWidth": true
                       });
</script>