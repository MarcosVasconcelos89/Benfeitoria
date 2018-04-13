<?php
include_once '../../control/UsuarioDao.php';

$login = $_POST['login'];
$id = $_POST['id'];

$ativo = $_POST['ativo'];
$usuario = new Usuario('', $login, '', $id, '', $ativo);

$usuarioDao = new UsuarioDao($conexao);

$resposta = $usuarioDao->atualizaUsuario($usuario);
$redirect = "gerenciar.php?msg=".base64_encode($resposta);
echo $ativo;

header("location:$redirect");

?>