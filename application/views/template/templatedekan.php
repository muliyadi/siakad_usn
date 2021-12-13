<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SIAKAD USN KOLAKA </title>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/image/logo.jpg">

               <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!--<link rel="stylesheet" href="<?php echo base_url() ?>assets/ionicons-2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/style-usulan.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">

        <!-- Script untuk Back to Top-->
        <script>
            jQuery(document).ready(function() {
                var offset = 220;
                var duration = 500;
                jQuery(window).scroll(function() {
                    if (jQuery(this).scrollTop() > offset) {
                        jQuery('.back-to-top').fadeIn(duration);
                    } else {
                        jQuery('.back-to-top').fadeOut(duration);
                    }
                });

                jQuery('.back-to-top').click(function(event) {
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0}, duration);
                    return false;
                })
            });
        </script>

        <!-- JS untuk upload file -->
        <script>
            $('input[type=file]').bootstrapFileInput();
            $('.file-inputs').bootstrapFileInput();
        </script>

        


    </head>
    <body>
        <div class="container-fluid">
        <!-- Navbar Top -->
        <!-- Header -->
        <div class="header">
            <div class="container-fluid">
<div class="col-md-9">
				 <img src="<?php echo base_url(); ?>assets/image/usn.jpg" alt="..." height="80"	>
				</div>
				<div class="col-md-3">
				<table class="table">
					<tr>
					<td>
					User ID : <?php echo $this->session->userdata('userid');?>
					</td>
					</tr>
					
                   <tr>
				   <td>
				   Level Akses/Homebase	:  <?php echo $this->session->userdata('level').'/'.$this->session->userdata('home_base');?>
				   </td></tr>
				   </table>
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
                        <li class=""><a href="<?php echo base_url('dekan');?>"><b>Home</b></a></li>
						  <li class=""><a href="<?php echo base_url('dekan/kkn');?>">KKN</a></li> 
						   <li class="dropdown"><a href="<?php echo base_url(); ?>dekan/list_akses_nilai">Izin Akses Nilai</a></li>
						  <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>dekan/data_mhs_fak">Mahasiswa </a>
                                </li>
                                <li class="dropdown"><a href="<?php echo base_url(); ?>dekan/laporan_status_mhs">Status Mahasiswa</a></li>
                                

                            </ul>

                        </li> 
						   <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a tabindex="-1" href="<?php echo base_url() ?>dekan/laporan_rekap_reg_krs">Status Mahasiswa </a>
                                </li>
                                <li class="dropdown"><a href="<?php echo base_url(); ?>dekan/form_rekap_krs_mhs">Rekap KRS</a></li>
                                

                            </ul>

                        </li> 
                 
						 <li class=""><a href="<?php echo base_url();?>bismillah/editUser">Ubah Password</a></li>
                        <li class=""><a href="<?php echo base_url();?>bismillah/logout">Keluar</a></li>

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


                    <div class="">
                        <?php
                        echo $contents;

                        ?>             








                        







                    </div>
                    <!-- End of Right Sidebar -->

                    <!-- End of Left Sidebar -->

                </div>
            </div>


            <!-- FOOTER -->
                <div class="container">

            <div class="footer">
            


                    <div class="col-md-12 ">
                        <h6> Copyright © 2017. DIKEMBANGKAN OLEH: UPT TIK USN KOLAKA</h6>
                    </div>


                    <a class="back-to-top" href="#"> Kembali ke Atas</a>


                </div>

            </div>
            </div>
            <!-- End of Footer -->

    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>



    </body>
</html>