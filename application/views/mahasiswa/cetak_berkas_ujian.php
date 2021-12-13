<?php

$servername    = "localhost";
$username    = "usng8127_siakad";
$password    = "adminadmin1234";
$dbname        = "usng8127_dbakademik";

$conn    = mysqli_connect ($servername, $username, $password, $dbname);
if (!$conn){
    die ("Connection Failed: ". mysqli_connect_error());
    }

// Koneksi library FPDF
require('fpdf/fpdf.php');
require('config/fungsi_indotgl.php');
// Setting halaman PDF
$pdf = new FPDF('P','mm',array(216,320));
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetMargins(20, 10, 10, 15);
if ($_GET['jenis']=='LR'){            
            $gambar = "foto/usn.png";
            $pdf->image($gambar, 15, 9, 27);
            
            $gambar1 = "foto/barcode.png";
            $pdf->image($gambar1, 177, 45, 27);

            $pdf->SetFont('Times', 'B', 13);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 5, 'Alamat: Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'Email: rektorat@usn.ac.id; Website: https://usn.ac.id', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(182, 1, '', 'B', 1, 'L');
            
            $pdf->SetFont('Arial','',10);
            $no=1;
            $query1 = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa a LEFT JOIN tbl_prodi b ON a.kode_prodi = b.kode_prodi WHERE a.nim_mhs = '$_GET[nim_mhs]'");
            $r = mysqli_fetch_array($query1);
            $pdf->ln(5);
            $pdf->SetFont('Courier', 'B', 12);
            $pdf->Cell(0, 10, '*** RINCIAN DATA PEMBAYARAN ***', 0, 1, 'C');
            $pdf->SetFont('Courier', '', 11);
            // Setting spasi kebawah supaya tidak rapat
            $pdf->Cell(40, 7, 'Nomor Induk', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nim_mhs'], 0, 1, 'L');

            $pdf->Cell(40, 7, 'Nama Mahasiswa', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nam_mhs'], 0, 1, 'L');

            $pdf->Cell(40, 7, 'Program Studi', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nama_prodi'], 0, 1, 'L');
            $pdf->ln(3);

            $query = mysqli_query($conn, "SELECT * FROM tbl_bayar a LEFT JOIN tbl_mahasiswa b ON a.nim_mhs = b.nim_mhs LEFT JOIN tbl_jenis c ON a.kode_jns = c.kode_jns LEFT JOIN tbl_bank d ON a.kode_bank = d.kode_bank LEFT JOIN tbl_tahun e ON a.kode_ta = e.kode_ta WHERE a.nim_mhs = '$_GET[nim_mhs]' ORDER BY a.tgl_byr ASC ");

            // Setting spasi kebawah supaya tidak rapat

            $pdf->SetFont('Courier','',10);
            $pdf->Cell(10,7,'No',1,0,'C');
            $pdf->Cell(20,7,'Tahun',1,0,'C');
            $pdf->Cell(42,7,'Pembayaran',1,0,'C');
            $pdf->Cell(30,7,'Jumlah',1,0,'C');
            $pdf->Cell(30,7,'Tanggal',1,0,'C');
            $pdf->Cell(30,7,'No Seri',1,0,'C');
            $pdf->Cell(20,7,'Bank',1,1,'C');
            $pdf->SetFont('Courier','',9);
                while ($iyes = mysqli_fetch_array($query)){
                    $pdf->Cell(10,6,$no++,1,0,'C');
                    $pdf->Cell(20,6,$iyes['kode_ta'],1,0,'C');
                    $pdf->Cell(42,6,$iyes['nama_jns'].' '.$iyes['ket_byr'],1,0);
                    $pdf->Cell(30,6,rupiah($iyes['jml_byr']),1,0,'R');
                    $pdf->Cell(30,6,date("d-m-Y",strtotime($iyes['tgl_byr'])),1,0,'C');
                    $pdf->Cell(30,6,$iyes['nomr_byr'],1,0,'C');
                    $pdf->Cell(20,6,$iyes['nama_bank'],1,1,'C');
                }

            $kabag = mysqli_query($conn, "SELECT * FROM tbl_kabag");
            $i = mysqli_fetch_array($kabag);
            $pdf->ln(5);
            $pdf->SetFont('Courier','',11);
            $tgl = date('Y-m-d');
            $pdf->Cell(180, 7, 'Kolaka, '.tgl_indo($tgl), 0, 1, 'L');
            $pdf->Cell(15, 7, 'Kabag Keuangan,');
            $pdf->Cell(15, 20, '',0,1,'L');
            $pdf->Cell(70, 7, $i['nam_kabag'],0,1,'L');
            $pdf->Cell(70, 5, 'NIP.'.$i['nip_kabag'], 0, 1, 'L');

        $pdf->Output("","I");
}else{
            $gambar = "foto/usn.png";
            $pdf->image($gambar, 15, 9, 27);
            
            $gambar1 = "foto/barcode.png";
            $pdf->image($gambar1, 20, 150, 27);

            $pdf->SetFont('Times', 'B', 13);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 5, 'Alamat: Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(25);
            $pdf->Cell(0, 5, 'Email: rektorat@usn.ac.id; Website: https://usn.ac.id', 0, 0, 'C');
            $pdf->ln(5);
            $pdf->Cell(180, 1, '', 'B', 1, 'L');
            
            $pdf->SetFont('Arial','',10);
            $no=1;
            $query1 = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa a LEFT JOIN tbl_prodi b ON a.kode_prodi = b.kode_prodi LEFT JOIN tbl_fakultas c ON b.kode_fak = c.kode_fak WHERE a.nim_mhs = '$_GET[nim_mhs]'");
            $r = mysqli_fetch_array($query1);
            if($r['tgl_ket'] == '0000-00-00'){
                $tglydsm = '-';
            }else{
                $tglydsm = tgl_indo($r['tgl_ket']);;
            }
            if($r['nom_ket']!=''){
                $skydsm = $r['nom_ket'];
            }else{
                $skydsm = '-';
            }
            $pdf->ln(5);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'SURAT KETERANGAN PEMBAYARAN', 0, 1, 'C');
            $pdf->SetFont('Courier', '', 12);
            $pdf->Cell(0, 3, 'Nomor.   /'.$r['kode_prodi'].'/KU/2019', 0, 1, 'C');
            $pdf->Cell(0, 7, '', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 11);
            // Setting spasi kebawah supaya tidak rapat
            $pdf->Cell(50, 7, 'Yang bertanda tangan di bawah ini menerangkan bahwa:', 0, 1, 'L');
            
            $pdf->Cell(50, 7, 'Nama Mahasiswa', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nam_mhs'], 0, 1, 'L');

            $pdf->Cell(50, 7, 'Nomor Induk', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nim_mhs'], 0, 1, 'L');

            $pdf->Cell(50, 7, 'Tanggal Yudisium', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $tglydsm, 0, 1, 'L');

            $pdf->Cell(50, 7, 'Nomor Surat Keputusan', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $skydsm, 0, 1, 'L');

            $pdf->Cell(50, 7, 'Program Studi', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nama_prodi'], 0, 1, 'L');

            $pdf->Cell(50, 7, 'Fakultas', 0, 0, 'L');
            $pdf->Cell(2, 7, ':', 5, 0, 'C');
            $pdf->Cell(10, 7, $r['nama_fak'], 0, 1, 'L');            

            $pdf->MultiCell(180, 7, 'Bahwa yang tersebut namanya di atas, tidak mempunyai tanggungan pembayaran UKT/SPP dan layanan pendidikan lainnya di Universitas Sembilanbelas November Kolaka sejak semester awal sampai dengan akhir semester (Rincian Pembayaran Terlampir).');

            $pdf->Cell(0, 5, '', 0, 1, 'C');
            $pdf->Cell(50, 7,'Demikian surat keterangan ini diberikan untuk dipergunakan sebagaimana mestinya.', 0, 1, 'L');
            
            $kabag = mysqli_query($conn, "SELECT * FROM tbl_kabag");
            $i = mysqli_fetch_array($kabag);
            $pdf->setXY(120,150);
            $tgl = date('Y-m-d');
            $pdf->Cell(15, 8, 'Kolaka, ', 0, 0, 'L');
            $pdf->Cell(5, 8, tgl_indo($tgl), 00, 0, 'L');
            
            $pdf->setXY(120,157);
            $pdf->SetFont('arial', '', 10);
            $pdf->Cell(70, 8, 'Kabag Keuangan,');

            $pdf->setXY(120,180);
            $pdf->SetFont('arial', 'B', 10);
            $pdf->Cell(70, 8, $i['nam_kabag']);
            $pdf->setXY(120,185);
            $pdf->SetFont('arial', '', 10);
            $pdf->Cell(70, 8, 'NIP.'.$i['nip_kabag'], 0, 1, 'L');

            $pdf->ln(10);
            $pdf->Cell(50, 7, 'Tembusan:', 0, 1, 'L');
            $pdf->Cell(50, 5, '1. Ketua SPI USN Kolaka', 0, 1, 'L');
            $pdf->Cell(50, 5, '2. Ka. Biro Umum dan Keuangan USN Kolaka', 0, 1, 'L');  
            
        $pdf->Output("","I");
}
?>