<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Monitoring Kegiatan Akademik Mahasiswa</h3>
    </div >
    <div class="panel-body">
        <table id="listdosen" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th></th>
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
                        Dosen PA
                    </th>
                    <th>
                       SPP/Cuti
                    </th>
                    <th>
                        KRS
                    </th>
                    <th>
                        Aksi
                    </th>


                </tr>
            </thead>
            <tbody>
                <?php
                $start = 1;
                foreach ($listmhs as $r) {
                    ?>
                    <tr>
                        <td><?php echo $start++ ?></td>
                        	<td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= $r['nim'];
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80">
                    </td>
                        <td><?php echo $r['nim'] ?></td>
                        <td><?php echo $r['nm_mahasiswa'] ?></td>
                        <td><?php echo $r['angkatan'] ?></td>
                        <td><?php echo $r['status'] ?></td>
                        
						<td><?php echo $r['no_hp'] ?></td>
							<td><?php echo $r['nm_dosen'] ?></td>
						<td><?php echo $r['spp'] ?></td>
						<td><?php echo $r['krs'] ?></td>
                       
                            <td>
                                <a  href="<?php echo base_url().'Prodi/detail_reg/'.$r['nim']?>"class="btn btn-primary btn-xs" >REG</a>
                                   <a  href="<?php echo base_url().'Prodi/krs_mhs/'.$r['nim']?>"class="btn btn-primary btn-xs" >KRS</a>
		    <a  href="<?php echo base_url().'Prodi/lkhs/'.$r['nim']?>"class="btn btn-info btn-xs" >KHS</a> 
		       <a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r['no_hp']?>&text=Asslamu%20alaikum%21%21%21">Chat</a>
                            </td>
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

    $('#listdosen').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });
</script>