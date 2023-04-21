<?php 

require_once("../../conexao.php");


$titulo = $_POST['titulo'];

$curso = $_POST['curso'];
$descricao =$_POST['descricao'];
$breve_descricao =$_POST['breve_descricao'];
$docente = $_POST['docente'];
$id = $_POST['id2'];
$dia= date_create('D,d/M/y');

$tema2 = $_POST['tema2'];
$query3 = $pdo->query("SELECT cursos FROM cursos where id_cursos = '$curso' ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$curso_nome = $res3[0]['cursos'];

$query_tema = $pdo->query("SELECT * FROM temas where titulo ='$tema2' ");
$res_tema = $query_tema->fetchAll(PDO::FETCH_ASSOC);
$documento = $res_tema[0]['documento'];


//SCRIPT PARA FOTO NO BANCO

$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['foto']['name']);
$caminho = '../../img/arquivos/'.$nome_img;
if (@$_FILES['foto']['name'] == ""){
  $imagem = $documento;
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['foto']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
 if($ext == 'pdf'){ 
move_uploaded_file($imagem_temp, $caminho);
 }else{
 	echo 'Extensão de arquivo não permitida!
 	escolha arquivo PDF';
 	exit();
 }

    if($titulo == ''){
        echo "Preencha a Descrição!!";
        exit();
    }else if($titulo != $tema2 ){
        $query = $pdo->query("SELECT * FROM temas where titulo = '$titulo' ");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $tamanho = count($res);
        if($tamanho>0){
        echo "esse tema ja existe";
        exit();
        }
        
    }


if($descricao == ''){
	echo "Preencha a Descrição!!";
	exit();
}


if($id == ""){
	
	$res = $pdo->prepare("INSERT INTO temas SET titulo = :titulo, descricao = :descricao,breve_descricao =:breve_descricao, documento = :documento, docente = :docente, curso = :curso, dia = curDate()");	

}else{
  
	$res = $pdo->prepare("UPDATE temas SET titulo = :titulo, descricao = :descricao,breve_descricao =:breve_descricao, documento = :documento, docente = :docente, curso = :curso WHERE id_tema = '$id'");
	
}

$res->bindValue(":titulo", $titulo);
$res->bindValue(":descricao", $descricao);
$res->bindValue(":breve_descricao", $breve_descricao);
$res->bindValue(":documento", $imagem);
$res->bindValue(":docente", $docente);
$res->bindValue(":curso", $curso_nome);
// $res->bindValue(":dia", $dia);


$res->execute();


echo 'Salvo com Sucesso!';

?>