<?php
  session_start();
  require_once "DB&Config.php";
  $noOcurrence = false;
  $verification = true;
  $conn = DBconn();

  if(isset($_COOKIE['login']) and isset($_COOKIE['password']))
  {
    $_SESSION['login'] = $_COOKIE['login'];
    header("Location: dashboard.php");
  }


  if(!empty($_POST))
  {
    $conn = DBconn();
    $email = $_POST['username'];
    $password = $_POST['password'];

    $findOcurrence = "SELECT email, password, isVerified FROM user_details WHERE email = :email AND password = :password";
    $sth = $conn->prepare($findOcurrence);
    $sth->execute([':email' => $email, ':password' => strval(hashpssw($password))]);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    if(empty($result))
    {
      $noOcurrence = true;
    }
    else
    {
      if($result[0]['isVerified'] == 0)
      {
        $verification = false;
      }
    }
    if ($noOcurrence == false and $verification == true)
    {
      if(isset($_POST['remember-me']))
      {
        setcookie('login', $email, time() + (30 * 24 * 60 * 60));
        setcookie('password', hashPssw($password), time() + (30 * 24 * 60 * 60));
      }
      header("Location: dashboard.php");
    }

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon-16x16.png" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DC Pagina Principal</title>
<style type="text/css">
* {
  box-sizing: border-box;
}

html,body,header{
  height: 100%;
}

body
{
font: 20px Helvetica, sans-serif; color: #333;
background: url("images/fondo-login.jpeg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}


.hidden-label{
  color:crimson !important;
}

</style>

</head>
<body>



<div class="text-center">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mb-4 px-4 border rounded bg-warning border-dark shadow-lg p-3" style="max-width: 480px; margin:auto; margin-top: 200px; border-width:3px !important;">
    <label for="" class="mt-2">Login details:</label>
    <?php if($noOcurrence == true or $verification == false)
    {
      echo '</br>';
    }
    ?>

    <label id="login-existence" class="hidden-label" style=<?php if($noOcurrence == true) {echo "display:inline;";}else{echo "display:none;";}?>>No existe ninguna cuenta con ese email</label>
    <label id="login-existence" class="hidden-label" style=<?php if($noOcurrence == false && $verification == false) {echo "display:inline;";}else{echo "display:none;";}?>>Su cuenta esta por verificar</label>
    <input type="text" name="username" id="username" name="username" class="form-control mb-2" placeholder="Nombre de usuario" required autofocus>
    <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control">
    <div class="checkbox">
      <input type="checkbox" value="remember-me" id="remember-me" name="remember-me"> Remember me
    </div>
    <button type="submit" class="btn btn-lg btn-primary mt-3">Entrar</button></br>
    <button class="mb-2 btn btn-lg btn-info mt-3 text-white" id="register-button">Registrarme</button>
  </form>
</div>

<script>
      document.POSTElementById("register-button").onclick = function () {
        location.href = "registration.php";
    };
</script>


</body>
</html>