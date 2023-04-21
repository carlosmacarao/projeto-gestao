<?php
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'estudante') {
  echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php");

$query_tema = $pdo->query("SELECT * FROM escolhidos where tema='$titulo'");
$dados_tema = $query_tema->fetchAll(PDO::FETCH_ASSOC);
@$escolha = count($dados_tema);
if ($escolha >= 2) {
  $mostrar = "Tema Indisponivel";
}

?>
<div class="container">


  <div class="row">



    <?php $query = $pdo->query("SELECT * FROM temas where curso ='$curso_estu' order by id_tema desc ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < @count($res); $i++) {
      foreach ($res[$i] as $key => $value) {
      }
      $nome = $res[$i]['titulo'];
      $id = $res[$i]['id_tema'];
      $email = $res[$i]['email'];
      $desc = $res[$i]['descricao'];
      $breve_descricao = $res[$i]['breve_descricao'];
      $doc = $res[$i]['docente'];

      $query_tema = $pdo->query("SELECT * FROM escolhidos where tema='$nome'");
      $dados_tema = $query_tema->fetchAll(PDO::FETCH_ASSOC);
      @$escolha = count($dados_tema);

    ?>

      <div class=" col-md-4 mb-4">
        <a href="index.php?pag=detalhes&id=<?php echo $id ?>" style="text-decoration:none">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $doc ?></div>
                  <div class="h5 mb-2 font-weight-bold text-gray-800"><?= $nome ?> <p class="text-danger" style="font-size:12px;"><?php if ($escolha >= 3) {
                                                                                                                                  echo "Tema Indisponivel";
                                                                                                                                } ?></p>
                  </div>
                  <div class="p mb-0 font-weight-normal text-gray-800"><?= $breve_descricao . "..." ?></div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>






    <?php } ?>
  </div>


</div>