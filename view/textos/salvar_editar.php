<?php
include_once '../../control/TextoDao.php';
include_once '../../control/ImagemDao.php';
include_once '../../model/Usuario.php';
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$foto = $_FILES['imagem'];
$mensagem = $_POST['mensagem'];
$principal = $_POST['principal'];
$publicado = $_POST['publicado'];

$nome = $foto['name'];
$extensao = $foto['type'];
$tamanho = $foto['size'];
//transforming into binary
$arquivo = $foto['tmp_name'];
$imagem = new Imagem();
$imagemDao = new ImagemDao($conexao);

//check if there is an image to insert
if(!empty($nome)){
    //checks if there is an image in the bank attached to this post
    $existeNoBanco = $imagemDao->verificarExisteImagem($id);
    
    //no exist
    if($existeNoBanco == 0){
        //normal post
        $verificarImagem = $imagemDao->validaImagem($tamanho, $extensao);
        if($verificarImagem ==''){
            $imagem->setId($imagemDao->insereImagem($arquivo,$nome ));
        }else{
            $imagem->setId('n');
        }
        
        if($verificarImagem ==''){
            $usuario = new Usuario('', '', '', '', '', '');
            $texto = new Texto($id, $titulo, $subtitulo, $imagem, $mensagem, $publicado, $principal, '','');
            $textoDao = new TextoDao($conexao);
            $msg = $textoDao->atualizaTexto($texto);
            echo $msg;
            
            
        }else{
            $msg = $verificarImagem;
        }
        
        
    }else{
        //exist image
        //delete + new insert
        //search name in directory
        $nomeImagemBD = $imagemDao->buscaNomeImagem($existeNoBanco);
        echo $nomeImagemBD;
        //delete image on directory
        $imagemDao->apagarImagem($nomeImagemBD);
        //delete register bd
        $imagemDao->apagarRegistroBD($existeNoBanco);
        //normal post
        $verificarImagem = $imagemDao->validaImagem($tamanho, $extensao);
        if($verificarImagem ==''){
            $imagem->setId($imagemDao->insereImagem($arquivo,$nome ));
        }else{
            $imagem->setId('n');
        }
        
        if($verificarImagem ==''){
            $usuario = new Usuario('', '', '', '', '', '');            
            $texto = new Texto($id, $titulo, $subtitulo, $imagem, $mensagem, $publicado, $principal, '','');
            $textoDao = new TextoDao($conexao);            
            $msg = $textoDao->atualizaTexto($texto);
                        
            
        }else{
            $msg = $verificarImagem;
        }  
    }
}else{
    //checks if there is an image in the bank attached to this post
    $existeNoBanco = $imagemDao->verificarExisteImagem($id);

    
    //exists
    if($existeNoBanco >= 1){
        //repeat id
        $imagem =  new Imagem();
        $imagem->setId($existeNoBanco) ;        
        $usuario = new Usuario('', '', '', '', '', '');        
        $texto = new Texto($id, $titulo, $subtitulo, $imagem, $mensagem, $publicado, $principal, '', $usuario);
        $textoDao = new TextoDao($conexao);
        
        $msg = $textoDao->atualizaTexto($texto);
    }else{
        //no exists and not have nothing to insert
        $imagem->getId($existeNoBanco) ;
        
        $usuario = new Usuario('', '', '', '', '', '');        
        $texto = new Texto($id, $titulo, $subtitulo, $imagem, $mensagem, $publicado, $principal, '', $usuario);
        $textoDao = new TextoDao($conexao);        
        $msg = $textoDao->atualizaTexto($texto);
        
    }
    
}

$redirect = "gerenciar.php?msg=".base64_encode($msg);


header("location:$redirect");

?>