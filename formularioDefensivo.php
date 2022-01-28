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
    

    if(!empty($_POST))
    {
      
      $_SESSION['enemyName'] = $_POST['enemy-name'];
      $_SESSION['allyName'] = $_POST['ally-name'];
      $_SESSION['enemyVillages'] = $_POST['villages'];
      $_SESSION['allyVillages'] = $_POST['ourVillages'];
      $_SESSION["villageType"] = $_POST['village-type'];
      $_SESSION['arrivalDate'] = $_POST['arrival-date'];
      $_SESSION['firstAttack'] = $_POST['arrival-hour'];
      $train = array();
      for($x = 0; $x < 8; $x++)
      {
        $index = 'train' . strval($x);
        if(isset($_POST[$index]))
        {
          array_push($train, $_POST[$index]);
        }
      }
      $_SESSION['train'] = $train;
      $_SESSION['PT'] = $_POST['PT'];
      $_SESSION['troopSpeed'] = $_POST['speed'];
      $_SESSION['artifact'] = $_POST['artifact'];
      $_SESSION['artifactType'] = $_POST['artifact-type'];

      header("Location: formularioSubido.php");

    }



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous">
    <title>Formulario defensivo</title>
  </head>
  <body>
<style>
  select { width: 200px;}
</style>


    <!-- NAV -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $_SESSION['dashboard'];?>">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Reportes</a>
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
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" method="post" id="form1" action="cookieDelete.php">
        <button type="submit" form="form1" >Desloguear</button>
      </form>
    </div>
  </div>
</nav>
    <!-- NAV -->

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="deff-form-data" class="mb-4 px-4 border rounded" style="text-align:center; max-width: 480px; margin:auto; margin-top: 100px; border-width:3px !important;">
    <label for="off-account" class="form-label">Nick del agresor:</label>
    <input class="form-control mb-2" name="enemy-name" list="enemy-name" required style="text-align:center !important;" id="off-account" placeholder="Clickea para buscar...">
    <datalist id="enemy-name"></datalist>
    <label for="Alliance">Alianza:</label><br>
    <div style=" box-sizing: border-box;
    display: inline-block;
    padding: 5px;
    text-align: center;
    width: 100%;">
      <label for="" class="mb-3 form-label text-xs-center" id="Alliance"></label><br>
      <label for="villages">Aldea enemiga:</label><br>
      <select name="villages" class="mt-1 mb-1" id="villages"></select>
    </div>
    <label for="deff-account" class="form-label">Nick del defensor:</label>
    <input class="form-control mb-2" name="ally-name" required list="ally-name" style="text-align:center !important;" id="deff-account" placeholder="Clickea para buscar...">
    <datalist id="ally-name"></datalist>
    <div style=" box-sizing: border-box;
    display: inline-block;
    padding: 5px;
    text-align: center;
    width: 100%;">
      <label for="ourVillages">Aldea aliada:</label><br>
      <select name="ourVillages" class="mt-1 mb-1" id="ourVillages"></select>
    </div>
    <label for="village-type" class="mb-1">Tipo de aldea:</label><br>
    <select name="village-type" class="mt-1 mb-2" id="village-type">
      <option value = "">Selecciona el tipo de aldea</option>
      <option value = "Capital productora">Capital productora</option>
      <option value = "Off capital">Off capital</option>
      <option value = "Deff capital">Deff capital</option>
      <option value = "Off aldea secundaria">Off aldea secundaria</option>
      <option value = "Deff aldea secundaria">Deff aldea secundaria</option>
      <option value = "Productora">Productora</option>
      <option value = "Rotable">Rotable</option>
      <option value = "Plano">PLANO</option>
    </select><br>
    <label for="arrival-date">Fecha de llegada:</label><br>
    <input type="text" name="arrival-date" required id="arrival-date" class="border mb-2" style="text-align:center;"><br>
    <label for="arrival-hour">Hora de llegada:</label><br>
    <input type="time" name="arrival-hour" required class="mb-2" id="arrival-hour" step="1" value=""><br>
    <label for="train">Hay vagones?</label>
    <input type="checkbox" id="train" name="train"><br>
    <div id="vagones-input"></div>
    <div id="trains"></div>
    <label for="PT">Plaza de torneos:</label><br>
    <select name="PT" style="width: 100px; text-align-last:center !important;" id="PT">
      <option value="">Selecciona la PT</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    </select><br>
    <label for="speed" class="mt-2">Posible velocidad de tropas:</label><br>
    <select name="speed" id="speed">
      <option value="">Selecciona la velocidad</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    </select><br>
    <label for="comment" class="mt-2">Comentarios:</label><br>
    <input type="text" name="comments" id="comments" class="mb-2"><br>
    <label for="artifact">Artefacto en la aldea atacada:</label><br>
    <select name="artifact" id="artifact">
      <option value="">Selecciona el artefacto...</option>
      <option value="Unico">Unico</option>
      <option value="Grande">Grande</option>
      <option value="Pequeño">Pequeño</option>
      <option value="PLANO">PLANO</option>
    </select><br>
    <label for="artifact-type" class="mt-2">Que artefacto es?</label><br>
    <select name="artifact-type" id="artifact-type">
      <option value="">Selecciona el tipo de artefacto...</option>
      <option value="Tropero">Tropero</option>
      <option value="Almacen">Almacen</option>
      <option value="Confusion">Confusion</option>
      <option value="Dureza">Dureza</option>
      <option value="Espias">Espias</option>
      <option value="Loco">Loco</option>
      <option value="Botas">Botas</option>
      <option value="Consumo">Consumo</option>
    </select><br>
    <button type="button" id="submit-button" class="mt-2 mb-2">Subir formulario</button>
</form>


<script src="formularioDefensivo.js"></script>
<script>
  $(document).ready(function() {
    $('#submit-button').click(function(){
      var flag = 0;

      var PT = document.getElementById('PT').value;
      var speed = document.getElementById('speed').value;
      var enemyAlliance = $('#Alliance').text();
      var attackTime = document.getElementById('arrival-hour').value;
      var nTrains = document.getElementById('trains').length;
      var trainNumber = '';
      var trainTime = '';
      var nOfTrains = $('#trains').children().length;
      // console.log(nOfTrains);
      nOfTrains = parseInt(nOfTrains);
      // console.log(nOfTrains);
      attackTime = String(attackTime);
      attackTime = attackTime.replaceAll(':','');
      var index = 1;
      while(index <= nOfTrains)
      {
        trainNumber = 'train' + String(index);
        var train = document.getElementById(trainNumber).value;
        var x = String(train);
        x = x.replaceAll(':','');
        if ((x < attackTime) && (attackTime != '000000'))
        {
          alert('Hay un vagon con tiempo incorrecto');
          flag = 1
        }
        index = index + 1;
      }


      if(PT == '')
      {
        alert('No has rellenado la plaza de torneos');
        flag = 1;
      }
      else if(speed == '')
      {
        alert('No has rellenado la velocidad de las tropas del enemigo');
        flag = 1;
      }
      if(enemyAlliance == 'DC')
      {
        alert('Te ataca un compañero?');
        flag = 1;
      }
      console.log(flag);
      if (flag == 0)
      {
        toastr.success("El formulario ha sido añadido a la base de datos.");
        // document.getElementById('deff-form-data').submit();
      } 
    })
  });

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
  </body>
</html>