<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome'];
// $telefone = $_POST['telefone_mec'];
// $cpf = $_POST['cpf_mec'];
$email = $_POST['email'];
// $endereco = $_POST['endereco_mec'];

// $antigo = $_POST['antigo'];
$nomeantigo = $_POST['nome2'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($nomeantigo != $nome){
	$query = $pdo->query("SELECT * FROM docentes where nome = '$nome' ");
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
	$res = $pdo->prepare("INSERT INTO docentes SET nome = :nome, email = :email");	

	$res2 = $pdo->prepare("INSERT INTO usuarios SET email = :email, senha = :senha, nivel = :nivel");	
	$res2->bindValue(":senha", '123');
	$res2->bindValue(":nivel", 'docente');

}else{
	$res = $pdo->prepare("UPDATE docentes SET nome = :nome,  email = :email WHERE id_docentes = '$id'");

	$res2 = $pdo->prepare("UPDATE usuarios SET email = :email WHERE email = '$antigo2'");	
	
}

$res->bindValue(":nome", $nome);
// $res->bindValue(":cpf", $cpf);
// $res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
// $res->bindValue(":endereco", $endereco);

// $res2->bindValue(":nome", $nome);
// $res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);


$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';

?>