<?php
require("conexao.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Temas - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
  
  <div class="row justify-content-center" style="margin-top: 170px;">
  <div class="p-5 col-lg-6" style="background-color:aliceblue; border-radius:6px">
                  <div class="text-center">
                  <img src="img/logo.png" class="mb-3" alt="" srcset="">
                    <h1 class="h4 mb-4" style="color: black;">Seja Bem Vindo</h1>
                  </div>
                  <form class="user" action="autenticar.php" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="email" name="senha" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn form-control bg-primary text-white" style="border-radius: 18px;padding:12px 0px 35px">Entrar</button>
                  </form>
                </div>
  </div>


  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
