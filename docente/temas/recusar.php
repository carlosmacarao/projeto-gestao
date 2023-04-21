<?php

require_once("../../conexao.php");

@session_start();


$id = $_POST['id'];


$res = $pdo->query("UPDATE escolhidos SET confirmacao ='recusado' where id_escolhido = '$id'");

echo "Recusado com sucesso!";