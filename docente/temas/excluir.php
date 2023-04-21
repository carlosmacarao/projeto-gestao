<?php

require_once("../../conexao.php");

@session_start();


$id = $_POST['id'];


$res = $pdo->query("DELETE FROM temas where id_tema = '$id'");

echo "Deletado com sucesso!";