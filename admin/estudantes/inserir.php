<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome'];
$email = $_POST['email'];
$curso = $_POST['curso'];

$query3 = $pdo->query("SELECT * FROM cursos where id_cursos = '$curso' ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$curso_nome = $res3[0]['cursos'];

$nomeantigo = $_POST['nome2'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($nomeantigo != $nome){
	$query = $pdo->query("SELECT * FROM estudantes where nome = '$nome' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O nome já está Cadastrado!';
		exit();
	}
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}




//VERIFICAR SE O REGISTRO COM MESMO EMAIL JÁ EXISTE NO BANCO
if($antigo2 != $email){
	$query = $pdo->query("SELECT * FROM usuarios where email = '$email' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O Email já está Cadastrado!';
		exit();
	}
}


if($id == ""){

	
	
	$res = $pdo->prepare("INSERT INTO estudantes SET nome = :nome, email = :email, curso = :curso");	

	$res2 = $pdo->prepare("INSERT INTO usuarios SET email = :email, senha = :senha, nivel = :nivel");	
	$res2->bindValue(":senha", '123');
	$res2->bindValue(":nivel", 'estudante');

}else{
	$res = $pdo->prepare("UPDATE estudantes SET nome = :nome,  email = :email,curso =:curso WHERE id_estudante = '$id'");

	$res2 = $pdo->prepare("UPDATE usuarios SET email = :email WHERE email = '$antigo2'");	
	
}

$res->bindValue(":nome", $nome);
$res->bindValue(":curso", $curso_nome);
$res->bindValue(":email", $email);

$res2->bindValue(":email", $email);


$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';

?>