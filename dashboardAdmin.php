<?php
    session_start();

    if(!isset($_COOKIE['login']) and (!isset($_SESSION['dashboard'])))
    {
        header("Location: index.php");
    }
    if(isset($_COOKIE['login']) and !isset($_COOKIE['admin']))
    {
      header("Location: dashboard.php");
    }
    if(isset($_COOKIE['admin']) and isset($_COOKIE['login']) and !isset($_SESSION['dashboard']))
    {
      $_SESSION['dashboard'] = 'dashboardAdmin.php';
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Dashboard admin</title>
  </head>
  <body>


    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href=<?php echo $_SESSION['dashboard'];?>>Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="getAllNickMatches.php">Historial de reportes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="formularioDefensivo.php">Formulario Defensivo</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
      </ul>
      <form class="d-flex" method="post" id="form1" action="cookieDelete.php">
        <button type="submit" form="form1" >Desloguear</button>
      </form>
    </div>
  </div>
</nav>
       <!--NAV -->




  </body>
</html>