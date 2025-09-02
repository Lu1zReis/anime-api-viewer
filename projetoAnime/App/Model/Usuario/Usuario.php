<?php

 namespace connect; 

Class Usuario {
    private $id, $nome, $email, $senha, $data_criacao;

    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getSenha() {
        return $this->senha;
    }
        public function getDataCriacao() {
        return $this->data_criacao;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function setDataCriacao($dataCriacao) {
        $this->data_criacao = $dataCriacao;
    }
}
