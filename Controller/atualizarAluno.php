<?php
session_start();
include_once '../Api/classMediaDao.php';
if(isset($_GET['amediaId'])){
$objtMedia = new Media();
$objtMedia->setMediaId($_GET['mediaId']);
$objtMedia->setMediaAp($_POST['mediaAp']);
$objtMedia->setMinimoRec($_POST['minimoRec']);
$dao = new MediaDAO();
$dao->updateMedia($objtMedia);

$_SESSION['alunoAtualizado'] = "Dados atualizados sucesso!";
    header('location: ../View/alunos.php');

}else{
   $_SESSION ['alunoNaoAtualizado'] = "Falha na atualização dos dados";
   header('location: ../View/alunos.php');
}
?>
