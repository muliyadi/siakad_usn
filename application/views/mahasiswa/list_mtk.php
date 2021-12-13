<!doctype html>

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>List Matakuliah Yang Telah Ditawar</h3>
</div >
<div class="panel-body">
    <a class="btn btn-primary btn-xs" href="<?php echo base_url().'mahasiswa/transkrip_nilai'?>">Print</a>
            <table  id="listdosen" class="table table-hover table-bordered table-striped"  >
<tr>

    <td width="100">MAHASISWA</td><td width="10"> = </td>

    <td ALIGN="LEFT" ><?php echo $mahasiswa->nm_mahasiswa .' | '.$mahasiswa->nim?></td>

    <td ALIGN="LEFT" width="100">PROGRAM STUDI</td><td width="10"> = </td><td width="150" ><?php echo $mahasiswa->kd_prodi?></td>

</tr>

<tr>

    <td>ANGKATAN</td><td width="10"> = </td>

    <td ALIGN="LEFT"><?php echo $mahasiswa->angkatan?></td>

   
    <td>DOSEN PA</td><td > = </td>

    <td ALIGN="LEFT" width="200"><?php if($pa){ echo $pa->nm_dosen;}?></td>

</tr>





</table>





        

        



        

        <table id="listdosen2" class="table table-hover table-bordered table-striped"  >

        <tr>

        <th style="text-align: center;" >No</th>

        <th width="150" style="text-align: center;" >KODE</th>

        <th width="450" >MATAKULIAH</th>
<th style="text-align: center;">SMSTR</th>
        <th style="text-align: center;">SKS</th>

        

        <th style="text-align: center;">NILAI HURUF</th>

        <th style="text-align: center;">NILAI ANGKA</th>

        <th style="text-align: center;" width="" >BOBOT</th>
        <th style="text-align: center;" width="" >TA</th>
        <th style="text-align: center;" width="" >AKTIF</th>
        <th style="text-align: center;" width="" >AKSI</th>
        

        </tr>

        <?php

        $start=0;

        $totbobot=0;

        $totsks=0;

	$totangka=0;

        

            foreach ($transkrip  as $row)

            {

            $totbobot=$totbobot+($row->sks*$row->nilai_a);

            $totsks=$totsks+$row->sks;
		$totangka=$totangka+$row->nilai_a;


                ?>

                <tr>

              <td align="center"><?php echo ++$start ?></td>

              <td align="center"><?php echo $row->kd_mtk ?></td>

              <td ><?php echo $row->nm_mtk?></td>
  <td align=center><?php echo $row->semester_ke?></td>
              <td align="center"><?php echo $row->sks?></td>

              

              <td align="center"><?php echo $row->nilai ?></td>

              <td align="center"><?php echo $row->nilai_a ?></td>

               <td align="center"><?php echo  $row->sks*$row->nilai_a?></td>

                <td align="center"><?php echo  $row->kd_tahun_ajaran?></td>
                <td align="center"><?php echo  $row->aktif?></td>
                <td>
                 <a class="btn btn-info btn-xs" onclick="return confirm('Anda yakin?');"  href="<?php echo base_url().'mahasiswa/aktif_matkul_krs/'.$row->no_krs.'/'.$row->kd_mtk?>">Aktif</a> 
                 <a class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin?');"  href="<?php echo base_url().'mahasiswa/hapus_matkul_krs/'.$row->no_krs.'/'.$row->kd_mtk?>">Non Aktif</a> 
</td>
                </tr>

                <?php

                

            }

           if($totsks==0)
           {
               $totsks=1;
           }
            $ips=$totbobot/$totsks;

            ?>

            <tr >

                <td colspan="4" align="right">JUMLAH</td>

                <td align="center"><?PHP ECHO $totsks?></td>

                 <td align="center"></td>

                  <td align="center"><?PHP ECHO $totangka?></td>

                   <td align="center"><?PHP ECHO $totbobot?></td>
                <td></td>
                <td></td>
            </tr>

            <tr>

                <th colspan="8">INDEKS PRESTASI KOMULATIF (IPK) =  <?PHP ECHO round($ips,2)?></th>

            </tr>



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