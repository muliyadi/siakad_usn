<!doctype html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SIAKAD USN Kolaka </title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <style type="text/css"> body{ padding: 20px; font-family: "Times New Roman"; background-repeat: no-repeat; background-position:center; } .word-table { border:1px solid black !important; border-collapse: collapse !important; width: 100%; align:center; font-family: "Times New Roman"; } .word-table tr th, .word-table tr td{ border:1px solid black !important; padding: 2px 3px; font-family: "Times New Roman"; } .wordx-table { border:0px solid black !important; padding: 0px; width: 100%; align:center; font-family: "Times New Roman"; font-size: 12px; margin-bottom: 0px; } .wordx-table tr th td, .wordx-table tr td{ border:0px solid black !important; padding: 0px 0px; font-family: "Times New Roman"; font-size: 12px; margin-bottom: 0px; padding: 0px; } hr.style2 { border-top: 3px double #8c8b8b; height: 1px; margin-top: 1px; margin-bottom: 1px; padding: 0px }
        </style>
    </head>
    <body background="">
        <div class="container" >
            <table align="center" class="wordx-table"  >
                <tr align="center"> 
                    <td width="14%" >
                        <img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"></td> 
                    <td  >
                        <p >
                            <font size="3"><?php echo $this->config->item('kementerian');?>
                                <br/> <b><?php echo $this->config->item('namakampus');?></b><br /> <b>
                                    <?php echo $fakultas->nm_fak?><br>
                                    PROGRAM STUDI <?php echo $fakultas->nm_prodi?>
                            </font></b>
                            <br/> 
                            <font size="3"><?php echo $this->config->item('alamatinduk');?>
                                <br/> Telp. (0405) 2321132, Fax. (0405) 2324028 
                                <br/> Email: <?php echo $this->config->item('email');?>; Website: <?php echo $this->config->item('website');?>
                            </font>
                        </p></td> 
                    <td width="10%"></td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div> <br />
            <h4 align="center">BIODATA MAHASISWA
            </h4>
            <div align='center'>
                <?php $dir=  base_url().'doc/foto/';
                            $eks='.jpg';
							$nim=$this->session->userdata('userid');
                            $file=strtoupper($nim);
                            $foto=$dir.$file.$eks;
                            ?>
                    <img src="<?php echo $foto?>" width="110" height="130" >
            </div>
          

</div>
       	<table class="wordx-table" cellspacing=0 border=1>
					<tbody>
						
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							IDENTITAS DIRI
							</td>
						</tr>
						<tr style="height:23px;">
							<td  >
							*NIM
							</td>
							<td >
							:
							</td>
							<td style="min-width:50px;align:left" colspan=2>
					        <?php echo $mahasiswa->nim?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Nama Mahasiswa
							</td>
							<td style="min-width:5px">:
							</td>
							<td  colspan=2>
					             <?php echo $mahasiswa->nm_mahasiswa?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Tempat, *Tanggal Lahir
							</td>
							<td >
							:
							</td>
							<td >
							 <?php echo $mahasiswa->tempat_lahir?>
							</td>
							<td >
						 <?php echo $mahasiswa->tgl_lahir?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Jenis Kelamin
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					        <?php echo $mahasiswa->jns_kelamin?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*NIK
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					         <?php echo $mahasiswa->NIK?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Agama
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					        <?php echo $mahasiswa->agama?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Kewarganegaraan
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					<?php echo $mahasiswa->kewarganegaraan?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							ALAMAT LENGKAP
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*ID Wilayah Kecamatan
							</td>
							<td >
							:
							</td>
	                    <td  colspan=2>
						<?php echo $mahasiswa->id_wilayah_kec?>
							</td>

						</tr>
						<tr style="height:23px;">
							<td >
							*Kelurahan, RT/RW
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
						<?php echo $mahasiswa->kelurahan.','.$mahasiswa->rt.'/'.$mahasiswa->rw?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							Dusun
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->dusun?>
							</td>
					
						</tr>
						<tr style="height:23px;">
							<td >
							Jalan
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->jalan?>
							</td>
							
						</tr>
						<tr style="height:23px;">
							<td >
							Telp Rumah
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->telp_rumah?>
							</td>
						
						</tr>
						<tr style="height:23px;">
							<td >
							No HP
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->no_hp?>
							</td>
						
						</tr>
						<tr style="height:23px;">
							<td >
							Email
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->email?>
							</td>
						
						</tr>
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							DATA JURUSAN/PROGRAM STUDI
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Kode Program Studi
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->kd_prodi?>
							</td>
	
						</tr>
						<tr style="height:23px;">
							<td >
							Jalur Masuk
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
						<?php echo $mahasiswa->jalur_masuk?>
							</td>
						</tr>
							<tr style="height:23px;">
							<td >
							Angkatan
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->angkatan?>
							</td>
	
						</tr>
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							IDENTITAS SOSIAL
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*Terima KPS / No KPS
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->terima_kps.'/'.$mahasiswa->no_kps?>
							</td>
	
						</tr>
						<tr style="height:23px;">
							<td >
							Jenis Pembiayaan Kuliah
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
						<?php echo $mahasiswa->jns_pembiayaan?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							SEKOLAH ASAL
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							*NPSN
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
						<?php echo $mahasiswa->npsn?>
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							NISN
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->nisn?>
							</td>
					
						</tr>
						<tr style="height:23px;">
							<td >
							Tahun Lulus
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					<?php echo $mahasiswa->thn_tamat_sma?>	
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							Jurusan SMA
							</td>
							<td >
							:
							</td>
							<td  colspan=2>
					<?php echo $mahasiswa->jurusan_sma?>	
							</td>
						</tr>
						<tr style="height:23px;">
							<td style="font-family:Times;color:#000000;text-decoration:underline;min-width:50px" colspan=4>
							IDENTITAS KELUARGA
							</td>
						</tr>
						<tr style="height:23px;">
							<td >
							NO KK
							</td>
							<td >
							:
							</td>
							<td colspan=2>
					<?php echo $mahasiswa->no_kk?>
							</td>
			
						</tr>
						<tr style="height:23px;">
							<td >
							Nama Ayah
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->nm_ayah?>
							</td>
			
						</tr>
						<tr style="height:23px;">
							<td >
							Tgl Lahir Ayah
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->tgl_lahir_ayah?>
							</td>
				
						</tr>
						<tr style="height:23px;">
							<td >
							Pendidikan Ayah
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->pend_ayah?>
							</td>
				
						</tr>
							<tr style="height:23px;">
							<td >
							Pekerjaan Ayah
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
						<?php echo $mahasiswa->pekerjaan_ayah?>
							</td>
				
						</tr>
						<tr style="height:23px;">
							<td >
						      Penghasilan Ayah
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->penghasilan_ayah?>
							</td>
			
						</tr>
						<tr style="height:23px;">
							<td >
							*Nama Ibu
							</td>
							<td >
							:
							</td>
							<td colspan=2>
					<?php echo $mahasiswa->nm_ibu?>	
							</td>
			
						</tr>
						<tr style="height:23px;">
							<td >
							Tgl Lahir Ibu
							</td>
							<td >
							:
							</td>
							<td colspan=2>
						<?php echo $mahasiswa->tgl_lahir_ibu?>
							</td>
	
						</tr>
						<tr style="height:23px;">
							<td >
							Pendidikan Ibu
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
		    <?php echo $mahasiswa->pend_ibu?>				
							</td>

						</tr>
						<tr style="height:23px;">
							<td >
							Pekerjaan Ibu
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
		    <?php echo $mahasiswa->pekerjaan_ibu?>				
							</td>

						</tr>
						<tr style="height:23px;">
							<td >
							Penghasilan Ibu
							</td>
							<td >
							:
							</td>
							<td colspan=2 >
					<?php echo $mahasiswa->penghasilan_ibu?>
							</td>

						</tr>

					</tbody>
				</table><br>
				
    <table  class="word-table">
        <tr><td>Keterangan:</td></tr>
        <tr><td>*Agama: 1=Islam, 2=Kristen, 3=Katolik, 4=Hindu, 5=Budha, 6=Konghucu</td>
        </tr>
        <tr><td>*Jeni Kelamin: L=Laki-Laki, P=Perempuan</td></tr>
        <tr><td>*Kewarganegaraan: ID=Indonesia</td></tr>
        <tr><td>*Jenjang Pendidikan: 0=Tidak Sekolah, 1=PAUD, 2=TK, 3=PUTUS SD, 4=SD, 5=SMP, 6=SMA, 7=PAKET A, 8=PAKET B, 9=PAKET C, 30=S1, 35=S2, 40=S3</td></tr>
        <tr><td>*Golongan Penghasilan: 11=KURANG DARI RP.500.000, 12=RP.500.000 - RP.999.999, 13=RP.1.000.000 - RP.1.999.999, 14=RP.2.000.000 - RP.4.999.999, 15= RP.5.000.000-Rp.20.000.000, 16=Lebih dari RP.20.000.000</td></tr>
        <tr><td>*Jenis Pendaftaran: 1=Peserta didik baru, 2=Pindahan, 3=Naik kelas, 4=Akselerasi, 5=Mengulang, 6=Lanjutan semester, 8=Pindahan Alih Bentuk, 11=Alih Jenjang, 12=Lintas Jalur</td></tr>
        <tr><td>*Jalur Masuk: 1:SBMPTN	
2:SNMPTN	
3:PMDK Penelusuran minat dan kemampuan (akademik)
4:Prestasi Penelusuran minat dan kemampuan (prestasi non-akademik)
5:Seleksi Mandiri PTN	
6:Seleksi Mandiri PTS	
7:Ujian Masuk Bersama PTN (UMB-PT)	
8:Ujian Masuk Bersama PTS (UMB-PTS)	
9:Program Internasional	
11:Program Kerjasama Perusahaan/Institusi/Pemerintah</td></tr>
    
        <tr><td>*Jenis Pembiayaan: 1=Mandiri, 2=Beasiswa Tidak Penuh, 3=Beasiswa Penuh</td></tr>
    </table>
    </body>
</html>