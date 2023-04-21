<?php 
require_once("../../conexao.php"); 

$titulo = $_POST['titulo'];
$nome_doc = $_POST['docente'];
$nome_estu= $_POST['estudante'];
$email_estudante = $_POST['email_est'];




$res = $pdo->prepare("INSERT INTO escolhidos SET tema=:titulo, nome_docente = :docente, nome_estudante = :estudante,email_estudante = :email, escolha=:escolha");	
$res->bindValue(":titulo", $titulo);
$res->bindValue(":estudante", $nome_estu);
$res->bindValue(":email", $email_estudante);
$res->bindValue(":docente", $nome_doc);
$res->bindValue(":escolha", $escolha);
$res->execute();


echo "Parabens Escolheu o tema ".$titulo." aguarde a confirmacao";
