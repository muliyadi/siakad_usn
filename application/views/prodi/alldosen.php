<div class="panel panel-primary">
    <div class="panel-heading">
    <h3 class='panel-title'>List Dosen</h3>
     
    </div >
    <div class="panel-body">
        <table id="test" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>

                    <th>
                        NIK/ NIDN
                    </th>
                    <th>
                        Nama Dosen 
                    </th>
                    <th>
                        Tempat/ Tgl Lahir
                    </th>
                    <th>
                        Jenis Kelamin
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        No Telp/ HP
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Home Base
                    </th>
                    <th>
                        Status
                    </th>
                     



                </tr>
            </thead>
            <tbody>
                <?php
                $start = 0;
                if ($listdosen) {
                    foreach ($listdosen as $r) {
                        ?>
                        <tr>
                            <?php
                            if($r->link_foto)
                            {
                                
                                ?>
                                 <td><img src="<?php echo $r->link_foto?>" width="120" height="135" ><br>
                                <?php echo $r->kd_dosen ?>/ <?php echo $r->NIDN ?>
                            </td>
                            <?php
                                
                            }
                            else
                            {
                                ?>
                                <?php $dir=  base_url().'doc/foto/dosen/';
                            $eks='.JPG';
							$nim= strtoupper($r->kd_dosen);
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    
                                 <td><img src="<?php echo $foto?>" width="120" height="135" "><br>
                                <?php echo $r->kd_dosen ?>/ <?php echo $r->NIDN ?>
                            </td>
                            <?php
                                
                            }
                            ?>
                           

                            <td>
                                <?php echo $r->nm_dosen ?>
                            </td>
                            <td>
                                <?php echo $r->tempat . '/ ' . $r->tgl_lahir ?>
                            </td>
                            <td>
                                <?php echo $r->jns_kelamin ?>
                            </td>

                            <td>
                                <?php echo $r->alamat ?>
                            </td>
                            <td>
                                <?php echo $r->telepon ?>
                            </td>
                            <td>
                                <?php echo $r->email ?>
                            </td>
                            <td>
                                <?php echo $r->nm_prodi ?>
                            </td>
                            <td>
                                <?php echo $r->Status ?>
                            </td>

                        </tr>
                        <?php
                    }
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