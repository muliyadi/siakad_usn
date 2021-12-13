

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Evaluasi Dosen Oleh Mahasiswa (EDOM) </h3>
</div >
<div class="panel-body">
  <H4>Tahun Akademik <?php echo $hkhs->kd_tahun_ajaran ?></H4>

<input type="hidden" name="no_krs" value="<?php echo $no_krs?>">
<table class="table table-responsive" style="margin-bottom: 10px">

        <tr>
        <th  style="text-align: center;" >NO</th>
        <th   style="text-align: center;" >KODE</th>
        <th >MATAKULIAH</th>
        <th  style="text-align: center;">SKS</th>

        <th  >DOSEN PENGAMPU</th>
        <th>AKSI</th>
        </tr>
        

        <?php
$start=0;
    

        

            foreach ($dkhs  as $row)

            {


               

                ?>

                <tr>

              <td align="center"><?php echo ++$start ?></td>

              <td align="center"><?php echo $row['kd_mtk'] ?></td>

              <td ><?php echo $row['nm_mtk']?></td>

              <td align="center"><?php echo $row['sks']?></td>
                 <td align="left"><?php echo $row['nm_dosen']?></td>
              

  
                <td><a class="btn btn-sm btn-info" href="<?php echo base_url('mahasiswa/edom2').'/'.$row['kd_jadwal'].'/'.$no_krs?>">ISI EDOM</a> </td>
              

             

                </tr>

                <?php

                

            }

        

            ?>





        </table>


        

        



        

       





               </div>

</div>

        

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
                <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

                         $('#listdosen').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>
                     <script type="text/javascript">

                         $('#listdosen2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
                    </script>