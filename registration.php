<?php
    require_once "DB&Config.php";
    $conn = DBconn();
    $conn->beginTransaction();


    if(!empty($_POST))
    {   
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        

        $password = hashpssw($_POST['password']);
        $sqlStmt = "INSERT INTO user_details (FName, LName, email, Password) VALUES (:fname,:lname,:email,:password)";
        $prepared = $conn->prepare($sqlStmt);
        $prepared->execute([':fname' => $fname, ':lname' => $lname, ':email' => $email, ':password' => $password]);
        $conn->commit();
        header("Location: index.php");
        die();
    }

    $conn = NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Formulario de registro</title>
</head>
<body>




<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="user-data" class="mb-4 px-4 border rounded" style="max-width: 480px; margin:auto; margin-top: 200px; border-width:3px !important;">
    <h1 for="" class="mt-2 text-center">Datos de usuario:</h1></br>
    
    <label for="fname" style="text-align: left;">Nombre:</label>
    <input type="text" id="fname" name="fname" class="form-control mb-2" placeholder="Nombre" required autofocus>
   
    <label for="lname" style="text-align: left;">Apellidos:</label>
    <input type="text" id="lname" name="lname" class="form-control mb-2" placeholder="Apellidos" required>
    
    <label id="email-msg"  style="display:none; color:red;">La estructura del email es incorrecta</label>
    <label for="email" style="text-align: left;">Correo electrónico:</label>
    <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Email" required>
    
    <label id="password-msg" style="display:none; color:red;">Las contraseñas tienen que ser iguales</label>
    <label for="password" style="text-align: left;">Contraseña:</label>
    <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control mb-1">

    <label for="confirm-password" style="text-align: left;">Repite la contraseña:</label>
    <input type="password" id="confirm-password" placeholder="Repite la contraseña" class="form-control">

<div class="text-center">
    <button type="button" class="btn btn-lg btn-primary mt-3 text-center" id="confirm">Confirmar</button></br>
    <button type="button" class="mb-2 btn btn-lg btn-info mt-3 text-white" id="register-button" onclick="history.back()">Volver al login</button>
</div>

  </form>


<script>
    $('#confirm').click(function() {
        var flag = 0;
        if(!checkPasswordDifference()) 
        {
            document.getElementById('password-msg').style.display = "inline";
            flag = 1;
        }
        if(!checkEmailStructure())
        {
            document.getElementById('email-msg').style.display = "inline";
            flag = 1;
        }
        if (flag == 0) document.getElementById('user-data').submit();
});
    function checkPasswordDifference()
    {
        const pass = document.getElementById('password');
        const confirmedPass = document.getElementById('confirm-password');
        if(pass.value === confirmedPass.value) return true;
        else return false;
    }

    function checkEmailStructure()
    {
        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        const email = document.getElementById('email'); 
        if (pattern.test(email.value)) return true;
        else return false;
    }
</script>
</body>
</html>