<?php
include_once '../../control/UsuarioDao.php';

$login = $_POST['login'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$usuario = new Usuario($nome, $login, $senha);
$usuarioDao = new UsuarioDao($conexao);

$resposta = $usuarioDao->insereUsuario($usuario);
$redirect = "cadastrar.php?msg=".base64_encode($resposta);
echo $redirect;

header("location:$redirect");