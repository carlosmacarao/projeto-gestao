<?php
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'docente') {
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "adiciocionartema";

?>
<?php 
				if (@$_GET['funcao'] == 'editar') {
					$titulo = "Editar Registro";
					$id2 = $_GET['id'];

					$query = $pdo->query("SELECT * FROM temas where id_tema = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$titulo2 = $res[0]['titulo'];
					$documento2 = $res[0]['documento'];
					$curso_tema = $res[0]['curso'];
					$descricao2 = $res[0]['descricao'];
					$breve_descricao2 = $res[0]['breve_descricao'];


				} else {
					$titulo = "Inserir Registro";

				}


				?>
				
				<head>
				<link rel="stylesheet" href="../vendor/summernote/summernote.css">
				</head>
<form class="card" name="teste" id="form" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<div class="card-body">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="nome">Tema</label>
						<input type="text"  class="form-control" id="titulo" name="titulo" value="<?php echo $titulo2 ?>">
					</div>
					<div class="form-group col-md-6">
						<label>Cursos</label>
						<select name="curso"  class="form-control" id="curso">

							<?php
							//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER O NOME DO ITEM ASSOCIADA AO REGISTRO
							if (@$_GET['funcao'] == 'editar') {

								$res_dado = $pdo->query("SELECT * from cursos where cursos = '$curso_tema'");
								$dados_dado = $res_dado->fetchAll(PDO::FETCH_ASSOC);
								for ($i = 0; $i < count($dados_dado); $i++) {
									foreach ($dados_dado[$i] as $key => $value) {
									}

									$id_dado = $dados_dado[$i]['id_cursos'];
									$nome_dado = $dados_dado[$i]['cursos'];
								}


								echo '<option value="' . $id_dado . '">' . $nome_dado . '</option>';
							}

							//TRAZER TODOS OS REGISTROS EXISTENTES
							$res2 = $pdo->query("SELECT * from cursos order by cursos asc");
							$dados = $res2->fetchAll(PDO::FETCH_ASSOC);

							for ($i = 0; $i < count($dados); $i++) {
								foreach ($dados[$i] as $key => $value) {
								}

								$id_item = $dados[$i]['id_cursos'];
								$nome_item = $dados[$i]['cursos'];

								if ($nome_dado != $nome_item) {
									echo '<option value="' . $id_item . '">' . $nome_item . '</option>';
								}
							} ?>

						</select>
					</div>
				</div>

				<div class="row">
				<div class="col-md-6">
							<div class="form-group">
								<label >Documento (PDF)</label> <br>
								<a href="../img/arquivos/<?=@$documento2 ?>"><img class="mb-1" src="../img/pdf.png" alt="" width="100px"><?=@$documento2 ?></a>
								
								<input type="file" value=""  class="form-control-file" id="foto" name="foto">
								
							</div>
						</div>

                <div class="form-group col-md-6">
						<label for="nome">Breve Descricao </label>
						<textarea name="breve_descricao" id="breve_descricao" placeholder="Maximo 100 caratecteres" class="form-control" cols="" rows="5"><?php echo $breve_descricao2?></textarea>
					</div>
				</div>

				<div>
		
					<h3>Requisitos</h3>
					<div class="row">
						<div class="col-md-12">
						<!-- <div class="summernote"></div> -->
						<textarea name="descricao" value="" class="summernote" id="descricao" cols="30" rows="10"><?php echo $descricao2 ?></textarea>
						</div>
						<input type="hidden" name="docente" value="<?php echo $nome_usu?>" id="docente">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer text-right">
		<div class="" id="mensagem"></div>
		<div class="form-group">
			<input type="hidden" id="id2" name="id2" value="<?php echo @$id2 ?>">
			<input type="hidden" name="tema2" id="tema2" value="<?php echo $titulo2?>">
			
			<button type="submit" class="btn btn-primary" name="btn-registar" id="btn-registar">Salvar</button>
		</div>
	</div>
</form>


<!-- AJAX PARA EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
	$("#form").submit(function() {
		var pag = "<?= $pag ?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "temas/inserir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem').removeClass()

				if (mensagem == 'Salvo com Sucesso!') {
					$('#mensagem').addClass('text-success')
					window.location = "index.php?pag=meustemas" ;

				} else {

					$('#mensagem').addClass('text-danger')
				}

				$('#mensagem').text(mensagem)

			},


			cache: false,
			contentType: false,
			processData: false,
			xhr: function() { // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
					myXhr.upload.addEventListener('progress', function() {
						/* faz alguma coisa durante o progresso do upload */
					}, false);
				}
				return myXhr;
			}
		});
	});
</script>
<!--SCRIPT PARA CARREGAR IMAGEM -->
<!-- <script type="text/javascript">
	function carregarImg() {

		var target = document.getElementById('target');
		var file = document.querySelector("input[type=file]").files[0];
		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);


		} else {
			target.src = "";
		}
	}
</script> -->


<!-- Summernote -->
<script src="../vendor/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="../js/summernote-init.js"></script>
