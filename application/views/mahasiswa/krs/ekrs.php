
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>RENCANA STUDI MAHASISWA</h3>
    </div >
    <div class="panel-body">

        <form   action="<?php echo base_url(); ?>mahasiswa/akrs" method="post" class="form-user form-horizontal">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <input type="hidden" name="aksi" value="<?php echo $aksi ?>">
            <div class="form-group">
                <label for="kd_tahun_ajaran" class="col-sm-2">NO KRS</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_krs" readonly="true" value="<?php echo $krsh->no_krs ?>" name="no_krs" placeholder="TAHUN AJARAN">
                </div>
            </div>

            <div class="form-group">
                <label for="nim" class="col-md-2" >MAHASISWA</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="nim" readonly="true" value="<?php echo $krsh->nim ?>" name="nim" placeholder="NIM">
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" readonly="true" id="nm_mahasiswa" value="<?php echo $krsh->nm_mahasiswa ?>" placeholder="NAMA MAHASISWA">
                </div>

            </div>
            <div class="form-group">
                <label for="nim" class="col-md-2" >ANGKATAN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  readonly='true' id="angkatan" value="<?php echo $krsh->angkatan ?>" name="angkatan" placeholder="angaktan">
                </div>
            </div>
            
            <div class="form-group">
                <label for="nim" class="col-md-2" >SEMESTER KE</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="semester_ke" readonly="true"  value="<?php echo $semester_ke ?>" name="semester_ke" placeholder="SEMESTER">
                </div>
            </div>


            <div class="form-group">
                <label for="ips" class="col-sm-2">IPS</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"  readonly='true' id="ips" value="<?php echo $ips ?>" name="ips" placeholder="IPS">

                </div>
                <label for="ips" class="col-sm-2">MAKSIMAL SKS</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="maks_sks"  readonly='true' value="<?php echo $maks_sks ?>" name="maks_sks" placeholder="MAKSIMUM SKS">

                </div>
                
            </div>
            <div class="well-sm">
                <h4>Jadwal Matakuliah</h3>
                    <table id="tjadwal" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                
                                
                                <th>MATA KULIAH</th>
                               
                                <th>SEMESTER</th>
                                 <th>SKS</th>
                                <th>DOSEN</th>
                                <th>KELAS</th>
                                <th>JADWAL</th>
                                <th>SISA KUOTA</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $totsks = 0;
                            foreach ($listjadwal as $jadwal) {

                                $cek = 'tidak';

                                foreach ($krsd as $mtk) {
                                    if ($jadwal['kd_jadwal'] == $mtk->kd_jadwal) {
                                        $totsks = $totsks + $jadwal['sks'];
                                        $cek = 'sama';
                                    }
                                }
                                
                                    
                                ?>
                                
                                <tr>

                                <?php
                                if ($cek == 'sama') {
                                    ?>
                                        <td align="left" ><input type="checkbox" id='xx'  checked="checked" name="jadwal[]" class="pilih" value="<?php echo $jadwal['kd_jadwal'] ?>"> <?php echo $jadwal['nm_mtk'] ?></td>
                                        <?php
                                    } else {
                                        ?>
                                        <td align="left" ><input type="checkbox" id='xx' class="pilih"  name="jadwal[]" value="<?php echo $jadwal['kd_jadwal'] ?>"> <?php echo $jadwal['nm_mtk'] ?></td>
                                        <?php
                                    }
                                    ?>

                                   
                                     <td class=""><?php echo $jadwal['semester_ke'] ?></td>
                                    <td class="sks"><?php echo $jadwal['sks'] ?></td>
                                   
                                    <td class=""><?php echo $jadwal['dosen']?></td>
                                    <td class=""><?php echo $jadwal['kelas'] ?></td>
                                    <td class=""><?php echo $jadwal['hari'] . ', ' . $jadwal['jam'] ?></td>
                                    <td id="quota"><?php echo $jadwal['tersisa'] ?></td>
                                    

                                </tr>
    <?php
                                        
                                    
}
?>
                        </tbody>

                    </table> 

                    <tr><td>Total SKS </td><td><input type="text" size="3"  name="tot_sks"  id="tot_sks" value="<?php echo $totsks ?>" readonly='true'></td></tr>

            </div>
            <?php 
            if($tombol=="buka")
            {
                ?>
                  <button id="simpan"  class="btn btn-primary">Simpan</button>
            <?php
            }
            else
            {
                ?>
                  <button id="simpan" type="reset" class="btn btn-primary">Keluar</button>
                <?php
            }
            ?>

              

            

    </div>
</div>
</div>
</form>

</div >
</div >

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>


<script type="text/javascript">
   

    $('#tjadwal').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": true
    });

</script>

<script>
    $("#tjadwal").on('click', '.pilih', function(e) {
        var currentRow = $(this).closest("tr");
        var a;
        var nilai;
       //var c= parseInt(document.getElementById("tot_sks").value);
		nilai = currentRow.find(".sks").html();
			//jadwal = currentRow.find("#jadwal").html();
			quota = parseInt(currentRow.find("#quota").html());
		var max=parseInt(document.getElementById("maks_sks").value);
		max=max+1;
       a= currentRow.find("#xx").prop('checked');
       
		if(a==true)
		{
            if(quota<=0)
            {
                alert('Kuota kelas ini sudah penuh, silahkan konfirmasi ke prodi jika matakuliah yang sama dengan kelas yang berbeda tidak tersedia. Terimakasih');
    			currentRow.find("#xx").prop('checked',false);
    			//	document.getElementById("tot_sks").value=parseInt(document.getElementById("tot_sks").value) - parseInt(nilai);
    		
            }
            else
            {       
                	document.getElementById("tot_sks").value=parseInt(document.getElementById("tot_sks").value) + parseInt(nilai);
                if(parseInt(document.getElementById("tot_sks").value)>24)
        			{
        				alert('Mohon Maaf, KRS yang ditawar '+document.getElementById("tot_sks").value+' telah melewati batas maksimal: 24 SKS');
            			currentRow.find("#xx").prop('checked',false);
            			//document.getElementById("tot_sks").value= c - parseInt(nilai);
            		    document.getElementById("tot_sks").value=parseInt(document.getElementById("tot_sks").value) - parseInt(nilai);
        			}
        		    if (parseInt(document.getElementById("tot_sks").value)>=max)
        			{
        			    alert('Mohon Maaf, KRS yang ditawar telah melewati batas maksimal:'+max+ ' SKS');
            			currentRow.find("#xx").prop('checked',false);
            			document.getElementById("tot_sks").value=parseInt(document.getElementById("tot_sks").value) - parseInt(nilai);
            			//document.getElementById("tot_sks").value= c - parseInt(nilai);
        			}       
        				
            }
			
		}else
		{
			document.getElementById("tot_sks").value=parseInt(document.getElementById("tot_sks").value) - parseInt(nilai);
			
		}
		
	
			

    });

</script>