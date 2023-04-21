<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];


$pdo->query("DELETE FROM cursos WHERE id_cursos = '$id'");


echo 'Excluído com Sucesso!';

?>