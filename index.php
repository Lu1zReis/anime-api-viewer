<?php

session_start();
if (isset($_POST['deslogar'])) unset($_SESSION['logado']);

if (isset($_SESSION['logado']) and $_SESSION['logado'] > 0):
    require_once "backend/App/Model/Anime/AnimeDAO.php";
    require_once "backend/App/Model/Usuario/UsuarioDAO.php";
    require_once "backend/App/Model/Conn.php";

    $usuarioDAO = new connect\UsuarioDAO();
    $usuario = $usuarioDAO->PegaUsuario($_SESSION['logado']); // pega o id do usuario logado

    $animeDAO = new connect\AnimeDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime-API-Viewer</title>
    <link rel="stylesheet" href="frontend/assets/css/style.css">
</head>
<body>
    <header>
        <a href="index.php" class="header-nome">Favorite Anime</a>
        <div class="header-perfil">
            <form action="" method="POST" class="form-deslogar">
                <?php echo $usuario['nome']; // exibindo nome do usuario logado ?>
                <input type="submit" value="Deslogar" name="deslogar" class="botao-deslogar">
            </form>
        </div>
    </header>
    <main>
        <div class="search">
            <form method="GET" action="index.php" class="filtros">
                Pesquisar <input type="search" class="pesquisar" name="nome">
                <input type="submit" name="enviar">
            </form>
        </div>
        <div class="cards">
            <?php
                if (!isset($_GET['enviar'])) {
                    $anime = $animeDAO->pegarTodos(); // funcao para pegar todos animes
                    foreach($anime['data'] as $a):
            ?>
                <a href="frontend/public/card.php?id=<?php echo $a['mal_id']; ?>" class="card">
                    <img src="<?php echo $a['images']['jpg']['image_url']; ?>" alt="<?php echo $a['title']; ?>" class="card-foto">
                    <div class="card-nome"><?php echo $a['title']; ?></div>
                    <div class="card-ano">
                        <?php echo $a['aired']['prop']['from']['year']; ?>
                    </div>
                </a>
            <?php
                    endforeach;
                } else {
                    // pegando somente uma pesquisa básica 
                    $result = $animeDAO->pesquisarAnime($_GET['nome']);
                    if ($result['data'] != NULL):
                        $a = $result['data'][0];
            ?>
                    <a href="frontend/public/card.php?id=<?php echo $a['mal_id']; ?>" class="card">
                        <img src="<?php echo $a['images']['jpg']['image_url']; ?>" alt="<?php echo $a['title']; ?>" class="card-foto">
                        <div class="card-nome"><?php echo $a['title']; ?></div>
                        <div class="card-ano">
                            <?php echo $a['aired']['prop']['from']['year']; ?>
                        </div>
                    </a>
            <?php
                    // caso anime não seja encontrado
                    else:
                        echo "<h1>Anime não encontrado :(<h1>";
                    endif;
                }
            ?>
        </div>
    </main>
</body>
</html>

<?php
else: 
    header("Location: frontend/public/login.php");
endif;
?>
