<?php
session_start();
include_once '../Api/secury.php';
require_once '../Api/classUsuarioDao.php';
$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->listUsuarios();
if(isset($_GET['userId'])){
  $userId = $_GET['userId'];
  $usuario = $usuarioDAO->searchUsuario($userId);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Escolar</title>

    <!-- Bootstrap Core CSS -->
    <link href="../Components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../Components/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../Components/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../Components/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../Components/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Css extorno -->
    <link href="../Components/style.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav id="barra-pagina"  id="barra-pagina" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="barra-pagina" class="navbar-brand" href="">Sistema Escolar 2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <ul class="dropdown-menu dropdown-messages"></ul>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <ul class="dropdown-menu dropdown-tasks"></ul>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <ul class="dropdown-menu dropdown-alerts"></ul>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="../Api/logout.php"  id="barra-pagina">
                        <i class="fa fa-user fa-fw"></i> Logado: <?php echo $_SESSION['nomeUser'];?> <i class="fa fa-sign-out fa-fw"></i> Sair</i>
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      <li>
                          <a href="painelAdm.php"><i class="fa fa-dashboard fa-fw"></i> Painel Admin</a>
                      </li>
                      <li>
                          <a href="alunos.php"><i class="fa fa-users fa-fw"></i> Alunos</a>
                      </li>
                      <li>
                          <a href="professor.php"><i class="fa fa-users fa-fw"></i> Professores</a>
                      </li>
                      <li>
                          <a href="../Controller/backupDb.php"><i class="fa fa-database fa-fw"></i> Fazer Backup</a>
                      </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Usuários</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="barra-pagina">
                            Editar dados do Usuário
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <form role="form" action="../Controller/atualizarUsuario.php?userId=<?= $usuario->getUserId();?>" method="post">
                                        <div class="form-group col-lg-3 col-xs-3">
                                        <label>Nome: </label>
                                            <input class="form-control" name="nomeUser"
                                            value="<?php echo $usuario->getNomeUser();?>">
                                        </div>
                                        <div class="form-group col-lg-5 col-xs-5">
                                        <label>E-mail: </label>
                                            <input class="form-control" name="email"
                                            value="<?php echo $usuario->getEmail();?>">
                                        </div>
                                        <div class="form-group col-lg-4 col-xs-4">
                                        <label>Senha atual ou nova senha: </label>
                                            <input class="form-control"  type="password" name="password" required="">
                                        </div>
                                        <div class="form-group col-lg-4 col-xs-4">
                                        <label>Tipo: </label>
                                        <select class="form-control"  name="tipo">
                                            <option><?php echo $usuario->getTipo();?></option>
                                                <option  value="Admin">Usuário Admim</option>
                                                <option  value="User">Usuário Comum</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-xs-4">
                                        <label>Status: </label>
                                        <select class="form-control"  name="status">
                                        <?php
                                        $usuario->getStatus();
                                        if($usuario->getStatus() == 1){
                                          $user = 'Ativo';
                                        }else{
                                            $user = 'Inativo';
                                        }
                                        ?>
                                            <option><?php echo $user;?></option>
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-xs-4">
                                        <br>
                                        <button  type="submit" class="btn btn-primary">Salvar Alterações</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="barra-pagina">
                           Lista de Usuários
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>E-mail</th>
                                        <th>Tipo</th>
                                        <th> Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($usuario = array_shift($usuarios)){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $usuario->getNomeUser();?></td>
                                        <td><?php echo $usuario->getEmail();?></td>
                                        <td><?php echo $usuario->getTipo();?></td>
                                        <?php
                                        $usuario->getStatus();
                                        if($usuario->getStatus() == 1){
                                          $user = '<button class="btn btn-success btn-xs">On</button>';
                                        }else{
                                            $user = '<button class="btn btn-danger btn-xs">Off</button>';
                                        }
                                        ?>
                                        <td>
                                        <?php echo $user;?>

                                        </td>
                                        <td>
                                        <a href="editarUsuario.php?UserId=<?= $usuario->getUserId();?>">
                                        <button  class="btn btn-warning btn-xs"><i id="btn-detalhe" class="fa  fa-pencil"></i> </button></a>
                                        <a href="../Controller/excluirUser.php?UserId=<?= $usuario->getUserId();?>">
                                        <button class="btn btn-danger btn-xs"><i id="btn-detalhe" class="fa  fa-trash"></i> </button></a>
                                    </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                </div>
        <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../Components/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Components/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../Components/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../Components/vendor/raphael/raphael.min.js"></script>
    <script src="../Components/vendor/morrisjs/morris.min.js"></script>
    <script src="../Components/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../Components/dist/js/sb-admin-2.js"></script>
    <script src="../Components/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../Components/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../Components/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
