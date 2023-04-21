<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "estudantes";
require_once("../conexao.php"); 

?>

<div class="row mt-4 mb-4">
	<a type="button" class="btn-secondary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo estudante</a>
	<a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Nome</th>

						<th>Email</th>
						<th>Curso</th>

						<th>Ações</th>
					</tr>
				</thead>

				<tbody>

					<?php 

					$query = $pdo->query("SELECT * FROM estudantes order by id_estudante desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['nome'];
						$email = $res[$i]['email'];
						$curso =$res[$i]['curso'];
						$id = $res[$i]['id_estudante'];
						?>

						<tr>
							<td><?php echo $nome ?></td>
							<td><?php echo $email ?></td>
							<td><?php echo $curso ?></td>
							<td>
								<a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
								<a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<?php 
				if (@$_GET['funcao'] == 'editar') {
					$titulo = "Editar Registro";
					$id2 = $_GET['id'];

					$query = $pdo->query("SELECT * FROM estudantes where id_estudante = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$nome2 = $res[0]['nome'];
					$email2 = $res[0]['email'];
					$curso2 = $res[0]['curso'];

				} else {
					$titulo = "Inserir Registro";

				}


				?>

				<h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form" method="POST">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">

							<div class="form-group">
								<label >Nome</label>
								<input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-md-12" id="divemail">
							<div class="form-group">
								<label >Email</label>
								<input value="<?php echo @$email2 ?>" type="email" class="form-control" id="email" name="email" placeholder="email">
							</div>
						</div>
						<div class="form-group col-md-12">
						<label>Cursos</label>
						<select name="curso"  class="form-control" id="curso">

							<?php
							//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER O NOME DO ITEM ASSOCIADA AO REGISTRO
							if (@$_GET['funcao'] == 'editar') {

								$res_dado = $pdo->query("SELECT * from cursos where cursos = '$curso2'");
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

					


					<small>
						<div id="mensagem">

						</div>
					</small> 

				</div>



				<div class="modal-footer">



					<input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
					<!-- <input value="<?php echo @$cpf2 ?>" type="hidden" name="antigo" id="antigo"> -->
					<input value="<?php echo @$email2 ?>" type="hidden" name="antigo2" id="antigo2">
					<input value="<?php echo @$nome2 ?>" type="hidden" name="nome2" id="nome2">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>






<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Excluir Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p>Deseja realmente Excluir este Registro?</p>

				<small><div align="center" id="mensagem_excluir" class="">	</div></small>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
				<form method="post">

					<input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

					<button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
				</form>
			</div>
		</div>
	</div>
</div>





<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
	echo "<script>$('#modal-deletar').modal('show');</script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
	$("#form").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso!") {
                    //$('#nome').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag="+pag;
                } else {
                	$('#mensagem').addClass('text-danger')
                }
                $('#mensagem').text(mensagem)
            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?=$pag?>";
		$('#btn-deletar').click(function (event) {
			event.preventDefault();
			$.ajax({
				url: pag + "/excluir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					if (mensagem.trim() === 'Excluído com Sucesso!') {
						$('#btn-cancelar-excluir').click();
						window.location = "index.php?pag=" + pag;
					}else{
						$('#mensagem_excluir').addClass('text-danger')
					}
					$('#mensagem_excluir').text(mensagem)

				},

			})
		})
	})
</script>

