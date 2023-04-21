<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome'];
$nomeantigo = $_POST['nome2'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O curso é Obrigatório!';
	exit();
}

if($nomeantigo != $nome){
	$query = $pdo->query("SELECT * FROM docentes where nome = '$nome' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O curso já foi Cadastrado!';
		exit();
	}
}





if($id == ""){
	$res = $pdo->prepare("INSERT INTO cursos SET cursos = :nome");	

}else{
	$res = $pdo->prepare("UPDATE cursos SET cursos = :nome WHERE id_cursos = '$id'");	
}

$res->bindValue(":nome", $nome);
$res->execute();

echo 'Salvo com Sucesso!';

?>