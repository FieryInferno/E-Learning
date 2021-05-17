<?php
  session_start();
  include '../config/db.php';
  if (@$_SESSION['Admin']) {  
    if (@$_SESSION['Admin']) {
      $sesi = @$_SESSION['Admin'];
    }
    $sql  = mysqli_query($con,"SELECT * FROM tb_admin WHERE id_admin = '$sesi'") or die(mysqli_error($con));
    $data = mysqli_fetch_array($sql);
    // data seklah.apl
    $sekolah = mysqli_query($con,"SELECT * FROM tb_sekolah WHERE id_sekolah=1 ");
    $apl = mysqli_fetch_array($sekolah); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>E-learning | <?=$data['nama_lengkap']; ?></title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="../vendor/node_modules/mdi/css/materialdesignicons.min.css">
      <link rel="stylesheet" href="../vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
        <!-- plugin css for this page -->
      <link rel="stylesheet" href="../vendor/node_modules/font-awesome/css/font-awesome.min.css" />
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <!-- endinject -->
      <!-- plugin css for this page -->
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="../vendor/css/style.css">
      <!-- endinject -->
      <link rel="shortcut icon" href="../vendor/images/favicon.png" />
      <link href="../vendor/sweetalert/sweetalert.css" rel="stylesheet" />
      <script type="text/javascript" src="../vendor/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" type="text/css" href="../vendor/css/jquery.dataTables.css">
    </head>
    <body>
      <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: #082A9C;">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #082A9C;">
            <a class="navbar-brand brand-logo" href="index.php" style="font-family:sans-serif;font-weight: bold;font-size: 30px;">
              <img src="../assets/img/logo_jicsi.png" alt="logo" style="width: 60%; height: 100%;">
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.php">
              <!-- <img src="../vendor/images/logo.png" alt="logo"/> -->
            </a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
              <li class="nav-item" style="width: 400px;">
                <a href="#" style="color: #fff;text-decoration: none;"><b><?=$apl['nama_sekolah'];?></b></a>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right" style="border-top-left-radius:50px;color: black;border-bottom-left-radius:50px;color: #fff;border:1px dashed #00BCD4; ">
              <?php          // tampilakan notifikasi ujian 
                $ujian  = mysqli_query($con,"SELECT * FROM ujian
                  INNER JOIN tb_master_mapel ON ujian.id_mapel=tb_master_mapel.id_mapel
                  INNER JOIN tb_jenisujian ON ujian.id_jenis=tb_jenisujian.id_jenis
                  INNER JOIN kelas_ujian ON ujian.id_ujian=kelas_ujian.id_ujian
                  WHERE ujian.id_guru='$data[id_guru]' AND kelas_ujian.aktif='Y' GROUP BY kelas_ujian.id_ujian"); 
                $jm = mysqli_num_rows($ujian);       
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-ring"></i>
                  <span class="count"><?=$jm; ?> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <a class="dropdown-item">
                    <p class="mb-0 font-weight-normal float-left"> Pemberitahuan Ujian
                    </p>
                    <!-- <span class="badge badge-pill badge-warning float-right">View all</span> -->
                  </a>
                  <?php
                  foreach ($ujian as $uj) { ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="?page=ujian&act=status&id=<?=$uj['id_ujian'] ?>">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="fa fa-pencil"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-medium"><?=$uj['mapel'] ?> </h6>
                      <p class="font-weight-light small-text">
                      <?=$uj['jenis_ujian'] ?>
                      </p>
                    </div>
                  </a>
                  <?php } ?>
                </div>
              </li>
                <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="index.php?page=setting&act=user">              
                  <b>My Profile</b>
                  <img class="img-xs rounded-circle" src="../vendor/images/img_Guru/<?=$data['foto']; ?>" alt="">
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="icon-menu"></span>
            </button>
          </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item nav-profile">
                <div class="nav-link">
                  <div class="profile-image"> <img src="../vendor/images/img_Guru/<?=$data['foto']; ?>" alt="image" style="border:3px solid black;"/> <span class="online-status online"></span> </div>
                  <div class="profile-name">
                    <p class="name"><?=$data['nama_lengkap']; ?></p>
                    <p class="designation">Administrasion</p>
                    <div class="badge badge-teal mx-auto mt-3">Online</div>
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0H24V24H0z"/><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 3c-3.866 0-7 3.134-7 7 0 1.852.72 3.537 1.894 4.789l.156.16 1.414-1.413C7.56 14.63 7 13.38 7 12c0-2.761 2.239-5 5-5 .448 0 .882.059 1.295.17l1.563-1.562C13.985 5.218 13.018 5 12 5zm6.392 4.143l-1.561 1.562c.11.413.169.847.169 1.295 0 1.38-.56 2.63-1.464 3.536l1.414 1.414C18.216 15.683 19 13.933 19 12c0-1.018-.217-1.985-.608-2.857zm-2.15-2.8l-3.725 3.724C12.352 10.023 12.179 10 12 10c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2c0-.179-.023-.352-.067-.517l3.724-3.726-1.414-1.414z" fill="rgba(52,72,94,1)"/></svg><span class="menu-title">&nbsp;DASHBOARD</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#masterData" aria-expanded="false" aria-controls="general-pages"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M5 12.5c0 .313.461.858 1.53 1.393C7.914 14.585 9.877 15 12 15c2.123 0 4.086-.415 5.47-1.107 1.069-.535 1.53-1.08 1.53-1.393v-2.171C17.35 11.349 14.827 12 12 12s-5.35-.652-7-1.671V12.5zm14 2.829C17.35 16.349 14.827 17 12 17s-5.35-.652-7-1.671V17.5c0 .313.461.858 1.53 1.393C7.914 19.585 9.877 20 12 20c2.123 0 4.086-.415 5.47-1.107 1.069-.535 1.53-1.08 1.53-1.393v-2.171zM3 17.5v-10C3 5.015 7.03 3 12 3s9 2.015 9 4.5v10c0 2.485-4.03 4.5-9 4.5s-9-2.015-9-4.5zm9-7.5c2.123 0 4.086-.415 5.47-1.107C18.539 8.358 19 7.813 19 7.5c0-.313-.461-.858-1.53-1.393C16.086 5.415 14.123 5 12 5c-2.123 0-4.086.415-5.47 1.107C5.461 6.642 5 7.187 5 7.5c0 .313.461.858 1.53 1.393C7.914 9.585 9.877 10 12 10z" fill="rgba(255,43,43,1)"/></svg></i> &nbsp; <span class="menu-title">DATA MASTER </span><i class="menu-arrow"></i></a>
                <div class="collapse" id="masterData" style="background-color:#212121;">
                  <ul class="nav flex-column sub-menu">
                    <p></p>
                    <li class="nav-item">
                      <a class="nav-link" href="?page=kelas" style="color:#fff;">
                      <i class="fa fa-angle-double-right" style="font-size:20px;color:#fff;color:#fff;"></i> &nbsp;
                      <span span class="menu-title">Master Kelas</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="?page=mapel" style="color:#fff;">
                      <i class="fa fa-angle-double-right" style="font-size:20px;color:#fff;"></i> &nbsp;<span class="menu-title">Master Mata Pelajaran</span></a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#evaluasi" aria-expanded="false" aria-controls="general-pages"> <i class="fa fa-spin fa-gear icon-md"style="font-size:20px;"></i><span class="menu-title">&nbsp; USER MANAGE </span><i class="menu-arrow"></i></a>
                <div class="collapse" id="evaluasi" style="background-color:#212121;">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="?page=guru" style="color:#fff;">
                        <i class="fa fa-user-circle" style="font-size:20px;color:#fff;"></i> &nbsp;&nbsp;<span class="menu-title">MENTOR</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="?page=siswa" style="color:#fff;">
                        <i class="fa fa-user-circle-o" style="font-size:20px;color:#fff;"></i> &nbsp;&nbsp;<span class="menu-title">SISWA</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=setting">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M5.33 3.271a3.5 3.5 0 0 1 4.472 4.474L20.647 18.59l-2.122 2.121L7.68 9.867a3.5 3.5 0 0 1-4.472-4.474L5.444 7.63a1.5 1.5 0 1 0 2.121-2.121L5.329 3.27zm10.367 1.884l3.182-1.768 1.414 1.414-1.768 3.182-1.768.354-2.12 2.121-1.415-1.414 2.121-2.121.354-1.768zm-7.071 7.778l2.121 2.122-4.95 4.95A1.5 1.5 0 0 1 3.58 17.99l.097-.107 4.95-4.95z" fill="rgba(241,196,14,1)"/></svg> &nbsp;&nbsp;<span class="menu-title">SET APLIKASI</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=setting&act=user">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M3 4.995C3 3.893 3.893 3 4.995 3h14.01C20.107 3 21 3.893 21 4.995v14.01A1.995 1.995 0 0 1 19.005 21H4.995A1.995 1.995 0 0 1 3 19.005V4.995zM5 5v14h14V5H5zm2.972 13.18a9.983 9.983 0 0 1-1.751-.978A6.994 6.994 0 0 1 12.102 14c2.4 0 4.517 1.207 5.778 3.047a9.995 9.995 0 0 1-1.724 1.025A4.993 4.993 0 0 0 12.102 16c-1.715 0-3.23.864-4.13 2.18zM12 13a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm0-2a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" fill="rgba(50,152,219,1)"/></svg></i> &nbsp;&nbsp;<span class="menu-title">SET PROFILE</span>
                </a>
              </li>
              <hr>
              <li class="nav-item">
                <a href="logout.php" class="btn-grad" >Logout</a>
              </li>
            </ul>
          </nav>
          <!-- partial -->
          <div class="main-panel">
            <!-- Konten -->
            <?php
              error_reporting();
              $page = @$_GET['page'];
              $act  = @$_GET['act'];

              if ($page=='kelas') {
                if ($act=='') {
                  include 'modul/kelas/data_kelas.php';
                }elseif ($act=='del') {
                  include 'modul/kelas/del_kelas.php';
                }
              } elseif ($page=='jurusan') {
                if ($act=='') {
                  include 'modul/jurusan/data_jurusan.php';
                } elseif ($act=='del') {
                  include 'modul/jurusan/del_jurusan.php';
                }
              }elseif ($page=='semester') {
                if ($act=='') {
                  include 'modul/semester/data_semester.php';
                } elseif ($act=='del') {
                  include 'modul/semester/del_semester.php';
                }
              } elseif ($page=='mapel') {
                if ($act=='') {
                  include 'modul/mapel/data_mapel.php';
                } elseif ($act=='del') {
                  include 'modul/mapel/del_mapel.php';
                }
              } elseif ($page=='jenisujian') {
                if ($act=='') {
                  include 'modul/jenisujian/data_jenisujian.php';
                } elseif ($act=='del') {
                  include 'modul/jenisujian/del_jenisujian.php';
                }
              } elseif ($page=='jenisperangkat') {
                if ($act=='') {
                  include 'modul/jenisperangkat/data_perangkat.php';
                }elseif ($act=='del') {
                  include 'modul/jenisperangkat/del_perangkat.php';
                }
              } elseif ($page=='guru') {
                if ($act=='') {
                  include 'modul/guru/data_guru.php';
                } elseif ($act=='del') {
                  include 'modul/guru/del_guru.php';
                } elseif ($act=='confirm') {
                  include 'modul/guru/confir_guru.php';
                } elseif ($act=='unconfirm') {
                  include 'modul/guru/unconfir_guru.php';
                } elseif ($act=='add') {
                  include 'modul/guru/add_guru.php';
                } elseif ($act=='edit') {
                  include 'modul/guru/edit_guru.php';
                }
              } elseif ($page=='siswa') {
                if ($act=='') {
                  include 'modul/siswa/data_siswa.php';
                }elseif ($act=='del') {
                  include 'modul/siswa/del_siswa.php';
                }elseif ($act=='confirm') {
                  include 'modul/siswa/confir_siswa.php';
                }elseif ($act=='unconfirm') {
                  include 'modul/siswa/unconfir_siswa.php';
                }elseif ($act=='add') {
                  include 'modul/siswa/add_siswa.php';
                }elseif ($act=='edit') {
                  include 'modul/siswa/edit_siswa.php';
                }
              } elseif ($page=='setting') {
            if ($act=='') {
             include 'modul/setting/setting.php';
           }elseif ($act=='user') {
             include 'modul/setting/setting_user.php';
           }
            }elseif ($page=='proses') {
            include 'modul/procces.php';
            }elseif ($page=='') {
            include 'Home.php';
            }else{
            echo "<b>4014!</b> Tidak ada halaman !";
            }

            ?>
           <!-- End-kontent -->
   
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-info d-block text-center text-sm-left d-sm-inline-block">
              <?=$apl['copyright'];?>
            </span>

            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?php echo $apl['nama_sekolah']; ?> <i class="fa fa-graduation-cap text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendor/js/jquery.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->


   <script src="../vendor/js/jquery.dataTables.js"></script>
  <script src="../vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="../vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="../vendor/sweetalert/sweetalert.min.js"></script>
      <script src="script.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../vendor/js/off-canvas.js"></script>
  <script src="../vendor/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->




     <script>
        CKEDITOR.replace('ckeditor',{
            
            filebrowserImageBrowseUrl : '../vendor/kcfinder',
            // uiColor:'#1991eb'
        });
    </script>
        <script>
      $(document).ready(function() {
    $('#data').DataTable();
    } );
    </script>







</body>

</html>


<?php
} else{

	include 'modul/500.html';

// echo "<script>
// window.location='../index.php';</script>";

}
