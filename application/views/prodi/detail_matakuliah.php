<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>DETAIL RENCANA PEMBELAJARAN  </h6>
    </div >
    <div class="panel-body">
       
         MATAKULIAH = <?php echo $mtk->nm_mtk?><br>
        SKS / SEMESTER             = <?php echo $mtk->sks .' / '.$mtk->semester_ke?>
                   
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>

                    <td>PERTEMUAN</td>
                    <td>CAPAIAN MATAKULIAH</td>
                    <th>INDIKATOR </th>
                    <td>KRITERIA DAN BENTUK PENILAI</td>
                    <td>METODE PEMBELAJARAN [ WAKTU ]</td>
                    <td>MATERI PEMBELAJARAN </td>
                    <td>BOBOT PENILAIAN [ % ]</td>
                    <td>AKSI</td>

                </tr>
            </thead>
            <tbody>
                <?php
               
                foreach ($detail_mtk as $r) {
                   
                    ?>
                    <tr>

                         <td>
                            <?php echo $r->pertemuan ?>
                        </td>
                        <td>
                            <?php echo $r->sub_cp_mk ?>
                        </td>

                        <td>
                            <?php echo $r->indikator ?>
                        </td>


                        <td>
                            <?php echo $r->kriteria_bentuk_penilaian ?>
                        </td>
                        <td>
                            <?php echo $r->metode_pembelajaran ?>
                        </td>
                        <td>
                            <?php echo $r->materi_pembelajaran ?>
                        </td>


                         <td>
                            <?php echo $r->bobot_penilaian ?>
                        </td>

                        <td>
                            <a class="btn btn-info btn-xs" href="<?php echo base_url('prodi/edetail_mtk').'/'.$r->kd_mtk.'/'.$r->pertemuan ?>">Edit</a>
                            <a  class="btn btn-primary btn-xs" href="<?php echo base_url('prodi/ddetail_mtk').'/'.$r->kd_mtk.'/'.$r->pertemuan ?>">Delete</a> 
                        </td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
        <a class="btn btn-primary" href="<?php echo base_url('prodi/tambah_detailmtk').'/'.$kd_mtk ?>">Tambah</a>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

    $('#test').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true

    });
</script>