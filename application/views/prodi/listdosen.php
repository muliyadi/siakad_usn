<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>Daftar Dosen
      
       </h3>
    </div >
    <div class="panel-body">
        
        <table id="listdosen" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>
                        <b>+</b>
                    </th>
                     <th>
                        FOTO
                    </th>
                    <th>
                        NIK/KODE/NIDN
                    </th>

                    <th>
                        Nama Dosen 
                    </th>
                    <th>
                        Tempat/Tgl Lahir
                    </th>
                    <th>
                        Jenis Kelamin
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        No Telp/HP
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Aksi
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
                            <td>
                                
                            </td>
                            <td>
                                <img src="<?php echo $r->link_foto ?>" width="80">
                            </td>
                            <td>
                                <?php echo $r->kd_dosen ?>/<?php echo $r->NIDN ?>
                            </td>

                            <td>
                                <?php echo $r->nm_dosen ?>
                            </td>
                            <td>
                                <?php echo $r->tempat . '/' . $r->tgl_lahir ?>
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
                                <?php echo $r->Status ?>
                            </td>
                            <td>
                                <a class="btn btn-info btn-xs" href="<?php echo base_url() . 'prodi/edosen/' . $r->kd_dosen ?>">Edit</a> 
                                <a class="btn btn-primary btn-xs"href="<?php echo base_url() . 'prodi/ddosen/' . $r->kd_dosen ?>">Delete</a> 	
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>+</th>
                     <th>
                        FOTO
                    </th>
                    <th>
                        NIK/KODE/NIDN
                    </th>

                    <th>
                        Nama Dosen 
                    </th>
                    <th>
                        Tempat/Tgl Lahir
                    </th>
                    <th>
                        Jenis Kelamin
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        No Telp/HP
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Aksi
                    </th>


                </tr>
            </tfoot>
        </table>
           
    </div>


</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript">

    $('#listdosen').DataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
</script>