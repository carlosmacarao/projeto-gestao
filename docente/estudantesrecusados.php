<?php

$pag ="estudantesrecusados";

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
					
					</tr>
				</thead>

				<tbody>

					<?php 

					$query = $pdo->query("SELECT * FROM escolhidos where confirmacao='recusado'");
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
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>