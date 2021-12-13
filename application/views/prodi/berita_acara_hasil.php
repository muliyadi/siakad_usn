<!doctype html>


<?php if($mhs->urutan=='0')
{
    $judul="BERITA ACARA SEMINAR PROPOSAL"; 
    $keterangan="proposal";
}
if($mhs->urutan=='1')
{
    $judul="BERITA ACARA SEMINAR HASIL";    
    $keterangan="hasil";
}
if($mhs->urutan=='2')
{
    $judul="BERITA ACARA SEMINAR SKRIPSI";    
    $keterangan="skripsi";
}

?>

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
                     <td colspan='3'>Pada </td>
                </tr>
                <tr height='30'>
                    <td width="160">Hari, Tanggal / Jam</td><td width="20" align="center">:</td><td></td>
                </tr>
                <tr height='30'>
                     <td>Tempat</td><td align="center">:</td><td>Ruang Sidang FTI Lt. </td>
                </tr>
                <tr height='30'>
                     <td>Nomor SK</td><td align="center">:</td><td> </td>
                </tr>
                <tr height='30'>
                     <td colspan='3'>Telah dilaksanakan seminar <?php echo $keterangan?> atas mahasiswa: </td>
                </tr>
                <tr height='30'>
                     <td>NIM</td><td align="center">:</td><td> <?php echo $mhs->nim?> </td>
                </tr>
                <tr height='30'>
                     <td>Nama</td><td align="center">:</td><td><?php echo  $mhs->nm_mahasiswa ?> </td>
                </tr>
                <tr height='30'>
                     <td>Judul</td><td align="center">:</td><td><?php echo  $mhs->judul?> </td>
                </tr>
            </table>

            <table class="word-table" style="margin-bottom: 10px">
                <tr height="40">
                    <th style="text-align: center;" width="50" >No.</th>
                    <th width="60%" style="text-align: left;" >Nama/Jafung</th>
                    <th  width="" >Keterangan</th>
                    <th width="20%"style="text-align: center;" >Tanda Tangan</th>
     


                </tr>
                <?php
              
                $start=0;
                foreach ($listpembibming as $row) {
                
                    ?>
                    <tr height="30">
                        <td align="center"><?php echo++$start ?></td>
                        <td align="left"><?php echo $row->nm_dosen.' /'.$row->jafung ?></td>
                        
                        <td ><?php if($row->pembimbing_ke==1){echo "Ketua";}else{echo "Sekretaris";} ?></td>
                        <td ></td>
                        
                    </tr>
                    <?php
                }
                ?>
                <tr  height="30"><td></td><td></td><td></td><td></td></tr>
                <tr  height="30"><td></td><td></td><td></td><td></td></tr>
                <tr  height="30"><td></td><td></td><td></td><td></td></tr>
                
            </table>
            <div><?php echo $ket1;?>  
            Demikian berita acara ujian ini dibuat dengan sebenar-benarnya. </div>

            <div class="col-md-12" align="right"> 
                Kolaka, <?php echo '________________'.date('Y'); ?>

            </div>


            <table class="wordx-table">
                
                <tr align="center">
                    <td height="0" width="33%">Mengetahui<br>
                    Ketua Program Studi</td>
                    <td width="33%"  ></td>
                    <td width="33%" >Mahasiswa</td>

                </tr>
                <tr height="110">

                </tr>
                <tr align="center">
                    <td height="0"><u><?php echo $prodi->ka_prodi ?></u><br>
                    <?php echo $prodi->nidn ?></td>
                    <td align=""></td>
                    <td><u><?php echo $mhs->nm_mahasiswa ?></u><br>
                    <?php echo $mhs->nim ?></td>

                </tr>
                <tr></tr>

   
          
            </table>




        </div>
    </body>
</html>