<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>List Matakuliah </h6>
    </div >
    <div class="panel-body">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>NO.</td>
                    <td>KODE KURIKULUM</td>
                    <td>KETEGORI</td>
                    <th>KODE </th>
                    <td>MATA KULIAH</td>
                    <td>SKS TEORI/LAB/LAP</td>
                    <td>TOTAL SKS</td>
                    <td>SEMESTER KE</td>
                    <td>GANJIL/GENAP</td>

                    <td>RPS</td>
                    <td>AKTIF</td>
                    <td>AKSI</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($listmatakuliah as $r) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $start++ ?>
                        </td>
                         <td>
                            <?php echo $r->kd_kurikulum ?>
                        </td>
                        <td>
                            <?php echo $r->kd_jenis_mtk ?>
                        </td>

                        <td>
                           
                            <?php echo substr($r->kd_mtk,strlen($r->kd_kurikulum)+1); ?>
                        </td>
                        <td>
                            <?php echo $r->nm_mtk ?>
                        </td>
                        <td>
                            <?php echo $r->sks_teori . '/' . $r->sks_praktikum_lab . '/' . $r->sks_praktikum_lapangan ?>
                        </td>

                        <td>
                            <?php echo $r->sks ?>
                        </td>
                        <td>
                            <?php echo $r->semester_ke ?>
                        </td>
                        <td>
                            <?php echo $r->semester ?>
                        </td>

                        <?php
                        if ($r->linkrps) {
                            ?>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url() . 'prodi/fuploadrps/' . $r->kd_mtk ?>">Upload</a>
                                <a class="btn btn-info btn-xs" href="<?php echo $r->linkrps ?>">Download</a>
                            </td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url() . 'prodi/fuploadrps/' . $r->kd_mtk ?>">Upload</a>
                                 </td>
                            <?php
                        }
                        ?>
                         <td>
                            <?php echo $r->aktif ?>
                        </td>

                        <td>
                            <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/detailmtk/' . $r->kd_mtk ?>">Detail</a>
                            <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/emtk/' . $r->kd_mtk ?>">Edit</a>
                            <a  class="btn btn-primary btn-xs" href="<?php echo base_url() . 'prodi/dmtk/' . $r->kd_mtk ?>">Delete</a> 
                        </td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
        <a class="btn btn-primary" href="<?php echo base_url() ?>prodi/fmatakuliah">Tambah</a>
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