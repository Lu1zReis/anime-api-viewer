<?php

 namespace connect; 

Class ListaFavoritos {
    private $id, $id_usuario, $mal_id, $data_adicao, $nota_pessoal, $status;

    public function getId() {
        return $this->id;
    }
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    public function getMalId() {
        return $this->mal_id;
    }
    public function getDataAdicao() {
        return $this->data_adicao;
    }
    public function getNotaPessoal() {
        return $this->nota_pessoal;
    }
    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    public function setMalId($mal_id) {
        $this->mal_id = $mal_id;
    }
    public function setDataAdicao($data_adicao) {
        $this->data_adicao = $data_adicao;
    }
    public function setNotaPessoal($nota_pessoal) {
        $this->nota_pessoal = $nota_pessoal;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
}