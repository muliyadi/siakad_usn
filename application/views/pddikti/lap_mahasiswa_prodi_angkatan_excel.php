<?php
 
 //fi="SISTEM INFORMASI";
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename='".$file."'.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

   
<table >
<thead>
	<tr>
	
        <th>NIM</th>
		<th>NAMA MAHASISWA</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Jenis Kelamin</th>
		<th>NIK</th>
		<th>Agama</th>
		<th>NISN</th>
		<th>Jalur Pendaftaran</th>
		<th>NPWP</th>
		<th>Kewarganegaraan</th>
		<th>Jenis Pendaftaran</th>
		<th>Tgl Masuk Kuliah</th>
		<th>Mulai semester</th>
		<th>Jalan</th>
		<th>RT</th>
		<th>RW</th>
		<th>Nama Dusun</th>
		<th>Kelurahan</th>
		<th>Kecamatan</th>
		<th>Kode Pos</th>
		<th>Jenis Tinggal</th>
		<th>Alat Transportasi</th>
		<th>Telp Rumah</th>
		<th>No HP</th>
		<th>Email</th>
		<th>Terima KPS</th>
		<th>No KPS</th>
		<th>NIK Ayah</th>
		<th>Nama Ayah</th>
		<th>Tgl Lahir Ayah</th>
		<th>Pendidikan Ayah</th>
		<th>Pekerjaan Ayah</th>
		<th>Penghasilan Ayah</th>
		<th>NIK Ibu</th>
		<th>Nama Ibu</th>
		<th>Tanggal Lahir Ibu</th>
		<th>Pendidikan Ibu</th>
		<th>Pekerjaan Ibu</th>
		<th>Penghasilan Ibu</th>
		<th>Nama Wali</th>
		<th>Tanggal Lahir wali</th>
		<th>Pendidikan Wali</th>
		<th>Pekerjaan Wali</th>
		<th>Penghasilan Wali</th>
		<th>Kode Prodi</th>
		<th>Jenis Pembiayaan</th>

		
	</tr>
</thead>
<tbody>
<?php
	
	$start = 1;
    foreach ($list as $r) {
   
    ?>
	<tr>
	    
		
		<td ><?php echo $r->nim?></td>
		<td><?php echo $r->nm_mahasiswa?></td>
		<td><?php echo $r->tempat_lahir?></td>
		<td><?php echo "'".$r->tgl_lahir?></td>
		<td><?php echo $r->jns_kelamin?></td>
		<td><?php echo "'".$r->NIK?></td>
		<td><?php echo $r->agama?></td>
        <td><?php echo $r->nisn?></td>
        <td><?php echo $r->jalur_masuk?></td>
        <td><?php echo $r->npwp?></td>
        <td><?php echo $r->kewarganegaraan?></td>
        <td><?php echo $r->jns_pendaftaran?></td>
        <td><?php echo $r->tgl_masuk_kuliah?></td>
        <td><?php echo $r->awal_semester?></td>
        <td><?php echo $r->jalan?></td>
        <td><?php echo $r->rt?></td>
        <td><?php echo $r->rw?></td>
        <td><?php echo $r->dusun?></td>
        <td><?php echo $r->kelurahan?></td>
        <td><?php echo $r->id_wilayah_kec?></td>
        <td><?php echo $r->kodepos?></td>
        <td><?php echo $r->kd_jenis_tinggal?></td>
        <td><?php echo $r->id_transportasi?></td>
        <td><?php echo $r->telp_rumah?></td>
        <td><?php echo $r->no_hp?></td>
        <td><?php echo $r->email?></td>
        <td><?php echo $r->terima_kps?></td>
        <td><?php echo $r->no_kps?></td>
        <td><?php echo $r->nik_ayah?></td>
        <td><?php echo $r->nm_ayah?></td>
        <td><?php echo "'".$r->tgl_lahir_ayah?></td>
        <td><?php echo $r->pend_ayah?></td>
        <td><?php echo $r->pekerjaan_ayah?></td>
        <td><?php echo $r->penghasilan_ayah?></td>
        <td><?php echo $r->nik_ibu?></td>
        <td><?php echo $r->nm_ibu?></td>
        <td><?php echo "'".$r->tgl_lahir_ibu?></td>
        <td><?php echo $r->pend_ibu?></td>
        <td><?php echo $r->pekerjaan_ibu?></td>
        <td><?php echo $r->penghasilan_ibu?></td>
        <td><?php echo $r->nama_wali?></td>
        <td><?php echo "'".$r->tgl_lahir_wali?></td>
        <td><?php echo $r->pend_wali?></td>
        <td><?php echo $r->pekerjaan_wali?></td>
        <td><?php echo $r->penghasilan_wali?></td>
        <td><?php echo $r->kd_prodi_forlap?></td>
        
        <td><?php echo $r->jns_pembiayaan?></td>

        
        
	</tr>
	<?php
                            }
                            ?>
</tbody>
</table>










                            
           