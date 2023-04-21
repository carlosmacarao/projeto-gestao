<?php

require_once("../../conexao.php");

@session_start();


$id = $_POST['id'];

$res_t = $pdo->query("SELECT * FROM escolhidos WHERE id_escolhido='$id'");
$dados_t = $res_t->fetchAll(PDO::FETCH_ASSOC);
$nome_estudante = $dados_t[0]['nome_estudante'];
$nome_doc= $dados_t[0]['nome_docente'];
$titulo = $dados_t[0]['tema'];

$res_t2 = $pdo->query("SELECT * FROM estudantes WHERE nome='$nome_estudante'");
$dados_t2 = $res_t2->fetchAll(PDO::FETCH_ASSOC);
$email_estudante = $dados_t2[0]['email'];




$subject = "Resposta";
$name = utf8_decode("Universidade Zambeze");
$email_to=$email_estudante;
$message = utf8_decode("O Docente $nome_doc aceitou o seu pedido.");



$content = "Name: $name\n";
$content .= "Email: $email_to\n\n";
$content .= "Message:\n$message\n";


$headers = "From: $name <$email_principal>";




$success = mail($email_to, $subject, $content, $headers);
if ($success) {

    $res = $pdo->query("UPDATE escolhidos SET confirmacao ='aceite' where id_escolhido = '$id'");

    echo "Aceitou com sucesso,<br> BOM TRABALHO";

} else {
  
    
    echo "Oops! Alvo esta errado, Seu Pedido não foi completado.";
}









