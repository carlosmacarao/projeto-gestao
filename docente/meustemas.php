<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'docente'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "meustemas";
require_once("../conexao.php"); 


?>

<div class="row mt-4 mb-4">
	<a type="button" class="btn-secondary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $menu4 ?>">Adicionar Tema</a>
	<a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>



<div class="row">

<?php $query = $pdo->query("SELECT * FROM temas where docente = '$nome_usu' order by id_tema desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['titulo'];
						$id = $res[$i]['id_tema'];
						$email = $res[$i]['email'];
						$desc = $res[$i]['descricao'];
						$breve_descricao = $res[$i]['breve_descricao'];
						?>
		    <div class=" col-md-4 mb-4">
      <a href="index.php?pag=<?php echo $menu4 ?>&funcao=editar&id=<?php echo $id ?>" style="text-decoration:none">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=$doc?></div>
              <div class="h5 mb-2 font-weight-bold text-gray-800"><?=$nome?></div>
              <div class="p mb-0 font-weight-normal text-gray-800"><?=$breve_descricao."..."?></div>
            </div>
          </div>
        </div>
      </div>
      </a>
    </div>

					<?php } ?>

          

            </div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
						<div class="col-md-6">

							<div class="form-group">
								<label >Nome</label>
								<input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
							</div>

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label >Tipo Pessoa</label>
								<select name="tipo_pessoa" class="form-control" id="pessoa">
									<option <?php if($tipo_pessoa2 == 'Física'){ ?> selected <?php } ?> value="Física">Física</option>
									<option <?php if($tipo_pessoa2 == 'Jurídica'){ ?> selected <?php } ?> value="Jurídica">Jurídica</option>
									
								</select>
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label >Tipo Pessoa</label>
								<select name="tipo_pessoa" class="form-control" id="pessoa">
									<option <?php if($tipo_pessoa2 == 'Física'){ ?> selected <?php } ?> value="Física">Física</option>
									<option <?php if($tipo_pessoa2 == 'Jurídica'){ ?> selected <?php } ?> value="Jurídica">Jurídica</option>
									
								</select>
							</div>
						</div> -->
					</div>

					<div class="row">

						<div class="col-md-6" id="divemail">
							<div class="form-group">
								<label >Email</label>
								<input value="<?php echo @$email2 ?>" type="email" class="form-control" id="email" name="email" placeholder="email">
							</div>
						</div>

						<div class="col-md-6" id="divcnpj">
							<div class="form-group">
								<label >CNPJ</label>
								<input value="<?php echo @$cpf2 ?>" type="text" class="form-control" id="cnpj" name="cnpj_mec" placeholder="CNPJ">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label >Telefone</label>
								<input value="<?php echo @$telefone2 ?>" type="text" class="form-control" id="telefone" name="telefone_mec" placeholder="Telefone">
							</div>
						</div> 
					</div>

					

					

					<!-- <div class="form-group">
						<label >Email</label>
						<input value="<?php echo @$email2 ?>" type="text" class="form-control" id="email" name="email_mec" placeholder="Email">
					</div>

					<div class="form-group">
						<label >Endereço</label>
						<input value="<?php echo @$endereco2 ?>" type="text" class="form-control" id="endereco" name="endereco_mec" placeholder="Endereçõ">
					</div> -->


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
				<a href="index.php?pag=<?=$pag?>"><button type="button" class="close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button></a>
				
			</div>
			<div class="modal-body">

				<p>Deseja realmente Excluir este Registro?</p>

				<small><div align="center" id="mensagem_excluir" class="">	</div></small>

			</div>
			<div class="modal-footer">
			 <a href="index.php?pag=<?=$pag?>"><button type="button" class="btn btn-secondary"  id="btn-cancelar-excluir">Cancelar</button></a>
				
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
				url: "temas/excluir.php",
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
		$('#dataTable').dataTable({
			"ordering": false
		})

	});
</script>



<script type="text/javascript">
  var pessoa = "<?=$tipo_pessoa2?>";
   $(document).ready(function() {
  	if(pessoa === "Física"){
      document.getElementById('divcnpj').style.display = "none"; 
  	}else{
  	  document.getElementById('divcpf').style.display = "none";
  	}
})

  $('#pessoa').change(function (event) {
  	var select = document.getElementById('pessoa');
  	var value = select.options[select.selectedIndex].value;
  	if(value === 'Física'){
  		document.getElementById('divcnpj').style.display = "none";
  		document.getElementById('divcpf').style.display = "block";
  	}else{
  		document.getElementById('divcnpj').style.display = "block";
  		document.getElementById('divcpf').style.display = "none";
  	}
  	
  });

</script>