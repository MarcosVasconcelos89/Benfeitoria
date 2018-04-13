<?php
include_once '../../control/Conexao.php';
include_once '../../control/ImagemDao.php';

if(isset($_GET['id'])){
    $parte = explode('|', $_GET['id']);
    $id = $parte[0];
    $nome = $parte[1];
    $id_texto = $parte[2];
    
    $imagemDao = new ImagemDao($conexao);
    $imagemDao->apagarImagem($nome);
    $imagemDao->apagarRegistroBD($id);
    $imagemDao->AtualizaTexto($id_texto);
  
    $redirect = "editar.php?id=".base64_encode($id_texto);
      
    header("location:$redirect");
    
    
}
?>