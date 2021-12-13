<?php
 
 //fi="SISTEM INFORMASI";
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=rekap_registrasi.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

    <body >

        



         

 <h4 align="center">LAPORAN REKAP REGISTRASI MAHASISWA</h4>
 <h4 align="center">TAHUN AKADEMIK <?PHP echo $ta?></h4>
 
        <table id="listdosen" class="word-table">
            <thead>
                <tr>
                    <th>
                        Dosen PA
                    </th>
                    
                    <th>
                        NIM
                    </th>

                    <th>
                        Nama Mahasiswa 
                    </th>
                    <th>
                        Angkatan
                    </th>
                     <th>
                        Status
                    </th>
					<th>
                        No HP
                    </th>
					 
                    <th>
                       SPP/Cuti
                    </th>
                    <th>
                        KRS
                    </th>
                    <th>Keterangan</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                $krs=0;
                $reg=0;
                foreach ($listmhs as $r) {
                    if($r['spp']=='Ya')
                    {
                        $reg=$reg+1;
                    }
                    if($r['krs']=='Ya')
                    {
                        $krs=$krs+1;
                    }
                    ?>
                    <tr>
                        <td><?php echo $r['dosen_pa'] ?></td>
                        	
                        <td><?php echo $r['nim'] ?></td>
                        <td><?php echo $r['nm_mahasiswa'] ?></td>
                        <td><?php echo $r['angkatan'] ?></td>
                        <td><?php echo $r['status'] ?></td>
                        
						<td><?php echo $r['no_hp'] ?></td>
						<td><?php echo $r['spp'] ?></td>
						<td><?php echo $r['krs'] ?></td>
						<td></td>
                       
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        Total SPP=<?php echo $reg?>
        Total KRS=<?php echo $krs?>
        Selisih=<?php echo $reg-$krs?>
        </body>
        
    

</html>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">

    $('#listdosen').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });
</script>