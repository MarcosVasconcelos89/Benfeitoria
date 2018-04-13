<?php
include_once '../../control/TextoDao.php';
include_once '../../control/ImagemDao.php';

$infoTexto = base64_decode($_GET['id']);
$info = explode('|', $infoTexto);
$id = $info[0];
$titulo = $info[1];


$imagemDao = new ImagemDao($conexao);
$imagem = new Imagem();
$resposta = $imagemDao->excluirImagem($id);
print_r( $resposta);


$texto = new Texto($id, '', '', $imagem,'', '', '', '','');
$textoDao = new TextoDao($conexao);

$resposta = $textoDao->excluirTexto($texto);
$redirect = "gerenciar.php?msg=".base64_encode($resposta);

header("location:$redirect");

?>