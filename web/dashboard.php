<?php
  session_start();
  $logged = $_SESSION['logged'];
  $user_id = $_SESSION['users_id'];
  $usuario = "javier";

  if(!$logged){
    echo "Ingreso no autorizado";
    //die();
    echo '<meta http-equiv="refresh" content="1; url=login.php">';

  }

  $conn = mysqli_connect("localhost","admin_masteriot","j65966298","admin_masteriot");

  if ($conn==false){
    echo "Error al conectarse a la BBDD";
    die();
  }

  $estaciones_result = $conn->query("SELECT * FROM `estaciones` WHERE `estaciones_user_id`=" . $user_id);
  $estaciones = $estaciones_result->fetch_all(MYSQLI_ASSOC);

  $consulta = "SELECT estaciones.estaciones_serie, mediciones.mediciones_date, mediciones.mediciones_valor from mediciones
                                    inner join estaciones ON estaciones.estaciones_id=mediciones.mediciones_estaciones_id
                                    inner join users on users.users_id=estaciones.estaciones_user_id and users.users_id =" . $user_id .
                                    " ORDER BY mediciones.mediciones_date";

  $mediciones_result = $conn->query($consulta);
  $mediciones = $mediciones_result->fetch_all(MYSQLI_ASSOC);







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
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
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
        <!-- asdfasdfsadfasd -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php"></a>
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
                    <ul class="navbar-nav ml-auto d-flex align-items-center"></ul>
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.html"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
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
                        <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
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
                <!-- Three charts -->
                <!-- ============================================================== -->
                  <div class="row justify-content-center">
                    <?php foreach ($estaciones as $estacion) {?>
                      <div class="col-lg-4 col-sm-6 col-xs-12">
                          <div class="white-box analytics-info">
                              <h3 class="box-title"><?php echo $estacion['estaciones_serie'] ?></h3>
                              <ul class="list-inline two-part d-flex align-items-center mb-0">
                                  <li>
                                      <div><canvas width="67" height="30"
                                              style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                      </div>
                                  </li>
                                  <li class="ml-auto"><span id="<?php echo $estacion['estaciones_serie'] ?>" class="counter text-success">--</span></li>
                              </ul>
                          </div>
                      </div>
                      <?php } ?>


                    </div>


                    <div class="row justify-content-center">
                      <div class="col-sm-12">
                          <div class="white-box">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th class="border-top-0">Estacion_serie</th>
                                              <th class="border-top-0">Fecha</th>
                                              <th class="border-top-0">Temperatura</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($mediciones as $medicion) {?>
                                          <tr>
                                              <td><?php echo $medicion['estaciones_serie'] ?></td>
                                              <td><?php echo $medicion['mediciones_date'] ?></td>
                                              <td><?php echo $medicion['mediciones_valor'] ?></td>
                                          </tr>
                                        <?php }?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        </div>
                    </div>


                <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- RECENT SALES -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent Comments -->
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
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!-- Editable Table -->
    <script src="js/jquery.jeditable.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>-->

    <script src="js/pages/dashboards/dashboard1.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script type="text/javascript">

    //display_temp coincide con el id de la etiqueta html cuyo valor queremos cambiar

    function update_values(h101, h102, h103){
      $("#h101").html(h101);
      $("#h102").html(h102);
      $("#display_h103").html(h103);
    }

    function process_msg(topic, message){
      var msg = message.toString();
      $("#"+topic).html(msg + "º");
    }



    // connection option
    const options = {
      		clean: true, // retain session
          connectTimeout: 4000, // Timeout period
          // Authentication information
          clientId: 'emqx156javascript',
          username: '',
          password: '',
          keepalive: 60,
    }


    /**********************
      Conexión
    **********************/
    const WebSocket_URL = 'wss://iothogar.xyz:8094/mqtt'
    const client = mqtt.connect(WebSocket_URL, options)

    client.on('connect', () => {
      console.log('Mqtt conectado por WS con éxito!')

      client.subscribe('H101TEMP', {qos: 0},(error) => {
        if (!error){
          console.log('Suscrito con éxito!')
        }else{
          console.log('Suscripción fallida')
        }
      })

      client.subscribe('H102TEMP', {qos: 0}, (error) => {
        if (!error){
          console.log('Suscrito a otro con exito!')
        }else{
          cosole.log('Suscripción fallida')
        }
      })

      client.subscribe('H103TEMP', {qos: 0}, (error) => {
        if (!error){
          console.log('Suscrito a otro con exito!')
        }else{
          cosole.log('Suscripción fallida')
        }
      })

      client.publish('casa', 'esto es un éxito!!!', (error) => {
        console.log(error || 'Mensaje enviado!!!')
      })
    })

    client.on('reconnect', (error) => {
        console.log('reconnecting:', error)
    })

    client.on('error', (error) => {
        console.log('Connection failed:', error)
    })

    client.on('message', (topic, message) => {
      console.log('mensaje - ', message.toString(), ' recibido según el tópico ', topic)

      process_msg(topic,message);
    })


    </script>

</body>

</html>

