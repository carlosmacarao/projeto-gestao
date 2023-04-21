<?php
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'docente') {
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php");

$id_tema = $_GET['id'];

$res = $pdo->query("SELECT * FROM temas WHERE id_tema = '$id_tema'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$titulo = $dados[0]['titulo'];
$descricao = $dados[0]['descricao'];
$documento = $dados[0]['documento'];
$doc = $dados[0]['docente'];
?>

<div class="container">
	<div class="card">
		<div class="col-md-12 pt-5 px-4 ">
			<h2 class="font-weight-bold" style="color: #000;"><?php echo $titulo ?></h2>
			<p>
				<?php echo $descricao ?>
			</p>
			<a href="../img/arquivos/<?php echo $documento ?>" target="_blank" rel="noopener noreferrer"><img src="../img/pdf.png" width="50" /></a>
			
		</div>
		<div class="text-right pr-3">
				<p>Docente Responsavel: <b><?php echo $doc ?></b> </p>
			</div>
	</div>
</div>
