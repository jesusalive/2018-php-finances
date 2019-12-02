<!DOCTYPE html>
<html lang = "pt-br">
<head>
    <meta charset="UTF-8">
    <title> Administração de Finanças - Prepara Cursos </title>
    <link rel="stylesheet" href="css/csserros.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css/img/icone.png">

</head>
<?php
    include_once "conexao.php";

    if(isset($_POST['btnlogar'])){
        
        $login= mysqli_escape_string($con, $_POST['username']);
        $senha= mysqli_escape_string($con, $_POST['senha']);

        $sql = "SELECT * FROM cadastros WHERE Usuario = '$login'";
        $query = mysqli_query($con, $sql);
        $tem = mysqli_affected_rows($con);

        if($tem > 0){
            
            $sql = "SELECT * FROM cadastros WHERE Usuario = '$login' AND Senha = '$senha'";
            $query = mysqli_query($con, $sql);
            $tem2 = mysqli_affected_rows($con);
            
            if($tem2 > 0){
                session_start();
                $select = "SELECT * FROM cadastros WHERE Usuario = '$login' AND Senha = '$senha'";
                $query = mysqli_query($con, $select);
                $res = mysqli_fetch_assoc($query);
                $_SESSION['nome'] = $res['Nome'];
                $_SESSION['sobrenome'] = $res['Sobrenome'];
                $_SESSION['id'] = $res['id'];
                $_SESSION['dbname'] = $res['Nome_DB'];
                $_SESSION['logou']=1;

                header("location:paginainicial.php");
            }else{
                echo "<div class = 'erros'> Usuário/Senha incorretas!<br><br>";
                echo "<a href='index.php'> <button class = 'bot'> Voltar </button> </a> </div>";
            }
        }else{
            echo "<div class = 'erros'> Usuário/Senha incorretas!<br><br>";
            echo "<a href='index.php'> <button class = 'bot'> Voltar </button> </a> </div>";
        }
        
    }else{
        header("location:index.php");
    }
?>
</html>