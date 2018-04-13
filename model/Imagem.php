<?php
class Imagem{
    private $id;
    private $nome;
    private $nome_antigo;
    private $caminho;
    /*
    function __construct($id, $nome, $extensao, $arquivo){
        $this->id = $id;
        $this->extensao = $extensao;
        $this->nome = $nome;
        $this->arquivo = $arquivo;
    }*/
    /**
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getNome_antigo()
    {
        return $this->nome_antigo;
    }

    /**
     * @return mixed
     */
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $nome_antigo
     */
    public function setNome_antigo($nome_antigo)
    {
        $this->nome_antigo = $nome_antigo;
    }

    /**
     * @param mixed $caminho
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;
    }

    
    
}

?>