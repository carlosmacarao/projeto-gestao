<?php
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'estudante') {
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php");


$pag="temaescolhido";

$res_t = $pdo->query("SELECT * FROM escolhidos WHERE nome_estudante= '$nome_usu'");
$dados_t = $res_t->fetchAll(PDO::FETCH_ASSOC);
$id_tema3 = $dados_t[0]['tema'];

$res = $pdo->query("SELECT * FROM temas WHERE titulo = '$id_tema3'");
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
		<!-- <div class="card-footer text-right">
			<form method="POST" id="form">
				<input type="hidden" value="<?php echo $titulo ?>" name="titulo" id="titulo">
				<input type="hidden" value="<?php echo $doc ?>" name="docente" id="docente">
				<input type="hidden" value="<?php echo $nome_usu ?>" name="estudante" id="estudante">
				<input type="hidden" value="<?php echo 	$email_usu ?>" name="email_est" id="email_estu">
				
			
				<small class="pb-5 mb-3">
					<div id="mensagem">

					</div>
				</small>
				<small class="pb-5 mb-3">
					<div id="mensagem2">

					</div>
				</small>
			

			</form>
		</div> -->
	</div>
</div>


<script type="text/javascript">
	$("#form").submit(function() {
		var pag = "<?= $pag ?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/sendmail.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem').removeClass()

				if (mensagem == "<?php echo "Parabens Escolheu o tema '".$titulo."' aguarde a confirmação"; ?>") {
					$('#mensagem').addClass('text-success')
					
				} else {

					$('#mensagem').addClass('text-danger')
				}

				$('#mensagem').text(mensagem)

			},


			cache: false,
			contentType: false,
			processData: false,
			xhr: function() { 
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) { 
					myXhr.upload.addEventListener('progress', function() {
						
					}, false);
				}
				return myXhr;
			}
		});
	});
</script>
