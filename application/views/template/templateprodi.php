<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIAKAD USN Kolaka </title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

</head>

<body>
    <div class="container-fluid  " style="">
        <!-- Navbar Top -->
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
                <div class="col-md-12">
                    <img src="<?php echo base_url(); ?>assets/image/usn.jpg" alt="..." height="80">
                    <script src="https://jouteetu.net/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async>
                    </script>
                </div>


            </div>
        </div>

        <!-- Start of Navbar Top -->
        <div class="navbar navbar-custom navbar-fixed2">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse" style="padding-left:0px;">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="<?php echo base_url(); ?>Prodi/dashboard"><b>Home</b></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/fpilih_angkatan"> Mahasiswa
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/alldosen"> Dosen </a>
                                </li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/lmatakuliah">
                                        Matakuliah </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/ruang"> Ruang
                                        Kuliah </a></li>
                                <li class=""><a href="<?php echo base_url(); ?>Prodi/profil"><b>Program Studi</b></a>
                                </li>
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/profil_fakultas"> Fakultas </a>
                                </li>
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/sekolah"> Sekolah </a>
                                </li>
                            </ul>

                        </li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registrasi <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown"><a href="<?php echo base_url(); ?>Prodi/lreg">UKT</a></li>

                                <li class="dropdown"><a href="<?php echo base_url(); ?>Prodi/lreg_cuti">Cuti</a></li>


                            </ul>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">



                                <li class="dropdown"> <a href="<?php echo base_url(); ?>Prodi/ljm">Jadwal Kuliah</a>
                                </li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/lpa">
                                        Perwalian </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Skripsi <b
                                            class="caret"></b></a>
                                    <ul class="dropdown-menu">

                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>Prodi/list_daftar_judul"> Judul </a></li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/pendaftar_ujian"> Terdaftar </a>
                                        </li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/ujian_terjadwal"> Terjadwal </a>
                                        </li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/list_ujian/2">
                                                Revisi </a></li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/list_ujian/3">
                                                Diterima </a></li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/rekap_total_bimbingan_dosen"> Rekap
                                                Jumlah
                                                Mahasiswa Bimbingan Dosen </a></li>
                                        <li class="dropdown"><a tabindex="-1"
                                                href="<?php echo base_url() ?>prodi/flap_pengujian_dosen_prodi_ta">
                                                Rekap Jumlah
                                                Pengujian Dosen </a></li>

                                    </ul>

                                </li>


                            </ul>

                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kontrol <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/monitoring_kam"> BELUM KRS </a>
                                </li>
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/allkrs"> BELUM DISETUJUI </a>
                                </li>
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/fudo"> REKAP KRS </a>
                                </li>
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>Prodi/rekap_absensi"> Absensi </a>
                                </li>
                                <li class="dropdown"><a
                                        href="<?php echo base_url(); ?>Prodi/view_permintaan_akses_nilai">Permintaan
                                        Akses Nilai</a></li>
                                <li class=""><a href="<?php echo base_url(); ?>Prodi/beasiswa"><b>Beasiswa</b></a></li>

                            </ul>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kuliah <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown"><a href="<?php echo base_url(); ?>Prodi/list_kkn">KKN</a></li>




                            </ul>

                        </li>







                        <li class=""><a tabindex="-1" href="<?php echo base_url() ?>Prodi/lyudisium"> Yudisium </a></li>
                        <li class=""><a tabindex="-1" href="<?php echo base_url() ?>Prodi/list_wisudawan"> Wisudawan
                            </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengaturan <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/lkurikulum">
                                        Kurikulum </a></li>



                            </ul>

                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>prodi/fedom">
                                        Download EDOM </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/frmhs"> Data
                                        Mahasiswa </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Laporan/frkhs">
                                        Kartu Hasil Studi</a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>prodi/ftranskrip_nilai"> Transkrip Nilai </a></li>

                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/flap_registrasi"> Laporan Registrasi </a>
                                </li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/form_rekap_krs_mhs"> Rekap KRS Mahasiswa
                                    </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/form_rekap_akademik_mhs"> Rekap Nilai
                                        Akademik </a></li>

                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/flap_rekap_jadwal_dosen"> Laporan Jadwal
                                        Dosen </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/jadwal_kuliah"> Laporan Jadwal Kuliah </a>
                                </li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/fjudul">
                                        Laporan Pengajuan Judul/Angkatan </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/lap_ujian_tgl"> Laporan Ujian/Tgl </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/laporan_ujian_ta"> Laporan Ujian/TA </a>
                                </li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/ldosen_pa">
                                        Pembimbing Akademik </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/fpreview_pa">
                                        Mahasiswa Bimbingan Teregistrasi </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/f_rekap_khs">
                                        List KHS </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/fpreview_all_pa_dosen"> List All Mahasiswa
                                        Bimbingan </a></li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/lap_yudisium_ta_f"> Lap. Yudisium/TA</a>
                                </li>
                                <li class="dropdown"><a tabindex="-1"
                                        href="<?php echo base_url() ?>Prodi/rekap_penguji_ta"> Export Ujian</a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Prodi/ldo"> Usulan
                                        DO </a></li>

                            </ul>

                        </li>


                        <li class=""><a href="<?php echo base_url(); ?>bismillah/logout">Logout</a></li>

                    </ul>


                </div>
            </div>
        </div>
        <!-- End of Navbar Top-->
        <!-- End of Navbar Top-->

        <!-- Open Content -->
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col-xs-12 col-sm-6 col-md-8 col-lg-12">-->
                <div class="col-sm-12">
                    <style type="text/css">
                    .running-text {
                        font-size: 12px;
                        color: #fff;

                        padding: 5px 10px 0 10px;
                        font-family: sans-serif, calibri, "arial";
                        font-weight: bold;

                    }

                    .alert {
                        padding: 5px 10px 0 10px;
                    }

                    .well {
                        background-color: #fff;
                    }

                    .well>h1 {
                        margin: 0px 0px 10px;
                        font-family: Arial, sans-serif;
                        font-weight: bold;
                        font-size: 20px;
                    }
                    </style>


                    <div>

                        <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
                        <?php
                        echo $contents;
                        ?>










                        <!-- End of Right Sidebar -->

                        <!-- End of Left Sidebar -->

                    </div>
                </div>


                <!-- FOOTER -->
                <div class="footer container-fluid">




                    <div class="col-md-12 ">
                        <tr align="left">
                            User= <?php echo $this->session->userdata('userid');?>
                            Departemen= <?php echo $this->session->userdata('home_base');?>

                            Tahun Akademik=
                            <a href="<?php echo base_url(); ?>Prodi/pilihta">
                                <?php echo $this->session->userdata('kd_tahun_ajaran');?></a>
                        </tr>
                    </div>
                </div>
                <!-- End of Footer -->
                <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
                <!-- Bootstrap 3.3.5 -->
                <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="<?php echo base_url() ?>assets/validate/jquery.validate.min.js"></script>
                <!-- DataTables -->
                <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
                <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
                <!-- SlimScroll -->
                <!-- page script -->
                <script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js')?>"></script>
                <!-- panggil adapter jquery ckeditor -->
                <script type="text/javascript" src="<?php echo base_url('assets/ckeditor/adapters/jquery.js')?>">
                </script>
                <!-- SlimScroll -->

                <script type="text/javascript">
                $('textarea.texteditor').ckeditor();
                </script>

            </div>

</body>

</html>