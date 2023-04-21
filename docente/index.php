<?php
@session_start();

require_once("../conexao.php");

if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'docente') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}



$query = $pdo->query("SELECT * FROM docentes where email = '$_SESSION[email_usuario]' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = @$res[0]['nome'];
$email_usu = @$res[0]['email'];
$id_docented = @$res[0]['id_docentes'];

//variaveis para o menu
$pag = @$_GET["pag"];
$menu1 = "";
$menu2 = "meustemas";
$menu4 = "adicionartema";
$menu5 = "detalhes";
$menu6 = "temasescolhidos";
$menu7 = "estudantesaceitos";
$menu8 = "estudantesrecusados";


?>




<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hugo Vasconcelos">

    <title>Painel Docente</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


    <!-- <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/logo-favicon.png" type="image/x-icon">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">Docente</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu1 ?>"><i class="fas fa-users"></i> Temas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu2 ?>"><i class="fas fa-users"></i>Meus Temas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Estados</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="index.php?pag=<?php echo $menu6 ?>">Temas Escolhidos</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu7 ?>">Estudantes Aceites</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu8 ?>">Estudantes Recusados</a>

                    </div>
                </div>
            </li>




            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <img class="" src="../img/logo2.png" width="55">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo @$nome_usu; ?></span>
                                <img class="img-profile rounded-circle" src="../img/sem-foto.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Ver Dados
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if (@$pag == null) {
                        @include_once("home.php");
                    } else if (@$pag == $menu1) {
                        @include_once(@$menu1 . ".php");
                    } else if (@$pag == $menu2) {
                        @include_once(@$menu2 . ".php");
                    } else if (@$pag == $menu4) {
                        @include_once(@$menu4 . ".php");
                    }else if (@$pag == $menu5) {
                        @include_once(@$menu5 . ".php");
                    }else if (@$pag == $menu6) {
                        @include_once(@$menu6 . ".php");
                    }else if (@$pag == $menu7) {
                        @include_once(@$menu7 . ".php");
                    }else if (@$pag == $menu8) {
                        @include_once(@$menu8 . ".php");
                    }else {
                        @include_once("home.php");
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perfil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-perfil" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nome</label>
                            <input value="<?php echo $nome_usu ?>" type="text" class="form-control" id="nome_usu" name="nome_usu" placeholder="Nome">
                        </div>


                        <div class="form-group">
                            <label>Email</label>
                            <input value="<?php echo $email_usu ?>" type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Email">
                        </div>
                       
                        <div class="form-group">
                            <label>Senha</label>
                            <input value="<?php echo $_SESSION['senha_usuario']; ?>" type="password" class="form-control" id="senha_usu" name="senha_usu">
                        </div>



                        <small>
                            <div id="mensagem" class="mr-4">

                            </div>
                        </small>



                    </div>
                    <div class="modal-footer">
                        <input value="<?php echo $_SESSION['id_usuario'] ?>" type="hidden" name="id_usu" id="id_usu">
                        <input value="<?php echo $id_docented ?>" type="hidden" name="id_doc" id="id_doc">
                        <input value="<?php echo $email_usu ?>" type="hidden" name="email_ant" id="email_ant">
                        <button type="button" id="btn-fechar-perfil" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>






<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
    $("#form-perfil").submit(function() {

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "editar-perfil.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    //$('#nome').val('');
                    $('#btn-fechar-perfil').click();
                    window.location = "http://localhost/fauzen/docente";
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