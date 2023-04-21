<?php
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'docente') {
  echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php");







?>



<div class="row">

  <?php $query = $pdo->query("SELECT * FROM temas order by id_tema desc ");
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

    if ($nome_usu == $doc) {
      $doc2 = "Meu Tema";
    }
    else {
      $doc2 = "Docente: " . $doc;
    }

  ?>
    <!-- <div class="col-lg-6">

      <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo $nome ?></h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 18px, 0px);">
              <a class="dropdown-item" href="index.php?pag=<?php echo $menu4 ?>&funcao=editar&id=<?php echo $id ?>">Ver Mais</a>

            </div>
          </div>
        </div>

        <div class="card-body">
          <?php echo $desc ?>
        </div>
        <div class="card-footer">
          <?php echo $doc2 ?>
        </div>
      </div>
    </div> -->
    
    
    <div class=" col-md-4 mb-4">
      <a href="<?php  if ($nome_usu == $doc) {
      $doc2 = "Meu Tema";
      echo "index.php?pag=".$menu4."&funcao=editar&id=".$id;
    }
    else {
      $doc2 = "Docente: " . $doc;
      echo "index.php?pag=detalhes&id=".$id;
    }
 ?> " style="text-decoration:none">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $doc2 ?></div>
                <div class="h5 mb-2 font-weight-bold text-gray-800"><?= $nome ?></div>
                <div class="p mb-0 font-weight-normal text-gray-800"><?= $breve_descricao . "..." ?></div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

  <?php } ?>



</div>

<div class=" col-md-4 mb-4">
      <a href="<?php  if ($nome_usu == $doc) {
      $doc2 = "Meu Tema";
      echo "index.php?pag=".$menu4."&funcao=editar&id=".$id;
    }
    else {
      $doc2 = "Docente: " . $doc;
      echo "index.php?pag=detalhes&id=".$id;
    }