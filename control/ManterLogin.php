<?php
session_start();

function usuarioEstaLogado() {
    return isset($_SESSION["usuario_logado"]);
}

function verificaUsuario() {
    if(!isset($_SESSION['id'])) {        
        header("Location: ../usuarios/login.php");
        die();
    }
}

function logout() {
    session_destroy();
    session_start();
}