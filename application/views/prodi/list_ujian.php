<div class="panel panel-primary">
<div class="panel-heading">
<h3 class='panel-title'>Data Ujian Mahasiswa</h3>
</div >
<div class="panel-body">



<table id="test" class="table table">
<thead>
	<tr>
		<th>No</th>
		 <th>Gambar</th>
		 <th>No Daftar</th>
        <th>Tgl Daftar</th>
        <th>Tgl Ujian</th>
        <th>Jam Ujian</th>
        <th>No Daftar Judul</th>
        <th>Nama Mahasiswa/NIM</th>
        <th>No Hp</th>
		<th>Judul</th>
		<th>Jenis Ujian</th>
		<th>Status Ujian</th>
		<td>Aksi</td>

	</tr>
</thead>
<tbody>
<?php
	$start = 1;
    foreach ($list as $r) {
    ?>
	<tr>

		<td><?php echo $start++ ?></td>
        <td><?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim= $r->nim;
                            $file=$nim;
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="60" height="80" ">
                    </td>
		<td ><?php echo $r->no_daftar?></td>
		<td ><?php echo $r->tgl_daftar?></td>
		<td ><?php echo date('d F Y', strtotime($r->tgl_ujian));?></td>
        <td><?php echo		$r->jam?></td>
	
		<td ><?php echo $r->no_daftar_judul?></td>
		<td><?php echo $r->nm_mahasiswa.'/'.$r->nim?></td>
        	<td><a class="btn btn-primary btn-xs" href="https://api.whatsapp.com/send?phone=<?php echo $r->no_hp?>&text=Assalamu%20alaikum%2C%20Jadwal%20ujian%20Anda%20Tgl.%<?php echo date('dd F Y', strtotime($r->tgl_ujian)).' Jam'.$r->jam;?>.%20Lebih%20lengkapnya%20lihat%20disiakad%20USN.%20Terimakasih"><?php echo $r->no_hp?></a></td>
		<td><?php echo $r->judul?></td>

		<td><?php echo $r->jenis_ujian?></td>
	<td>
       <?php echo $r->status?>

            </td>
        
		<td >
		    
		  <?php 
		  if($r->status<>0)
		  {
		     
		      ?>
		 
		      <a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/berita_acara_ujian/'.$r->no_daftar?>"> Berita Acara</a>
		      <a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/form_nilai/'.$r->no_daftar?>"> Form Nilai</a>
		      <a class="btn btn-info btn-xs" href="<?php echo base_url().'prodi/lembar_koreksi/'.$r->no_daftar?>"> Lembar Koreksi</a>
		         <?php
		      
		  }?>
		        
		        
                <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/fnilai_ujian/'.$r->no_daftar?>">Nilai</a>
		       <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/fedaftar_ujian/'.$r->no_daftar?>"> Edit Jadwal</a>
		       <a class="btn btn-danger btn-xs" href="<?php echo base_url().'prodi/delete_daftar_ujian/'.$r->no_daftar?>"> Batal Jadwal</a>
		</td>
		

	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>
<a class="btn btn-primary btn-small" href="<?php echo base_url()?>prodi/daftar_ujian">Tambah</a>
</div>

</div>
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
 <script type="text/javascript">

 $("#test").on('click', '.updat', function(e) {
var currentRow = $(this).closest("tr");
    var no_krs = currentRow.find("#no_krs").val();
    var kd_jadwal = currentRow.find("#kd_jadwal").val();
    var nilai = currentRow.find("#nilai").val();

      var form_data = {
                                        no_krs: no_krs,
                                        kd_jadwal: kd_jadwal,
                                        nilai: nilai,
                                        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>',
                                        ajax: '1'
                                    };
   $.ajax({
                                        url: "<?php echo base_url().'dosen/unilai'?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function(pesan) {
                                            if(pesan==1)
                                            {
                                                alert("Alhamdulillah, Nilai sudah terinput");
                                               
                                            }
                                            else
                                            {
                                                alert(pesan);

                                            }
                                            
                                    
                                         
                                        }
                                    });
});

        $('#test').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
        </script>







                            
           