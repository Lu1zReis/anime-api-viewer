<?php

session_start();
if (isset($_SESSION['msg'])) {
    echo "<script>alert('".$_SESSION['msg']."');</script>";
    unset($_SESSION['msg']);
}

if (isset($_SESSION['logado']) and $_SESSION['logado'] > 0):
    if (isset($_GET['id'])) {
        require_once "../../backend/App/Model/Anime/AnimeDAO.php";
        require_once "../../backend/App/Model/Usuario/UsuarioDAO.php";
        require_once "../../backend/App/Model/ListaFavoritos/ListaFavoritosDAO.php";
        require_once "../../backend/App/Model/Conn.php";

        $usuarioDAO = new connect\UsuarioDAO();
        $listaDAO = new connect\ListaFavoritosDAO();
        $usuario = $usuarioDAO->PegaUsuario($_SESSION['logado']); // pega o id do usuario logado

        $animeid = $_GET['id'];
        $animeDAO = new connect\AnimeDAO();
        $anime = $animeDAO->pegarAnime($animeid);
        $a = $anime['data'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime-API-Viewer</title>
    <link rel="stylesheet" href="../assets/css/card.css">
</head>
<body>
    <header>
        <a href="../../index.php" class="header-nome">Favorite Anime</a>
        <div class="header-perfil">
            <?php echo $usuario['nome']; // exibindo nome do usuario logado ?>
        </div>
    </header>
    <main>
        <img src="<?php echo $a['images']['jpg']['image_url']; ?>" alt="<?php echo $a['title']; ?>" class="card-foto">
        <div class="card-header">
            <div class="card-titulo">
                <div class="card-nome"><?php echo $a['title']; ?></div>
                <div class="card-nome"><?php echo $a['title_japanese']; ?></div>
            </div>
            <div class="card-status">
                <form action="../../backend/public/card.php" method="POST">
                    <?php
                        $favorito = $listaDAO->EncontrarAnime($_SESSION['logado'], $animeid);
                        if (!$favorito) {
                            $favorito = ['status' => 3]; // padrão para "Não Assistido"
                        }
                    ?>
                    <select name="status" id="status">
                        <option value="1" <?php echo ($favorito['status'] == 1) ? 'selected' : ''; ?>>Assistido</option>
                        <option value="2" <?php echo ($favorito['status'] == 2) ? 'selected' : ''; ?>>Assistindo</option>
                        <option value="3" <?php echo ($favorito['status'] == 3) ? 'selected' : ''; ?>>Não Assistido</option>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $animeid; ?>">
                    <button type="submit" name="adicionar">Marcar</button>
                </form>
            </div>
        </div>
        <div class="card-sinopse"><?php echo $a['synopsis']; ?></div>
        <div class="informacoes">
            <div class="card-episodios"><?php echo "<h3>Episódios: </h3>".$a['episodes']; ?></div>
            <div class="card-tipo"><?php echo "<h3>Tipo: </h3>".$a['type']; ?></div>
            <div class="card-score"><?php echo "<h3>Nota: </h3>".$a['score']; ?></div>
            <div class="card-ano">
                <?php echo "<h3>Ano: </h3>".$a['aired']['prop']['from']['year']; ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="relacionados">
            <div class="relacionados-nome">Animes Relacionados</div>
            <div class="relacionados-lista">
                    <?php
                    $animes = $animeDAO->pegarAnimesRelacionado($animeid);

                    if (!empty($animes['data'])) {
                        foreach($animes['data'] as $relacao):
                            foreach($relacao['entry'] as $animeRelacionado):
                    ?>
                            <a href="card.php?id=<?php echo $animeRelacionado['mal_id']; ?>" class="relacionados-anime-card">
                                <div class="relacionados-anime-card-nome"><?php echo $animeRelacionado['name']; ?></div>
                                <div class="relacionados-anime-card-ano"><?php echo $relacao['relation']; ?></div>
                            </a>
                    <?php
                            endforeach;
                        endforeach;
                    } else {
                        echo "<p>Nenhum anime relacionado encontrado.</p>";
                    }
                    ?>
            </div>
        </div>
    </footer>
    <div class="comentarios">
        <form action="../../backend/public/card.php" method="POST">
            <input type="text" name="comentario" placeholder="Deixe seu comentário...">
            <input type="hidden" name="id" value="<?php echo $animeid; ?>">
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <div class="comentarios-lista">
            <?php
                $listaDAO = new connect\ListaFavoritosDAO();
                $retorno = $listaDAO->Read();

                foreach ($retorno as $comentario) {
                    if ($comentario['mal_id'] == $animeid) {
                        $usuario = $usuarioDAO->PegaUsuario($comentario['id_usuario']);
                        echo "<div class='comentario-item'>{$usuario['nome']}: {$comentario['nota_pessoal']}</div>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>

<?php
    // caso passe o id escrito errado manualmente
    } else {
        header("Location: ../../index.php");
    }
else: 
    header("Location: frontend/public/login.php");
endif;
?>