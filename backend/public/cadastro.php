<?php
    require_once "../App/Model/Usuario/UsuarioDAO.php";
    require_once "../App/Model/Usuario/Usuario.php";
    require_once "../App/Model/Conn.php";

    if (isset($_POST['cadastrar'])) {
        // sessão será usada para caso tenha conseguido cadastrar ou tenha algum dado incorreto
        session_start(); 

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (empty($nome)):
            $_SESSION['msg'][] = "<script>alert('Preencha o campo nome')</script>";
        endif;
        if (empty($email)):
            $_SESSION['msg'][] = "<script>alert('Preencha o campo email')</script>";
        endif;
        if (empty($senha)):
            $_SESSION['msg'][] = "<script>alert('Preencha o campo senha')</script>";
        endif;

        if (!empty($_SESSION['msg'])):
			header('Location: ../../frontend/public/cadastrar.php');
        else:
            $usuario = new connect\Usuario();
            $usuarioDAO = new connect\UsuarioDAO();

            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSenha($senha);

            if ($usuarioDAO->Create($usuario)) {
                $_SESSION['msg'][] = "<script>alert('Usuário cadastrado com sucesso!')</script>";
    			header('Location: ../../frontend/public/login.html');
            } else {
                $_SESSION['msg'][] = "<script>alert('Erro ao cadastrar')</script>";
    			header('Location: ../../frontend/public/cadastrar.php');
            }
        endif;
        
    } else header('Location: ../../frontend/public/cadastrar.php');
?>