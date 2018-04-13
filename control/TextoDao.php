<?php
include_once '../../model/Texto.php';
include_once '../../model/Imagem.php';
include_once '../../model/Usuario.php';

include_once 'Conexao.php';

class TextoDao
{

    function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    function insereTexto(Texto $texto)
    {
        try {
            if ($texto->getImagem()->getId() == 'n') {
                $img = '';
            } else {
                $img = $texto->getImagem()->getId();
            }
            $query = "INSERT INTO texto (titulo, subtitulo, mensagem, principal,fk_imagem, fk_usuario )
                      VALUES ('{$texto->getTitulo()}', '{$texto->getSubtitulo()}', '{$texto->getMensagem()}','{$texto->getPrincipal()}',
                      '{$img}', '{$texto->getUsuario()->getId()}')";
            mysqli_query($this->conexao, $query);
            
            $msg = 'Cadastrado com sucesso.';
        } catch (Exception $e) {
            $msg = 'Erro';
        }
        return $msg;
    }

    function listaTextos()
    {
        $textos = array();
        $resultado = mysqli_query($this->conexao, "SELECT texto.id, texto.titulo,texto.subtitulo,texto.publicado,texto.principal,
                                                          texto.criacao, imagem.caminho,  imagem.nome, usuario.login
                                                   FROM texto
                                                   LEFT JOIN imagem ON texto.fk_imagem = imagem.id
                                                   INNER JOIN usuario ON texto.fk_usuario = usuario.id");
        while ($texto_array = mysqli_fetch_assoc($resultado)) {
            
            $id = $texto_array['id'];
            $titulo = $texto_array['titulo'];
            $subtitulo = $texto_array['subtitulo'];
            $publicado = $texto_array['publicado'];
            $principal = $texto_array['principal'];
            $criacao = $texto_array['criacao'];
            
            $imagem = new Imagem();
            $imagem->setCaminho($texto_array['caminho']);
            $imagem->setNome($texto_array['nome']);
            $login = $texto_array['login'];
            
            $usuario = new Usuario('', $login, '', '', '', '');
            
            $texto = new Texto($id, $titulo, $subtitulo, $imagem, '', $publicado, $principal, $criacao, $usuario);
            
            array_push($textos, $texto);
        }
        
        return $textos;
    }

    function ajustarTitulo($titulo)
    {
        $qtd = strlen($titulo);
        if ($qtd >= 30) {
            $newTitulo = substr($titulo, 0, 25) . '..';
        } else {
            $newTitulo = $titulo;
        }
        return $newTitulo;
    }

    function ajustarData($data)
    {
        $dt = substr($data, 0, 10);
        $dt1 = explode('-', $dt);
        return $dt1[2] . '/' . $dt1[1] . '/' . $dt1[0] . ' ' . substr($data, 10, 10);
    }

    function excluirTexto(Texto $texto)
    {
        try {
            $query = "DELETE FROM texto WHERE id = '{$texto->getId()}'";
            mysqli_query($this->conexao, $query);
            $msg = "Texto  excluido com sucesso!";
        } catch (Exception $e) {
            $msg = "Erro ao excluir ";
        }
        
        return $msg;
    }

    function imprimirTexto($id)
    {
        try {
            $textos = array();
            $resultado = mysqli_query($this->conexao, "SELECT texto.id AS idtx, texto.titulo,texto.subtitulo,texto.mensagem,texto.principal,
                                                              texto.criacao, imagem.caminho,  imagem.nome, usuario.login, 
                                                              texto.publicado,imagem.nome_antigo, imagem.id AS idim

                                                   FROM texto
                                                   LEFT JOIN imagem ON texto.fk_imagem = imagem.id
                                                   INNER JOIN usuario ON texto.fk_usuario = usuario.id
                                                   WHERE texto.id = '{$id}'");
            while ($texto_array = mysqli_fetch_assoc($resultado)) {
                
                $id = $texto_array['idtx'];
                $titulo = $texto_array['titulo'];
                $subtitulo = $texto_array['subtitulo'];
                $mensagem = $texto_array['mensagem'];
                $principal = $texto_array['principal'];
                $criacao = $texto_array['criacao'];
                $publicado = $texto_array['publicado'];
                
                $imagem = new Imagem();
                $imagem->setCaminho($texto_array['caminho']);
                $imagem->setNome($texto_array['nome']);
                $imagem->setId($texto_array['idim']);
                $imagem->setNome_antigo($texto_array['nome_antigo']);
                $login = $texto_array['login'];
                
                $usuario = new Usuario('', $login, '', '', '', '');
                
                $texto = new Texto($id, $titulo, $subtitulo, $imagem, $mensagem, $publicado, $principal, $criacao, $usuario);
                
                array_push($textos, $texto);
            }
        } catch (Exception $e) {
            $textos = 'erro';
        }
        return $textos;
    }

    function atualizaTexto(Texto $texto)
    {
        try {
            if ($texto->getImagem()->getId() == 'n') {
                $img = '';
            } else {
                $img = $texto->getImagem()->getId();
            }
            $query = "UPDATE texto SET  titulo ='{$texto->getTitulo()}', subtitulo = '{$texto->getSubtitulo()}', 
                                            mensagem ='{$texto->getMensagem()}', principal = '{$texto->getPrincipal()}',
                                            publicado = '{$texto->getPublicado()}', fk_imagem ='{$img}'
                          WHERE id = '{$texto->getId()}'";
            mysqli_query($this->conexao, $query);
            
            $msg = 'Editado com sucesso.';
        } catch (Exception $e) {
            $msg = 'Erro';
        }
        return $msg;
    }

    function NumeroDeLinhasTexto()
    {
        $query = mysqli_query($this->conexao, "SELECT COUNT(ID) AS qtd FROM texto WHERE texto.publicado = '0'");
        while ($texto_array = mysqli_fetch_assoc($query)) {
            $qtd = $texto_array['qtd'];
        }
        return $qtd;
    }

    function listaTextosHome($inicio, $limit)
    {
        try {
            $textos = array();
            $resultado = mysqli_query($this->conexao, "SELECT texto.id, texto.titulo,texto.subtitulo,texto.publicado,texto.principal,
                                                          texto.criacao, imagem.caminho,  imagem.nome, usuario.login
                                                   FROM texto
                                                   LEFT JOIN imagem ON texto.fk_imagem = imagem.id
                                                   INNER JOIN usuario ON texto.fk_usuario = usuario.id
                                                   WHERE texto.publicado = '0' ORDER BY 1 DESC
                                                   LIMIT {$inicio}, {$limit} ");
            while ($texto_array = mysqli_fetch_assoc($resultado)) {
                
                $id = $texto_array['id'];
                $titulo = $texto_array['titulo'];
                $subtitulo = $texto_array['subtitulo'];
                $publicado = $texto_array['publicado'];
                $principal = $texto_array['principal'];
                $criacao = $texto_array['criacao'];
                
                $imagem = new Imagem();
                $imagem->setCaminho($texto_array['caminho']);
                $imagem->setNome($texto_array['nome']);
                $login = $texto_array['login'];
                
                $usuario = new Usuario('', $login, '', '', '', '');
                
                $texto = new Texto($id, $titulo, $subtitulo, $imagem, '', $publicado, $principal, $criacao, $usuario);
                
                array_push($textos, $texto);
            }
            
        } catch (Exception $e) {
        }        
        return $textos;
    }

    function AumentarPrincipal($id)
    {
        try {
            $resultado = mysqli_query($this->conexao, "SELECT texto.principal FROM texto WHERE id = '{$id}'");
            while ($texto_array = mysqli_fetch_assoc($resultado)) {
                $principal = $texto_array['principal'];
            }
            $principal = $principal + 1;
            mysqli_query($this->conexao, "UPDATE texto SET principal = {$principal} WHERE id = '{$id}'");
        } catch (Exception $e) {}
        return $principal;
    }
    
    function alimentaGraficoBarra(){
        $textos = array();
        $resultado = mysqli_query($this->conexao, "SELECT principal, titulo, id FROM texto ORDER BY 1 DESC LIMIT 5");
        while ($texto_array = mysqli_fetch_assoc($resultado)) {            
            $id = $texto_array['id'];
            $titulo = $texto_array['titulo'];                      
            $principal = $texto_array['principal'];            
            $imagem = new Imagem();
            $texto = new Texto($id, $titulo, '', $imagem, '','', $principal, '', '');
            
            array_push($textos, $texto);
        }
        
        return $textos;
    }
    
    
    
}