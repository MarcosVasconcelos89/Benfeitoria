<?php
include_once '../../control/TextoDao.php';
include_once '../../control/ImagemDao.php';
include_once '../../model/Usuario.php';

$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$foto = $_FILES['imagem'];
$mensagem = $_POST['mensagem'];
$principal = $_POST['principal'];


$nome = $foto['name'];
$extensao = $foto['type'];
$tamanho = $foto['size'];
//transforming into binary
$arquivo = $foto['tmp_name'];

$imagemDao = new ImagemDao($conexao);
//validate img type and size
$verificarImagem = '';
$imagem = new Imagem();
if(!empty($nome)){
    $verificarImagem = $imagemDao->validaImagem($tamanho, $extensao);
    if($verificarImagem ==''){
    $imagem->setId($imagemDao->insereImagem($arquivo,$nome ));
    }
}else{
    $imagem->setId('n');
}


if($verificarImagem ==''){
    
    
    $id = '';
    $usuario = new Usuario('', '', '', $id, '', '');
    $usuario->setId($_POST['usuario']);    
    $texto = new Texto('', $titulo, $subtitulo, $imagem, $mensagem, '', $principal, '', $usuario);
    $textoDao = new TextoDao($conexao);
    
    $msg = $textoDao->insereTexto($texto);
    echo $msg;
    
    
}else{
    $msg = $verificarImagem;
}
 


$redirect = "cadastrar.php?msg=".base64_encode($msg);
echo $redirect;

header("location:$redirect");


?>