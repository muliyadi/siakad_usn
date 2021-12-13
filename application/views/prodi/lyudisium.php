<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>DAFTAR MAHASISWA YUDISIUM TAHUN AJARAN : <?php echo $kd_tahun_ajaran; ?></h3>
    </div >
    <div class="panel-body">
      
     
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                      <td>NO DAFTAR </td>
                        <td>TGL DAFTAR</td>
                    <td>NIM</td>
                    <td>NAMA MAHASISWA</td>
                    <td>ANGKATAN</td>
                    <td>JUDUL</td>
                    <td>NILAI</td>
                    <td>IPK</td>
                    <td>STATUS</td>
                    <td>AKSI</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($list as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        <td><?php echo $r->no_daftar ?></td>
                        <td><?php echo $r->tgl_daftar ?></td>
                        <td><?php echo $r->nim ?></td>
                        <td><?php echo $r->nm_mahasiswa ?></td>
                        <td><?php echo $r->angkatan ?></td>
                        <td><?php echo $r->judul ?></td>
                        <td><?php echo $r->nilai ?></td>
                        <td><?php echo $r->ipk ?></td>
                        <td><?php echo $r->status ?></td>
                        <td><a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/eyudisium/' . $r->no_daftar ?>">Edit</a> 
                            <a class="btn btn-primary btn-xs"href="<?php echo base_url() . 'prodi/dyudisium/' . $r->no_daftar ?>" onclick="return confirm('Anda yakin?');">Delete</a> </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="<?php echo base_url() ?>Prodi/fyudisium">Tambah</a>
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