<div class="panel panel-primary">
    <div class="panel-heading">
        <h6 class='panel-title'>Daftar Pernyataan Quizioner EDOM </h6>
    </div >
    <div class="panel-body">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>PERNYATAAN</td>
                     <td>KETEGORI</td>
                    <td>AKTIF</td>
                    <td>AKSI</td>

                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($list_edom_soal as $r) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $start++ ?>
                        </td>

                        <td>
                            <?php echo $r->pertanyaan ?>
                        </td>
                        <td>
                            <?php echo $r->nm_kategori ?>
                        </td>
                        <td>
                            <?php echo $r->aktif ?>
                        </td>
                        <td><?php if($r->aktif=='Y')
                        {
                            ?>
                           <a href="<?php echo base_url('pjm/nonaktif_edom_soal').'/'.$r->nosoal?>" class="btn btn-sm btn-warning" >Non Aktif</a>
                        <?php
                        }else
                        {
                            ?>
                             <a href="<?php echo base_url('pjm/aktif_edom_soal').'/'.$r->nosoal?>" class="btn btn-sm btn-info" >Aktif</a>  
                          
                        <?php
                            
                        }
                        ?>
                            <a href="<?php echo base_url('pjm/edit_edom_soal').'/'.$r->nosoal?>" class="btn btn-sm btn-success" >Edit</a><a href="<?php echo base_url('pjm/delete_edom_soal').'/'.$r->nosoal?>" class="btn btn-sm btn-danger" >Delete</a></td>


                        


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
        "info": true,
        "autoWidth": true

    });
</script>