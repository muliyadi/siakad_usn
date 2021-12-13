<!doctype html>




<html>
    <head>
        <title>SIAKAD USN Kolaka</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <style type="text/css">
            body{
                padding: 20px;
                font-family: "Times New Roman";


                background-repeat: no-repeat;
                background-position:center;
            }


            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
                font-family: "Times New Roman";
            }
            .wordx-table {
                border:0px solid black !important; 
                padding: 0px;
                width: 100%;
                align:center;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
            }
            .wordx-table tr th td, .wordx-table tr td{
                border:0px solid black !important; 
                padding: 0px 0px;
                font-family: "Times New Roman";
                font-size: 12px;
                margin-bottom: 0px;
                padding: 0px;
            }
            hr.style2 {
                border-top: 3px double #8c8b8b;
                height: 1px;
                margin-top: 1px;
                margin-bottom: 1px;
                padding: 0px
            }


        </style>

    </head>
    <body background="">
        <div class="container" >

            <table align="center" class="wordx-table"  >

                <tr align="center">
                    <td width="14%" ><img src="<?php echo base_url(); ?>assets/image/usnx.jpg" alt="..." width="160px" height="110px"  align="top"> 

                    </td>
                    <td  >
                        <p ><font size="3">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br/>
                            <b>UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA</b><br />
                            <b><?php echo $fakultas->nm_fak ?></font></b><br/>
                            <font size="3">Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517 <br/>
                            Telp. (0405) 2321132, Fax. (0405) 2324028 <br/>
                            Email: rektorat@usn.ac.id; Website: https://usn.ac.id
                            </font></p>

                    </td> 
                    <td width="10%">

                    </td>
                </tr>
            </table>
            <div>
                <hr class="style2">
            </div>
            <div>
                <p align="center"><b><?php echo $judul?><br>
                TAHUN AKADEMIK <?php echo $this->session->userdata('kd_tahun_ajaran');?> </b></p>

            </div>
            
            <table class="wordx-table" align="center">
                <tr height='0'>
                     <td colspan='3'>Mahasiswa yang dinilai: </td>
                </tr>
                <tr height='30'>
                     <td>NIM</td><td align="center">:</td><td> <?php echo $daftar->nim?> </td>
                </tr>
                <tr height='30'>
                     <td>Nama</td><td align="center">:</td><td><?php echo  $daftar->nm_mahasiswa ?> </td>
                </tr>
                <tr height='30'>
                     <td>Judul</td><td align="center">:</td><td><?php echo  $daftar->judul?> </td>
                </tr>
                <tr height='30'>
                     <td colspan='3'>Pelaksanaan Ujian: </td>
                </tr>
                
                <tr height='30'>
                    <td width="160">Hari, Tanggal / Jam</td><td width="20" align="center">:</td><td></td>
                </tr>
                <tr height='30'>
                     <td>Tempat</td><td align="center">:</td><td>Ruang Sidang FTI Lt. </td>
                </tr>
                
            </table>

            <table class="word-table" style="margin-bottom: 10px">
                <tr height="40">
                    <th style="text-align: center;" width="50" >No.</th>
                    <th width="60%" style="text-align: left;" >Kriteria Penilaian</th>
                    <th  width="" >Bobot</th>
                    <th width="20%"style="text-align: center;" >Nilai <br>Range  (1-4)</th>
                    <th width="20%"style="text-align: center;" >Sub Total <br>Bobot x Nilai</th>
                </tr>
                <tr height="40">
                    <th style="text-align: center;" width="50" >1</th>
                    <th width="60%" style="text-align: left;" >- Kemampuan menganalisis permasalahan, kebutuhan fungsional dan non fungsional sistem <br>
                    - Kempuan membuat model/merancang sistem <br>
                    - Kemampuan membangun model/sistem kedalam bentuk prototype atau sistem</th>
                    <th  width="" style="text-align: center;">4</th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                <tr height="40">
                    <th style="text-align: center;" width="50" >2</th>
                    <th width="60%" style="text-align: left;" >- Kemampuan dalam menggunakan instrumen pengujian <br>
                    - Kemampuan menarik kesimpulan dan memberikan saran dan masukan untuk penelitian selanjutnya.</th>
                    <th  width=""  style="text-align: center;">4</th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                
                <tr height="40">
                    <th style="text-align: center;" width="50" >3</th>
                    <th width="60%" style="text-align: left;" >- Kesesuaian latar belakang penelitian, rumusan masalah, tujuan penelitian, landasan teori dan hasil penelitian serta kesimpulan</th>
                    <th  width="" style="text-align: center;">3</th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                
                <tr height="40">
                    <th style="text-align: center;" width="50" >4</th>
                    <th width="60%" style="text-align: left;" >Sistematika Penulisan dan Persentasi</th>
                    <th  width="" style="text-align: center;">2</th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                <tr height="40">
                    <th style="text-align: center;" width="50" colspan='2'>Total Bobot</th>
                    <th  width="" >13</th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                <tr height="40">
                    <th style="text-align: center;" width="50" colspan='2'>Nilai Akhir</th>
                    <th  width="" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                    <th width="20%"style="text-align: center;" ></th>
                </tr>
                
                
                
            </table>
            <table class="wordx-table" align="center">
                <tr>
                    <td colspan='3'>Ketentuan Penilaian:</td>
                </tr>
                <tr height='30'>
                     <td>Lulus</td><td align="center">:</td><td>Nilai Akhir >=2.65 </td>
                     
                </tr>
                <tr height='30'>
                     <td>Tidak Lulus</td><td align="center">:</td><td>Nilai Akhir < 2.65 </td>
                     
                </tr>
            <tr>
                    <td colspan='3'>Keterangan Penilaian:</td>
                </tr>
                <tr height='30'>
                     <td>Nilai 4 </td><td align="center">:</td><td>Diberikan jika mahasiswa dapat menjelaskan secara logis dan sistematis disertai dengan contoh, diagram atau bukti. </td>
                     
                </tr>
                <tr height='30'>
                     <td>Nilai 3 </td><td align="center">:</td><td>Diberikan jika mahasiswa dapat menjelaskan secara logis dan sistematis namun tidak dapat memberikan contoh, diagram dan bukti. </td>
                     
                </tr>
                <tr height='30'>
                     <td>Nilai 2 </td><td align="center">:</td><td>Diberikan jika  dapat menjelaskan tapi tidak  logis dan sistematis. </td>
                     
                </tr>
                <tr height='30'>
                     <td>Nilai 1 </td><td align="center">:</td><td>Diberikan jika  tidak dapat menjelaskan. </td>
                     
                </tr>
            </table>
           

           




        </div>
    </body>
</html>