<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>RENCANA STUDI MAHASISWA</h3>
</div >
<div class="panel-body">

<form   action="<?php echo base_url();?>dosen" method="post" class="form-user form-horizontal">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;"/>
   
    <div class="form-group">
    <label for="kd_tahun_ajaran" class="col-sm-2">NO KRS</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="no_krs" readonly="true" value="<?php echo $krsh->no_krs?>" name="no_krs" placeholder="TAHUN AJARAN">
    </div>
    </div>
    
    <div class="form-group">
    <label for="nim" class="col-md-2" >MAHASISWA</label>
    <div class="col-md-2">
        <input type="text" class="form-control" id="nim" readonly="true" value="<?php echo $krsh->nim?>" name="nim" placeholder="NIM">
    </div>
    <div class="col-sm-7">
        <input type="text" class="form-control" readonly="true" id="nm_mahasiswa" value="<?php echo $krsh->nm_mahasiswa?>" placeholder="NAMA MAHASISWA">
    </div>

    </div>
    <div class="form-group">
    <label for="nim" class="col-md-2" >SEMESTER KE</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" id="semester_ke" readonly="true" value="<?php echo $krsh->semester_ke?>" name="semester_ke" placeholder="SEMESTER">
    </div>


    </div>


    <div class="form-group">
    <label for="ips" class="col-sm-2">IPS[Sebelumnya]</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly="true" id="ips" value="<?php echo $krsh->ips?>" name="ips" placeholder="IPS">

    </div>
    <label for="ips" class="col-sm-2">MAKS SKS</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" readonly="true" id="maks_sks" value="<?php echo $maks_sks?>" name="maks_sks" placeholder="MAKSIMUM SKS">
        
    </div>
    </div>
    <div class="well-sm">
    <h4>Detail KRS</h3>
    <table id="lkrs" class="table table-bordered table-hover table-striped">
	<thead>
	<tr>
        <th>NO.</th>
        <th>KODE</th>
        <th>MATA KULIAH</th>
        <th>SKS</th>
        <th>SEMESTER</th>
        <th>DOSEN</th>
        <th>KELAS</th>
        <th>WAKTU</th>
        <th>SETUJUI</th>
        <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
		<?php
        $no=1;
        $totsks=0;
			foreach($krsd as $mtk)
			{
			    $totsks=$totsks+$mtk['sks'];
			    ?>
			    <tr>
			        <td><?php echo $no++?></td>
			        <td><?php echo $mtk['kd_mtk']?></td>
			    <td><?php echo $mtk['nm_mtk']?></td>
			    <td><?php echo $mtk['sks']?></td>
			    <td><?php echo $mtk['semester_ke']?></td>
			     <td><?php echo $mtk['dosen']?></td>
			      <td><?php echo $mtk['kelas']?></td>
			       <td><?php echo $mtk['hari'].' ,'.$mtk['jam']?></td>
			       <td><?php echo $mtk['status']?></td>
			       <td>
			           <?php 
			 
			
			echo anchor(site_url('dosen/setujui_mtk/'.$mtk['no_krs'].'/'.$mtk['kd_jadwal']),'<i class="fa fa-pencil-square-o"> Setujui</i>',array('title'=>'Setujui')); 
			echo ' | '; 
			echo anchor(site_url('dosen/tolak_mtk/'.$mtk['no_krs'].'/'.$mtk['kd_jadwal']),'<i class="fa fa-pencil-square-o"> Batal</i>',array('title'=>'Batal')); 
            echo ' | '; 
			echo anchor(site_url('dosen/hapus_mtk/'.$mtk['no_krs'].'/'.$mtk['kd_jadwal']),'<i class="fa fa-pencil-square-o"> Hapus</i>',array('title'=>'Hapus')); 
			
			
			?>
			       </td>

			    	</tr>
			    <?php
			
			}
										
		?>
   

		</tbody>

		</table> 
 
    <tr><td>Total SKS </td><td><input type="text" size="3"  name="tot_sks" value="<?php echo $totsks?>"></td></tr>
           <a class="btn btn-primary" href="<?php echo base_url('Dosen/setujui_krsmb').'/'.$krsh->no_krs ?>">Setujui</a>
    </div>

   
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


            $('#lkrs').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });

                </script>

