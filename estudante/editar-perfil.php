<?php 
require_once("../conexao.php"); 

$nome = $_POST['nome_usu'];
$email = $_POST['email_usu'];
$senha = $_POST['senha_usu'];

$id_est = $_POST['id_est'];



$antigo = $_POST['email_ant'];
$id = $_POST['id_usu'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}


//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $email){
	$query = $pdo->query("SELECT * FROM usuarios where email = '$email' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Este Email Ja Existe!';
		exit();
	}
}

$res = $pdo->prepare("UPDATE estudantes SET nome = :nome,  email = :email WHERE id_estudante = '$id_est'");
$res2 = $pdo->prepare("UPDATE usuarios SET email = :email, senha = :senha WHERE id_usuario = '$id'");
$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);

$res2->bindValue(":email", $email);
$res2->bindValue(":senha", $senha);

$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';

?>