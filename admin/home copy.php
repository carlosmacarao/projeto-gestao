<?php
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php"); 


//totais dos cards
$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";

$query_cat = $pdo->query("SELECT * FROM orcamentos where status = 'Concluído' and data >= '$dataInicioMes' and data <= curDate()");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalConcluidos = @count($res_cat);

$query_cat = $pdo->query("SELECT * FROM orcamentos where status = 'Aberto' and data >= '$dataInicioMes' and data <= curDate() ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalPendentes = @count($res_cat);

$query_cat = $pdo->query("SELECT * FROM orcamentos where status = 'Aprovado' and data >= '$dataInicioMes' and data <= curDate() ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalAprovados = @count($res_cat);


$query_cat = $pdo->query("SELECT * FROM produtos  ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalProdutos = @count($res_cat);



$query_cat = $pdo->query("SELECT * FROM os where concluido != 'Sim'  ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalServPendentes = @count($res_cat);


$query_cat = $pdo->query("SELECT * FROM clientes  ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalClientes = @count($res_cat);



$query_cat = $pdo->query("SELECT * FROM mecanicos  ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalMecanicos = @count($res_cat);

$vendasDia = 0;
$query_cat = $pdo->query("SELECT * FROM vendas where data = curDate()");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res_cat); $i++) { 
	foreach ($res_cat[$i] as $key => $value) {
	}
	$valor = $res_cat[$i]['valor'];
	$vendasDia = $vendasDia + $valor;
	
}
$vendasDia = number_format($vendasDia, 2, ',', '.');




$totalComissoesHoje = 0;
$query_cat = $pdo->query("SELECT * FROM comissoes where data = curDate() and mecanico = '$_SESSION[cpf_usuario]' ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res_cat); $i++) { 
	foreach ($res_cat[$i] as $key => $value) {
	}
	$valor = $res_cat[$i]['valor'];
	$totalComissoesHoje = $totalComissoesHoje + $valor;
	
}
$totalComissoesHoje = number_format($totalComissoesHoje, 2, ',', '.');




//TOTALIZAR MOVIMENTÃÇÕES NO DIA
$saldo = 0;
$entradas = 0;
$saidas = 0;
$query = $pdo->query("SELECT * FROM movimentacoes where data = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res); $i++) { 
foreach ($res[$i] as $key => $value) {
}
$valor = $res[$i]['valor'];
$tipo = $res[$i]['tipo'];

if($tipo == 'Entrada'){
	$entradas = $entradas + $valor;
}else{
	$saidas = $saidas + $valor;
}

}

$saldo = $entradas - $saidas;
if($saldo < 0){
	$corTotal = 'text-danger';
	$corTotal2 = 'border-left-danger';
}else{
	$corTotal = 'text-success';
	$corTotal2 = 'border-left-success';
}

$entradas = number_format($entradas, 2, ',', '.');
$saidas = number_format($saidas, 2, ',', '.');
$saldo = number_format($saldo, 2, ',', '.');






//TOTALIZAR MOVIMENTÃÇÕES NO MES
$saldoMes = 0;
$entradasMes = 0;
$saidasMes = 0;
$query = $pdo->query("SELECT * FROM movimentacoes where data >= '$dataInicioMes' and data <= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res); $i++) { 
foreach ($res[$i] as $key => $value) {
}
$valor = $res[$i]['valor'];
$tipo = $res[$i]['tipo'];

if($tipo == 'Entrada'){
	$entradasMes = $entradasMes + $valor;
}else{
	$saidasMes = $saidasMes + $valor;
}

}

$saldoMes = $entradasMes - $saidasMes;
if($saldoMes < 0){
	$corTotalMes = 'text-danger';
	$corTotal2Mes = 'border-left-danger';
}else{
	$corTotalMes = 'text-success';
	$corTotal2Mes = 'border-left-success';
}

$entradasMes = number_format($entradasMes, 2, ',', '.');
$saidasMes = number_format($saidasMes, 2, ',', '.');
$saldoMes = number_format($saldoMes, 2, ',', '.');




?>

<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$entradas ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-success"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saídas do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$saidas ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card <?php echo $corTotal2 ?> shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold <?php echo $corTotal ?> text-uppercase mb-1">Saldo do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo @$saldo ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x <?php echo $corTotal ?>"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card <?php echo $corTotal2Mes ?> shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold <?php echo $corTotalMes ?> text-uppercase mb-1">Saldo do Mês</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo @$saldoMes ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x <?php echo $corTotalMes ?>"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>








<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Orçamentos Concluídos</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalConcluidos ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-success"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Orçamentos Pendentes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalPendentes ?> </div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orçamentos Aprovados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalAprovados ?> </div>
					</div>
					<div class="col-auto" align="center">
						<i class="fas fa-clipboard-list fa-2x text-primary"></i>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Serviços Pendentes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalServPendentes ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produtos Cadastrados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalProdutos ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-box-open fa-2x text-info"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Clientes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalClientes ?> </div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mecânicos</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalMecanicos ?> </div>
					</div>
					<div class="col-auto" align="center">
						<i class="fas fa-clipboard-list fa-2x text-primary"></i>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendas do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$vendasDia ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-success"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>