<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM estudantes where id_estudante = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email = $res[0]['email'];

$query_id = $pdo->query("SELECT * FROM usuarios where email = '$email' ");
$res_id = $query_id->fetchAll(PDO::FETCH_ASSOC);
$id_usu = $res_id[0]['id_usuario'];


$pdo->query("DELETE FROM estudantes WHERE id_estudante = '$id'");
$pdo->query("DELETE FROM usuarios WHERE id_usuario = '$id_usu'");

echo 'Excluído com Sucesso!';

?>