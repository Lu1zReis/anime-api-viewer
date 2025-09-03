<?php
session_start();

if (isset($_SESSION['msg'])) {
    foreach ($_SESSION['msg'] as $mensagem) {
        echo $mensagem;
    }
    // limpa as mensagens depois de exibir
    unset($_SESSION['msg']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form action="../../backend/public/cadastro.php" method="POST">
        Nome: <input type="text" name="nome"><br>
        Email: <input type="email" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        <input type="submit" name="cadastrar" value="Enviar">
    </form>
</body>
</html>
