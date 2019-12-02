<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <title> Administração de Finanças - Prepara Cursos </title>
    <link rel="stylesheet" href="css/fim.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css/img/icone.png">
</head>
<body>
<?php
    error_reporting(0);
    include "conexao.php";
    session_start();
    if ($_SESSION['cadastrou']==1){
        
        echo  "<div class = 'fim'> SEJA BEM-VINDO(a)! <br> <br>";

        echo"<a href='index.php'> <button class = 'bot'> Finalizar cadastro </button></a> </div>";
        
    }else{
        echo "<div class = 'erros'> Algo deu errado! Se você não se cadastrou, cadastre-se. <br>
        Se ja se cadastrou, tente novamente <br> <br>";
        echo "<a href='cadastre_se.php'> <button> Voltar </button></a> </div>";
    }  

?>
</body>
</html>