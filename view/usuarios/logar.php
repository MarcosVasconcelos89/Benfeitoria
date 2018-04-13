<?php
include_once '../../control/Conexao.php';
include_once '../../control/Logar.php';
include_once '../../control/UsuarioDao.php';
session_start();
$login = $_POST["login"];
$senha = $_POST['senha'];

$usuarioDao = new UsuarioDao($conexao);
$usuario = new Usuario('', $login, $senha, '', '', '');
$injection = $usuarioDao->antiInjection($usuario);

if($injection <= 0){
    $resultado = buscaUsuario($conexao, $_POST["login"], $_POST["senha"]);
}else{
    $resultado = '';
}

if($resultado == null) {
    $msg = "Usuário ou senha inválido.";
    header("Location: login.php?msg=".base64_encode($msg));
} else {
    $_SESSION["login"] = $resultado['login'];
    $_SESSION["id"]= $resultado['id'];
    $_SESSION["success"] = " logado com sucesso!";

    header("Location: bem_vindo.php");
}
die();
