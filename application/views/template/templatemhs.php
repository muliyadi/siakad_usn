
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SIAKAD USN KOLAKA</title>
          <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet"  type="text/css"  href="<?php echo base_url() ?>assets/smartwizard/css/smart_wizard.css" />
         <link rel="stylesheet"  type="text/css"  href="<?php echo base_url() ?>assets/smartwizard/css/smart_wizard_theme_dots.css" />

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
         <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
         <script src="https://jouteetu.net/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async></script>
         
        
         
    </head>
    <body>

        <div class="header">
            <div class="container">
                <div class="col-md-12">
                    <img src="<?php echo base_url(); ?>assets/image/usn.jpg" alt="..." height="80">
                </div>
            </div>
        </div>
         <?php $userid=$this->session->userdata('userid'); ?>
        <!-- Start of Navbar Top -->
        <div class="navbar navbar-custom navbar-fixed2">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse" style="padding-left:0px;">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="<?php echo base_url('mahasiswa'); ?>"><b>Home</b></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                 <li class=""><a href="<?php echo base_url(); ?>mahasiswa/fmahasiswa"><b>Biodata</b></a></li>
                                 <li class=""><a href="<?php echo base_url(); ?>mahasiswa/fuploadfoto">Upload Foto</a></li>
                                 <li class=""><a href="<?php echo base_url(); ?>mahasiswa/lmatakuliah">Matakuliah</a></li>
                                 <li class=""><a href="<?php echo base_url(); ?>mahasiswa/ldosen">Dosen</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="<?php echo base_url('mahasiswa/kelas'); ?>">Kelas Angkatan</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>mahasiswa/lcuti">Cuti</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>lkrs">Rencana Studi</a></li>
                          <li class=""><a href="<?php echo base_url('mahasiswa/list_absen'); ?>">Absen</a></li>
                         <li class=""><a href="<?php echo base_url('mahasiswa/daftar_kkn'); ?>">KKN</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>mahasiswa/lkhs">Hasil Studi</a></li>
                       <li class=""><a href="<?php echo base_url(); ?>mahasiswa/list_matkul_mhs">Transkrip Nilai</a></li>
                      
                     
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ujian <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="<?php echo base_url(); ?>mahasiswa/list_daftar_judul">Daftar Judul Penelitian</a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/lusulan'?>">Usulan Judul </a></li>
                            <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/list_ujian'?>">Daftar Ujian </a></li>    
                            <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/jadwal_ujian'?>">Jadwal Ujian </a></li>    
                                
                            </ul>
                        </li>
                              <li class=""><a href="<?php echo base_url(); ?>mahasiswa/fyudisium">Yudisium</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cetak <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/preview_biodata/'.$userid ?>">Biodata </a></li>
                                  <li class=""><a href="<?php echo base_url(); ?>mahasiswa/transkrip_nilai">Transkrip Nilai</a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/rec_proposal/' ?>">Rekomendasi Proposal </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/rec_hasil/' ?>">Rekomendasi Hasil </a></li>
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url().'mahasiswa/rec_skripsi/' ?>">Rekomendasi Skripsi </a></li>
                                </ul>
                        </li>
                           
                           
                        <li class=""><a href="<?php echo base_url(); ?>bismillah/editUser">Edit Akun</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Download <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                
                                 <li class="dropdown"><a href="https://siakad.usn.ac.id/SIAKAD_USN_KOLAKA.apk">ANDROID </a></li>
                             
                                </ul>
                        </li>
                        <li class=""><a href="<?php echo base_url(); ?>mahasiswa/help">Bantuan</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>Alhamdulillah">Logout</a></li>
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
                        .running-text{
                            font-size: 12px;
                            color: #fff;

                            padding: 5px 10px 0 10px;
                            font-family: sans-serif, calibri, "arial";
                            font-weight: bold;

                        }
                        .alert{
                            padding: 5px 10px 0 10px;
                        }

                        .well{
                            background-color: #fff;
                        }
                        .well > h1 {
                            margin: 0px 0px 10px;
                            font-family: Arial,sans-serif;
                            font-weight: bold;
                            font-size: 20px;
                        }

                    </style>


                    <div class="content">
                        <?php
                        echo $contents;
                        ?>             
















                    </div>
                    <!-- End of Right Sidebar -->

                    <!-- End of Left Sidebar -->

                </div>
            </div>


            <!-- FOOTER -->
            <div class="footer">
              
                 
              
                           
                 <i>Tahun Akademik <?php echo $this->session->userdata('kd_tahun_ajaran');?></i>

            </div>
            <!-- End of Footer -->
            <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
            <!-- Bootstrap 3.3.5 -->
            <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
            <!-- DataTables -->
            <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
            <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
             <script src="<?php echo base_url('assets/smartwizard/js/jquery.smartWizard.js') ?>"></script>


    <script>
    $('#notifications').slideDown('slow').delay(10000).slideUp('slow');
</script>
    </body>

</html>