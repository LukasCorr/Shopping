<?php
session_start();

//Si esta logeado hacer ...
if (isset($_SESSION['user'])) {

//si su session expiro (30 min) hacer ...
$now = time();
if($now > $_SESSION['expire']) {

$sql =mysqli_query($link,"UPDATE usuarios SET estado='Inactivo' WHERE usuario='$_SESSION[user]'");
session_destroy();
header('location: ../login'); }

//---------------------------------------------------------------
// Comienzo de la pagina 'Settings'

include '../static/db/conection.php';

$registros=mysqli_query($link,"SELECT * from usuarios WHERE usuario='$_SESSION[user]'");

$reg=mysqli_fetch_array($registros);

//Declaracion de variable "id" para el contenido dinamico.
if (isset($_GET['id'])){
  $variable=$_GET['id'];}
  
else{ $variable="config-profile.php";}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Configuración general de la cuenta</title>
   
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../static/css/font-awesome.css">
    <link rel="stylesheet" href="../static/css/AdminLTE.css">
    <link rel="icon" href="../static/img/favicon.ico">
    <link rel="stylesheet" href="../static/css/bootstrap.css">

    <script src="../static/js/jquery-3.2.1.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
    <script src="../static/js/app.js"></script>

  </head>

<body class="hold-transition skin-blue sidebar-mini">

<!--Navbar -->
<header class="main-header">
  
  <a href="../" class="logo">    
    <span class="logo-mini"><b>SH</b>P</span>     
    <span class="logo-lg"><b>Shopping</b></span>
  </a>

 
<nav class="navbar" role="navigation">  

    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Navegación</span>
    </a>

      <ul class="nav navbar-nav navbar-right">

        <!--Cuadro de Busqueda -->
        <li style="margin-top: 10px; width: 75%;">
          <div class="col-xs-12">

            <form action="../index.php?id=search.php" method="POST">
              <div class="input-group" id="busqueda">
                <input type="text" class="form-control" placeholder="Buscar artículos" onkeyup="document.getElementById('buscar').disabled=(this.value!='') ? false: true" name="results" autocomplete="off">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" id="buscar" disabled="disabled">
                    <span class="fa fa-search"></span>
                  </button>
                </span>
              </div>
            </form>  
          </div>
        </li>


        <!--icono notificaciones -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="fa fa-bell" title="Notificaciones"></span>
          </a>

          <ul class="dropdown-menu">
            <li class="header">
              <p>No hay notificaciones</p>                
            </li>
         </ul>
        </li>

        <!--Menu Perfil -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class='img-circle' src="<?php echo '../'.$reg['imagen'];?>" style="height: 20px;" title="<?php echo $reg['nombre'];?>">
          </a>

          <ul class="dropdown-menu">

            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo '../'.$reg['imagen'];?>"  class="img-responsive img-circle center-block">

              <!--@Usuario-->
              <p>
                <strong><?php echo $reg['nombre'].' '.$reg['apellido'];?></strong><br>
                <span class="profile-username post"><?php echo "@".$reg['usuario'];?></span>
              </p>
            </li>
                  
            <!-- Opciones Perfil-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="../index.php?id=user/profile.php&<?php echo $reg['usuario'];?>" class="btn btn-default btn-flat">Ver Perfil</a>
              </div>

              <div class="pull-right">
                <a href="../login/logout.php" class="btn btn-default" title="Cerrar Sesión">
                  <span class="fa fa-power-off"></span>
                </a>
              </div>
            </li>
          </ul>
        </li>    
      </ul>
    </div>
  </nav>
</header>

  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu">
            
        <li class="treeview">
          <a href="settings.php">
            <i class="fa fa-user"></i>
            <span>Perfil</span>
          </a>
        </li>
            
        <li class="treeview">
          <a href="settings.php?id=config-account.php">
            <i class="fa fa-lock"></i>
            <span>Cuenta</span>
          </a>
        </li>
  
        <li>
          <a href="#">
            <i class="fa fa-plus-square"></i> <span>Ayuda</span>
            <small class="label pull-right bg-red-gradient">PDF</small>
          </a>
        </li>
                       
      </ul>
    </section>
  </aside>
    
  <?  //Contenido Dinamico
      echo '<div style="margin-top:50px;"';
      include($variable); ?>
      </div>
                   
  <footer class="main-footer">
    <strong>Copyright &copy; 2016.</strong> All rights reserved. 
    <a href="https://github.com/LukasCorr" target="_blank">
      <span class="fa fa-github"></span>
    </a>
  </footer>

</body>
</html>

<? mysqli_close($link);

} else { header('location: ../'); } ?> 