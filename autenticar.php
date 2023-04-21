<?php

require("conexao.php");
@session_start();
$email = $_POST["email"];
$senha = $_POST["senha"];



$consulta = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha");
$consulta->bindValue(":senha", $senha);
$consulta->bindValue(":email", $email);
$consulta->execute();
$res = $consulta->fetchAll(PDO::FETCH_ASSOC);
$dados = count($res);

if($dados>0){

    $_SESSION['id_usuario'] = $res[0]['id_usuario'];
	$_SESSION['email_usuario'] = $res[0]['email'];
	$_SESSION['nivel_usuario'] = $res[0]['nivel'];
	$_SESSION['senha_usuario'] = $res[0]['senha'];

	$nivel = $res[0]['nivel'];
	if($nivel == 'admin'){
		echo "<script language='javascript'> window.location='admin' </script>";
	}

	if($nivel == 'docente'){
		echo "<script language='javascript'> window.location='docente' </script>";
	}

	if($nivel == 'estudante'){
		echo "<script language='javascript'> window.location='estudante' </script>";
	}
	
}else{
	echo "<script language='javascript'> window.alert('Usuário ou Senha Incorreta!') </script>";
	echo "<script language='javascript'> window.location='index.php' </script>";	
}

