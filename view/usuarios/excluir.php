<?php
include_once '../../control/UsuarioDao.php';

$infoUsuario = base64_decode($_GET['id']);
$info = explode('|', $infoUsuario);
$id = $info[0];
$login = $info[1];
$usuario = new Usuario('', $login, '', $id, '', '');
$usuarioDao = new UsuarioDao($conexao);

$resposta = $usuarioDao->excluirUsuario($usuario);
$redirect = "gerenciar.php?msg=".base64_encode($resposta);


header("location:$redirect");

?>