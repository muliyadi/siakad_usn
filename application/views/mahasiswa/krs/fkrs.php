
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class='panel-title'>RENCANA STUDI MAHASISWA</h3>
    </div >
    <div class="panel-body">

        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
        <form  action="<?php echo base_url(); ?>mahasiswa/akrs" method="post" class="form-user form-horizontal" role="form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none;"/>
            <input type="hidden" name="aksi" value="<?php echo $aksi; ?>"> 
            <div class="form-group">
                <label for="nim" class="col-md-2" >NIM </label>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="nim" value="<?php echo $nim ?>" name="nim" placeholder="NIM">
                </div>
			</div>
			 <div class="form-group">
                <label for="nim" class="col-md-2" >NAMA MAHASISWA </label>
				
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nm_mahasiswa" value="<?php echo $nm_mahasiswa ?>" placeholder="NAMA MAHASISWA">
                </div>
				  <div class="col-sm-1">
                    <input type="text" class="form-control" id="kd_prodi" value="<?php echo $kd_prodi ?>" name="kd_prodi" placeholder="PRODI">
                </div>
			</div>
			
            <div class="form-group">
                <label for="nim" class="col-md-2" >ANGKATAN</label>
                <div class="col-sm-10">
                    <input type="text" readonly='true' class="form-control" id="angkatan" value="<?php echo $angkatan ?>" name="angkatan" placeholder="angaktan">
                </div>


            </div>
              
            
            <div class="form-group">
                <label for="nim" class="col-md-2" >SEMESTER KE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="semester_ke" value="<?php echo $semester_ke ?>" name="semester_ke" placeholder="SEMESTER">
                </div>


            </div>




            <div class="form-group">
                <label for="ips" class="col-sm-2">IPS</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ips"  readonly='true' value="<?php echo round($ips,2) ?>" name="ips" placeholder="IPS">

                </div>
                <label for="ips" class="col-sm-1">MAKS SKS</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="maks_sks" readonly='true' value="<?php echo $maks_sks ?>" name="maks_sks" placeholder="IPS">

                </div>
				             <label for="ips" class="col-sm-1">SKS DITAWAR</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"  name="tot_sks" id="tot_sks" value="0">

                </div>
				
            </div>
            <div class="card">
                <h4>Jadwal Matakuliah</h3>
                    <table id="tjadwal" class="table table-hover">
                        <thead>
                            <tr>
    
    	 
    	
                                <th >MATA KULIAH</th>
								
                                <th>SKS</th>
							<th width="40">SMTR</th>
                                <th >DOSEN</th>
                               
                                <th>WAKTU</th>
                                 <th>KELAS</th>
                                <th>SISA KUOTA</th>
                               


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start= 1;
                            if ($listjadwal) {
                                foreach ($listjadwal as $mtk) {
               
                                    ?>
                                    <tr class="pilih2" >
                                    
                                    	 <td> <input id='xx' type="checkbox" name="jadwal[]" class="pilih" value="<?php echo $mtk['kd_jadwal'] ?>"> <?php echo $mtk['nm_mtk'] ?></td>
                                    	 
									

                                        <td class="sks"><?php echo $mtk['sks'] ?></td>
										<td ><?php echo $mtk['semester_ke'] ?></td>
                                        <td class=""><?php echo $mtk['dosen'] ?></td>
                                      
                                        <td class=""><?php echo $mtk['hari'] . ', ' . $mtk['jam'] ?></td>
                                          <td class=""><?php echo $mtk['kelas'] ?></td>
                                        <td id='quota'> <?php echo $mtk['tersisa']?></td>
                                        
                                                         

                                    </tr>
                                    <?php
                                        
                                    
                                    
                                }
                            }
                            ?>
                        </tbody>
                    </table> 
                    
                    <button id="simpan" class="btn btn-primary">Simpan</button>


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
                                                "lengthChange": true,
                                                "searching": false,
                                                "ordering": false,
                                                "info": false,
                                                "autoWidth": false
                                            });
</script>

<script>
    $('#notifications').slideDown('slow').delay(30000).slideUp('slow');


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
        		    if (parseInt(document.getElementById("tot_sks").value)>=max+1)
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