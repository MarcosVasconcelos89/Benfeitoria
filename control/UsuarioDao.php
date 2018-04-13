<?php
include_once '../../model/Usuario.php';


include_once 'Conexao.php';

class UsuarioDao{
    
    function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    
    function insereUsuario(Usuario $usuario){
        
        //check special characters
        $injection = $this->antiInjection($usuario);
        //verifies that the user already exists in the database
        $qtd =  $this->verificarExistenciaUsuario($usuario);
        
        if(($qtd <= 0)&&($injection <= 0) && (!empty($usuario->getNome())) && (!empty($usuario->getSenha())) && (!empty($usuario->getLogin()))){
            //encryption for password
            $senha =  md5($usuario->getSenha());
            try {
                $query = "INSERT INTO usuario (nome, login, senha) VALUES ('{$usuario->getNome()}', '{$usuario->getLogin()}', '{$senha}')";
                mysqli_query($this->conexao, $query);
                $msg = $usuario->getNome()." cadastrado com sucesso!";
            } catch (Exception $e) {
                $msg = "Erro ao inserir ".$usuario->getNome();
            }            
            
        }else{
            $msg = '';
            if($qtd > 0){
                $msg = "O Usuário ".$usuario->getNome()." já existe na base.";
            }
            if($injection > 0){
                $msg = "Caractere especial encontrado, favor refazer o cadastro.";
            }            
            
        }
        
        return $msg;
 
    }
    
    //verifies that the user already exists in the database
    function verificarExistenciaUsuario(Usuario $usuario){
        //verify in lowercase
        $user = strtolower($usuario->getLogin());
        try {
            $query = mysqli_query($this->conexao,"SELECT COUNT(LOWER(login)) AS total FROM usuario WHERE login = ('{$user}')");
            
            while($resultado = mysqli_fetch_assoc($query)) {
                $qtd = $resultado['total'];
            }            
            
        } catch (Exception $e) {
            $qtd = "Erro ao inserir";
        }
        return $qtd;
    }
    //check special characters
    function antiInjection(Usuario $usuario){     
        $qtd = 0;
        if (preg_match('/^[a-zA-Z0-9]+$/', $usuario->getLogin())){
            $qtd = 0;
        }else {
            $qtd =  1;
        }
        
        if (preg_match('/^[a-zA-Z0-9]+$/', $usuario->getSenha())){
            $qtd2 =  0;
        }else {
            $qtd2 =  1;
        }        
        
        return $qtd + $qtd2;
    }
    
    function listaUsuarios(){
        $user = array();
        $resultado = mysqli_query($this->conexao, "SELECT * FROM usuario;");        
        while($usuarios_array = mysqli_fetch_assoc($resultado)) {
            
            $nome = $usuarios_array['nome'];
            $login = $usuarios_array['login'];
            
            $id = $usuarios_array['id'];
            $date = $usuarios_array['data'];
            $senha = '';
            $ativo = $usuarios_array['ativo'];;
            
            $usuario = new Usuario($nome, $login, $senha, $id, $date, $ativo);
            
            array_push($user, $usuario);
        }

        return $user;
    }
    
    function excluirUsuario(Usuario $usuario){
        //check if there are posts for this id
        $publicacoes = $this->verificaUsuarioPublicacao($usuario->getId());
        
        if($publicacoes <= 0){
        try {
            $query = "DELETE FROM usuario WHERE id = '{$usuario->getId()}'";
            mysqli_query($this->conexao, $query);
            $msg = "Usuário ".$usuario->getLogin()." excluido com sucesso!";
        } catch (Exception $e) {
            $msg = "Erro ao excluir ".$usuario->getLogin();
        }  
        }else{
            $msg = " O usuário ".$usuario->getLogin()." possuí publicações em seu nome e não pode ser excluído.";
        }
        
        return $msg;
    }
    //check if there are posts for this id
    function verificaUsuarioPublicacao($id){
        try {
            $query = mysqli_query($this->conexao,"SELECT COUNT(LOWER(id)) AS total FROM texto WHERE fk_usuario = ('{$id}')");
            
            while($resultado = mysqli_fetch_assoc($query)) {
                $qtd = $resultado['total'];
            }
            
        } catch (Exception $e) {
            $qtd = "Erro ao verificar";
        }
        return $qtd;
    }
    
    function exibeUsuario($id){
        $user = array();
        $iduser = base64_decode($id);
        try {
            $query = "SELECT * FROM usuario WHERE id = '{$iduser}'";
            $resultado = mysqli_query($this->conexao, $query);
            while($usuarios_array = mysqli_fetch_assoc($resultado)) {
                
                $nome = $usuarios_array['nome'];
                $login = $usuarios_array['login'];
                
                $id = $usuarios_array['id'];
                $date = '';
                $senha = $usuarios_array['senha'];
                $ativo = $usuarios_array['ativo'];;
                
                $usuario = new Usuario($nome, $login, $senha, $id, $date, $ativo);
                
                array_push($user, $usuario);
            }
            
        } catch (Exception $e) {
            $user = "Erro ao buscar ".$usuario->getLogin();
        }  
        
        return $user;
    }
    
    function atualizaUsuario(Usuario $usuario){
        try {
            $query = "UPDATE usuario SET  ativo='{$usuario->getAtivo()}' WHERE id='{$usuario->getId()}' ";
            mysqli_query($this->conexao, $query);
            $msg = $usuario->getLogin()." editado com sucesso!";
        } catch (Exception $e) {
            $msg = "Erro ao editar ".$usuario->getNome();
        }   
        return $msg;
    }
    
    function ajustarData($data){
        $dt = substr($data, 0, 10);
        $dt1 = explode('-', $dt);
        return $dt1[2].'/'.$dt1[1].'/'.$dt1[0].' '. substr($data, 10, 10);
    }
    
    
    
    
}
