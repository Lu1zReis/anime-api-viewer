<?php
    require_once "../App/Model/Conn.php";
    require_once "../App/Model/Usuario/UsuarioDAO.php";
    session_start();
    if (isset($_POST['logar'])) {
        
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        if (empty($email))
            $_SESSION['msg'][] = "<script>alert('Preencha o campo email')</script>";
        if (empty($senha))
            $_SESSION['msg'][] = "<script>alert('Preencha o campo senha')</script>";  

        if (!empty($_SESSION['msg'])):
			header('Location: ../../frontend/public/login.php');
        else:
            $usuario = new connect\UsuarioDAO();
            $id = $usuario->ExisteUsuario($email, $senha);
            if ($id > 0):
                $_SESSION['logado']= $id;
			    header('Location: ../../index.php');
            else:
                $_SESSION['msg'][] = "<script>alert('Email ou Senha incorretas')</script>";  
    			header('Location: ../../frontend/public/login.php');
            endif;

        endif;
    }