<?php
  session_start();
  $logged = $_SESSION['logged'];

  if(!$logged){
    echo "Ingreso no autorizado";
    die();
    //echo '<meta http-equiv="refresh" content="1; url=login.php">';

  }

  $conn = mysqli_connect("localhost","admin_masteriot","j65966298","admin_masteriot");

  if ($conn==false){
    echo "Error al conectarse a la BBDD";
    die();
  }

  $alias="";
  $serie="";
  $user_id=$_SESSION['users_id'];
  $msg="";

  $estaciones_result = $conn->query("SELECT * FROM `estaciones` WHERE `estaciones_user_id` = ".$user_id);
  $estaciones = $estaciones_result->fetch_all(MYSQLI_ASSOC);


  if (isset($_POST['serie']) && isset($_POST['alias'])) {
    $alias = $_POST['alias'];
    $serie = $_POST['serie'];
    //$serie = strip_tags($_POST['serie']);
    //$user_id = $_SESSION['user_mqtt_id']; //el id del usuario registrado en la ACL. mqtt_user.


    $conn->query("INSERT INTO `estaciones` (`estaciones_serie`, `estaciones_alias`, `estaciones_user_id`) VALUES ('".$serie."', '".$alias."', '".$user_id."');");
    //$conn->query("INSERT INTO `estaciones` (`estaciones_serie`, `estaciones_alias`, `estaciones_user_id`) VALUES ('".$serie."', '".$alias."', '".$user_id."');");
    $msg = "usuario: ". $user_id . " - alias: " . $alias . " agregado con éxito";
    if ($conn == true){

      echo($msg);
    } else{
      //$msg .= "exito? - " . $exito . " - " . "alias - " . $alias . " serie - " . $serie . " user_id - " . $user_id;
    }

    $estaciones_result = $conn->query("SELECT * FROM `estaciones` WHERE `estaciones_user_id` = ".$user_id);
    $estaciones = $estaciones_result->fetch_all(MYSQLI_ASSOC);
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
    #<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    #<!-- WARNING: Respond.js doesnt work if you view the page via file: -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->

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
        <header class="" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon
                        <b class="logo-icon">
                             Dark Logo icon
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        End Logo icon
                         Logo text
                        <span class="logo-text">
                             dark Logo text
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                        </span>-->
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
                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ==============================================================
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block mr-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>-->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ==============================================================
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Steave</span></a>
                        </li>-->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="dashboard.php" aria-expanded="false"><i class="fas fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="devices.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Dispositivos</span></a>
                        </li>
                        <?php if($_SESSION['users_username'] === "javier"): ?>
                          <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                  href="devices_list_admin.php" aria-expanded="false">
                                  <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Listado Dispositivos</span></a>
                          </li>
                          <?php endif; ?>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="logout.php" aria-expanded="false"><i class="fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Cerrar sesión</span></a>
                        </li>
                        <!--
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="fontawesome.html" aria-expanded="false"><i class="fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">Icon</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="map-google.html" aria-expanded="false"><i class="fa fa-globe"
                                    aria-hidden="true"></i><span class="hide-menu">Google Map</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="blank.html" aria-expanded="false"><i class="fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Blank</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="404.html" aria-expanded="false"><i class="fa fa-info-circle"
                                    aria-hidden="true"></i><span class="hide-menu">404</span></a></li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="https://wrappixel.com/templates/ampleadmin/"
                                class="btn btn-block btn-danger text-white" target="_blank">Upgrade to
                                Pro</a>
                        </li>
                      -->
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
        <div class="page-wrapper" style="min-height: 250px;">
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
                                <i class="fas fa-user" aria-hidden="true"></i><span class="hide-menu"><?php echo($_SESSION['users_username']) ?></span></a>
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
                    <div class="col-md-12">
                        <div class="white-box">
                            <h5 class="box-subtitle">Agrega un dispositivo introduciendo un alias y el número de serie</h5>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" target="devices.php" name="form" class="form-horizontal form-material">
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Alias</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="alias" type="text"
                                                class="form-control p-0 border-0" value="" required
                                                id="alias">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Número de serie</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="serie" class="form-control p-0 border-0" value="" required id="serie">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Añadir</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div style="color:blue" class="">
                      <?php echo $msg ?>
                    </div>
                </div>
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
                                      <?php foreach ($estaciones as $estacion) {?>
                                        <tr>
                                            <td><?php echo $estacion['estaciones_id'] ?></td>
                                            <td><?php echo $estacion['estaciones_user_id'] ?></td>
                                            <td><?php echo $estacion['estaciones_serie'] ?></td>
                                            <td><?php echo $estacion['estaciones_alias'] ?></td>
                                            <td><?php echo $estacion['estaciones_date'] ?></td>
                                            <td><a href="delete.php?id=<?php echo $estacion['estaciones_id']; ?>">Delete</a></td>
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

