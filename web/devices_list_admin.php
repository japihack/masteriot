<?php
  session_start();
  $logged = $_SESSION['logged'];

  if(!$logged || $_SESSION['user_id' != 5]){
    echo "Ingreso no autorizado";
    die();
    //echo '<meta http-equiv="refresh" content="1; url=login.php">';
  }

  $conn = mysqli_connect("localhost","admin_masteriot","j65966298","admin_masteriot");
  if ($conn==false){
    echo "Error al conectarse a la BBDD";
    die();
  }

  $result = $conn->query("SELECT * FROM `estaciones`");
  $devices = $result->fetch_all(MYSQLI_ASSOC);

  $result_users = $conn->query("SELECT * FROM `mqtt_user`");
  $mqtt_users = $result_users->fetch_all(MYSQLI_ASSOC);

  //echo(count($mqtt_users));

  $count = count($devices);

  if ($count == 1){
    $_SESSION['user_id'] = $users[0]['user_id'];
    $_SESSION['user_email'] = $users[0]['user_email'];

    //$msg .="Logueado con éxito!";
    $_SESSION['logged'] = true;
    if ($_SESSION['user_id'] === 5){
    }
  }


?>



<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>IoT Hogar</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">

                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                  <ul id="sidebarnav">
                      <!-- User Profile-->
                      <li class="sidebar-item pt-2">
                          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                              aria-expanded="false">
                              <i class="far fa-clock" aria-hidden="true"></i>
                              <span class="hide-menu">Dashboard</span>
                          </a>
                      </li>

                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                              href="devices.php" aria-expanded="false">
                              <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Dispositivos</span></a>
                      </li>
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                              href="devices_list_admin.php" aria-expanded="false">
                              <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Listado Dispositivos</span></a>
                      </li>
                      <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                              href="logout.php" aria-expanded="false"><i class="fa fa-table"
                                  aria-hidden="true"></i><span class="hide-menu">Cerrar sesión</span></a>
                      </li>
                  </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Dispositivos</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <i class="fas fa-user" aria-hidden="true"></i><span class="hide-menu"><?php echo($_SESSION['user_email']) ?></span></a>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">User_id</th>
                                            <th class="border-top-0">Serie</th>
                                            <th class="border-top-0">Alias</th>
                                            <th class="border-top-0">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($devices as $device) {?>
                                        <tr>
                                            <td><?php echo $device['estaciones_id'] ?></td>
                                            <td><?php echo $device['estaciones_user_id'] ?></td>
                                            <td><?php echo $device['estaciones_serie'] ?></td>
                                            <td><?php echo $device['estaciones_alias'] ?></td>
                                            <td><?php echo $device['estaciones_date'] ?></td>
                                            <td><a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Id</th>
                                            <th class="border-top-0">Usuario</th>
                                            <th class="border-top-0">Password</th>
                                            <th class="border-top-0">Es Superusuario?</th>
                                            <th class="border-top-0">Fecha alta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($mqtt_users as $mqtt_user) {?>
                                        <tr>
                                            <td><?php echo $mqtt_user['id'] ?></td>
                                            <td><?php echo $mqtt_user['username'] ?></td>
                                            <td><?php echo $mqtt_user['password'] ?></td>
                                            <td><?php echo $mqtt_user['is_superuser'] ?></td>
                                            <td><?php echo $mqtt_user['created'] ?></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                      </div>


                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>
