<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM docentes where id_docentes = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email = $res[0]['email'];

$query_id = $pdo->query("SELECT * FROM usuarios where email = '$email' ");
$res_id = $query_id->fetchAll(PDO::FETCH_ASSOC);
$id_usu = $res_id[0]['id_usuario'];


$pdo->query("DELETE FROM docentes WHERE id_docentes = '$id'");
$pdo->query("DELETE FROM usuarios WHERE id_usuario = '$id_usu'");

echo 'Excluído com Sucesso!';

?>