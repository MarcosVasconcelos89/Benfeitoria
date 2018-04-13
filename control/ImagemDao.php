<?php
include_once '../../model/Imagem.php';


include_once 'Conexao.php';

class ImagemDao{
    
    function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    function insereImagem($arquivo, $nome){
        
        $novoNome = $this->renomearArquivo($nome);
        $caminho = $this->moverImagem($arquivo, $novoNome);
        
        try {
            $query = "INSERT INTO Imagem (nome, caminho,nome_antigo) VALUES ('{$novoNome}', '{$caminho}', '{$nome}')";            
            mysqli_query($this->conexao, $query);
            //return id transaction
            $msg = mysqli_insert_id($this->conexao);
        } catch (Exception $e) {
            $msg = "Erro ao inserir ";
        }         

        return $msg;
    }
    
    function validaImagem($tamanho, $tipo){
        //size max 2mb
        $msg = '';
        define('TAMANHO_MAXIMO', (2 * 1024 * 1024));
        if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
        {
            $msg = $msg.'Extensão inválida. ';
            
        }
        
        if ($tamanho > TAMANHO_MAXIMO)
        {
            $msg = $msg.('Tamanho máximo 2 MB, excedido');
            
        }
        
        return $msg;
    }
    
    function moverImagem($arquivo, $nome){
        define('DESTINO', '../images/');
        move_uploaded_file($arquivo, DESTINO.'.'. $nome);        
        return DESTINO ;        
    }
    
    function renomearArquivo($nome){
        //search extension
        $tmp = explode('.', $nome);
        $fileExtension = end($tmp);
        //rename the file by passing date parameters to avoid conflict in the folder
        $newName = date('YmdHis').'.'.$fileExtension;
        rename($nome, $newName);
        return $newName;
    }
    
    function excluirImagem($id){
            //search image
        try {
            $qry = "SELECT nome FROM imagem WHERE id = (SELECT fk_imagem FROM texto WHERE id = '{$id}')";
            $resultado = mysqli_query($this->conexao, $qry);
            while($nome_array = mysqli_fetch_assoc($resultado)) {
                $nome = $nome_array['nome'];
            }
            //delete image from directory
            if(!empty($nome)){
                $this->apagarImagem($nome);
                //delete register BD
                $query = "DELETE FROM imagem WHERE id = (SELECT fk_imagem FROM texto WHERE id = '{$id}')";
                mysqli_query($this->conexao, $query);
                $msg = "Imagem  excluida com sucesso!";
            }else{
                $msg = "Não existe imagem para deletar!";
            }

        } catch (Exception $e) {
            $msg = "Erro ao excluir ";
        }        
        
        return $msg;
    }
    
    function apagarImagem($nome){
        unlink('../images/.'.$nome);
        return 'ok';
    }
    
    function apagarRegistroBD($id){
        try {
            $query = "DELETE FROM imagem WHERE id = '{$id}'";
            mysqli_query($this->conexao, $query);
            $msg = "Imagem  excluida com sucesso!";
        } catch (Exception $e) {
            $msg = "Erro!";
        }
    }
    
    function verificarImagem($nome, $id){
        try {
            $query= "SELECT COUNT(texto.id) FROM texto INNER JOIN imagem ON texto.fk_imagem = imagem.id 
                     WHERE texto.id = '{$id}' AND imagem.nome_antigo = '{$nome}'";
            $resultado = mysqli_query($this->conexao, $query);
            while($imagem_array = mysqli_fetch_assoc($resultado)) {
                $qtd = $imagem_array['nome'];
            }
        } catch (Exception $e) {
            $qtd = "erro";
        }
        
        return $qtd;
    }
    //check associated image on bd
    function verificarExisteImagem( $id){
        try {
            $query= "SELECT fk_imagem FROM texto WHERE id = '{$id}'";
            $resultado = mysqli_query($this->conexao, $query);
            while($imagem_array = mysqli_fetch_assoc($resultado)) {
                $qtd = $imagem_array['fk_imagem'];
            }
        } catch (Exception $e) {
            $qtd = "erro";
        }
        
        return $qtd;
    }
    
    function buscaNomeImagem( $id){
        try {
            $query= "SELECT nome FROM imagem WHERE id = '{$id}'";
            $resultado = mysqli_query($this->conexao, $query);
            while($imagem_array = mysqli_fetch_assoc($resultado)) {
                $qtd = $imagem_array['nome'];
            }
        } catch (Exception $e) {
            $qtd = "erro";
        }
        
        return $qtd;
    }
    
    function AtualizaTexto($id){
        try {
            $query= "UPDATE texto SET fk_imagem= 0   WHERE id = '{$id}'";
            $resultado = mysqli_query($this->conexao, $query);
            $msg = 'ok';
        } catch (Exception $e) {
            $msg = 'erro';
        }
        return $msg;
    }
    
    
}