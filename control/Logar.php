<?php
require_once("conexao.php");

function buscaUsuario($conexao, $user, $senha) {
    
    $senhaMd5 = md5($senha);
    $email = mysqli_real_escape_string($conexao, $user);
    $query = "select id, login from usuario where login='{$user}' and senha='{$senhaMd5}' AND ativo != 1";
    $resultado = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    
    return $usuario;
}


