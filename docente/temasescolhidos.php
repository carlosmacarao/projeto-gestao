<?php

$pag ="temasescolhidos";

?>





<div class="card shadow mb-4">

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Tema Escolhido</th>
						<th>Nome do Estudante</th>
						<th>Email do Estudante</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>

					<?php 

					$query = $pdo->query("SELECT * FROM escolhidos where confirmacao ='nao' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['tema'];
						$nome_estudante = $res[$i]['nome_estudante'];
						$curso =$res[$i]['curso'];
						$id = $res[$i]['id_escolhido'];
						$email_estudante=$res[$i]['email_estudante'];
						?>
						<tr>
							<td><?php echo $nome ?></td>
							<td><?php echo $nome_estudante ?></td>
							<td><?php echo $email_estudante ?></td>
							<td>
							<a title="recusar estudante" href="index.php?pag=<?php echo $pag ?>&funcao=recusar&id=<?php echo $id ?>" class='text-danger mr-1'><i class='far fa-do-not-enter'></i></a>
								<a title="aceitar estudante" href="index.php?pag=<?php echo $pag ?>&funcao=aceitar&id=<?php echo $id ?>" class='text-success mr-1'><i class='far fa-check'></i></a>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal" id="modal-aceitar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Aceitar Estudante</h5>
				<a href="index.php?pag=<?=$pag?>"><button type="button" class="close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button></a>
				
			</div>
			<div class="modal-body">

				<p>Deseja realmente Aceitar o Estudante?</p>

				<small><div align="center" id="mensagem_excluir" class="">	</div></small>

			</div>
			<div class="modal-footer">
			 <a href="index.php?pag=<?=$pag?>"><button type="button" class="btn btn-secondary"  id="btn-cancelar-excluir">Cancelar</button></a>
				
				<form method="post">

					<input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

					<button type="button" id="btn-aceitar" name="btn-aceitar" class="btn btn-success">Aceitar</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal-recusar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Recusar Estudante</h5>
				<a href="index.php?pag=<?=$pag?>"><button type="button" class="close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button></a>
				
			</div>
			<div class="modal-body">

				<p>Deseja realmente Recusar o Estudante?</p>

				<small><div align="center" id="mensagem_excluir" class="">	</div></small>

			</div>
			<div class="modal-footer">
			 <a href="index.php?pag=<?=$pag?>"><button type="button" class="btn btn-secondary"  id="btn-cancelar-excluir">Cancelar</button></a>
				
				<form method="post">

					<input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

					<button type="button" id="btn-recusar" name="btn-recusar" class="btn btn-danger">Recusar</button>
				</form>
			</div>
		</div>
	</div>
</div>




<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "aceitar") {
	echo "<script>$('#modal-aceitar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "recusar") {
	echo "<script>$('#modal-recusar').modal('show');</script>";
}

?>




<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?=$pag?>";
		$('#btn-aceitar').click(function (event) {
			event.preventDefault();
			$.ajax({
				url: "temas/aceitar.php",
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
					$('#btn-cancelar-excluir').click();

				},

			})
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?=$pag?>";
		$('#btn-recusar').click(function (event) {
			event.preventDefault();
			$.ajax({
				url: "temas/recusar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					if (mensagem.trim() === 'Aceitou com sucesso,<br> BOM TRABALHO') {
						$('#btn-cancelar-excluir').click();
						window.location = "index.php?pag=" + pag;
					}else{
						$('#mensagem_excluir').addClass('text-danger')
					}
					$('#mensagem_excluir').text(mensagem)
					$('#btn-cancelar-excluir').click();

				},

			})
		})
	})
</script>