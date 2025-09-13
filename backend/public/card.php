<?php
session_start();

if (isset($_SESSION['logado'])) {
    require_once "../../backend/App/Model/ListaFavoritos/ListaFavoritos.php";
    require_once "../../backend/App/Model/ListaFavoritos/ListaFavoritosDAO.php";
    require_once "../../backend/App/Model/Conn.php";
    if (isset($_POST['enviar'])) {

        $listaDAO = new connect\ListaFavoritosDAO();
        $comentario = new connect\ListaFavoritos();

        $comentario->setIdUsuario($_SESSION['logado']);
        $comentario->setMalId($_POST['id']);
        $comentario->setDataAdicao(date('Y-m-d H:i:s'));
        $comentario->setNotaPessoal($_POST['comentario']);

        if ($listaDAO->Create($comentario)) {
            $_SESSION['msg'] = "Comentário enviado com sucesso!";
            header("Location: ../../frontend/public/card.php?id=".$_POST['id']);
        } else {
            $_SESSION['msg'] = "Erro ao enviar comentário.";
            header("Location: ../../frontend/public/card.php?id=".$_POST['id']);

        }
    } elseif (isset($_POST['adicionar'])) {
        $listaDAO = new connect\ListaFavoritosDAO();
        $existente = $listaDAO->EncontrarAnime($_SESSION['logado'], $_POST['id']);
        $favorito = new connect\ListaFavoritos();
        $favorito->setIdUsuario($_SESSION['logado']);
        $favorito->setStatus($_POST['status']);
        if ($existente) {
            // já existe 
            $favorito->setId($existente['id_lista']); 
            $favorito->setNotaPessoal($existente['nota_pessoal']);
            $favorito->setDataAdicao($existente['data_adicao']);
            $favorito->setMalId($_POST['id']);
            if ($listaDAO->Update($favorito)) {
                $_SESSION['msg'] = "Anime atualizado na lista com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao atualizar status do anime na lista.";
            }
        } else {
            // não existe 
            $favorito->setMalId($_POST['id']);
            $favorito->setDataAdicao(date('Y-m-d H:i:s'));
            if ($listaDAO->Create($favorito)) {
                $_SESSION['msg'] = "Anime adicionado à lista com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao adicionar anime à lista.";
            }
        }

        header("Location: ../../frontend/public/card.php?id=".$_POST['id']);
        exit;

    } 
} else {
    $_SESSION['msg'] = "Você precisa estar logado para comentar.";
    header("Location: ../../frontend/public/login.php");
}