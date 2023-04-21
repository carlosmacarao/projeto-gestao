<?php
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php"); 

$pag ="temas";

?>



<div class="row">

<?php $query = $pdo->query("SELECT * FROM temas order by id_tema desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['titulo'];
						$id = $res[$i]['id_tema'];
						$email = $res[$i]['email'];
						$desc = $res[$i]['descricao'];
						$doc = $res[$i]['docente'];
						?>
						 <div class="col-lg-6">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $nome?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 18px, 0px);">
                      <a class="dropdown-item" href="index.php?pag=<?php echo $menu4 ?>&funcao=editar&id=<?php echo $id ?>">Ver Mais</a>
                      
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
				<?php echo $desc ?>
                </div>
                <div class="card-footer">
				Docente: <?php echo $doc ?>
                </div>
              </div>
           </div>

					<?php } ?>

          

            </div>