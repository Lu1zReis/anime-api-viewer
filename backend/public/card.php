<?php

if (isset($_POST['enviar'])) {
    session_start();
    if (isset($_SESSION['logado'])) {
        require_once "../../backend/App/Model/ListaFavoritos/ListaFavoritos.php";
        require_once "../../backend/App/Model/ListaFavoritos/ListaFavoritosDAO.php";
        require_once "../../backend/App/Model/Conn.php";

        $listaDAO = new connect\ListaFavoritosDAO();
        $comentario = new connect\ListaFavoritos();

        $comentario->setIdUsuario($_SESSION['logado']);
        $comentario->setMalId($_POST['id']);
        $comentario->setDataAdicao(date('Y-m-d H:i:s'));
        $comentario->setNotaPessoal($_POST['comentario']);
        $comentario->setStatus('Comentado');

        if ($listaDAO->Create($comentario)) {
            $_SESSION['msg'] = "Comentário enviado com sucesso!";
            header("Location: ../../frontend/public/card.php?id=".$_POST['id']);
        } else {
            $_SESSION['msg'] = "Erro ao enviar comentário.";
            header("Location: ../../frontend/public/card.php?id=".$_POST['id']);

        }
    } else {
        $_SESSION['msg'] = "Você precisa estar logado para comentar.";
        header("Location: ../../frontend/public/login.php");
    }
}   