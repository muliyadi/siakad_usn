<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>Daftar Matakuliah </h6>
    </div >
    <div class="panel-body">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>NO.</td>
                    <td>KETEGORI</td>
                    <th>KODE </th>
                    <td>MATA KULIAH</td>
                    <td>SKS TEORI</td>
                    <td>SKS LAB.	</td>
                    <td>SKS LAP.</td>
                    <td>TOTAL SKS</td>
                    <td>SEMESTER</td>

                    <td>SYARAT MTK1/NILAI</td>
                    <td>SYARAT MTK2/NILAI</td>

                    <td>RPS</td>

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
                            <?php echo $r->kd_jenis_mtk ?>
                        </td>

                        <td>
                            <?php echo substr($r->kd_mtk, 4) ?>
                        </td>
                        <td>
                            <?php echo $r->nm_mtk ?>
                        </td>
                        <td>
                            <?php echo $r->sks_teori ?>
                        </td>
                        <td>
                            <?php echo $r->sks_praktikum_lab ?>
                        </td>
                        <td>
                            <?php echo $r->sks_praktikum_lapangan ?>
                        </td>
                        <td>
                            <?php echo $r->sks ?>
                        </td>
                        <td>
                            <?php echo $r->semester_ke ?>
                        </td>

                        <td>
                            <?php echo $r->prasyarat_mk . '' . $r->prasyarat_nilai_mk ?>
                        </td>
                        <td>
                            <?php echo $r->prasyarat_mk2 . '' . $r->prasyarat_nilai_mk2 ?>
                        </td>


                        <?php
                        if ($r->linkrps) {
                            ?>
                            <td>
                                <a class="btn btn-info btn-xs" href="<?php echo $r->linkrps ?>">Download</a>

                            </td>
                            <?php
                        } else {
                            ?>
                            <td>Belum Ada</td>
                            <?php
                        }
                        ?>


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
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true

    });
</script>