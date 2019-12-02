<?php
    include_once "conexao.php";
    session_start();
    if($_SESSION['logou'] != 1){
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/cssmanual.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link rel="icon" href="css/img/icone.png"> 
        <title>Adicionar entrada</title>
    </head>
    <body>
        <!-- CABEÇALHO -->
        <?php $usuario = $_SESSION['nome']; $sobrenome = $_SESSION['sobrenome'];?>    
        <div name="cabeçalho" class = "cabecalho">
            <img src="css\img\logo.png" alt="logo" class = "beleza">
            <span class = "titcima"> <br> Olá, <?php echo $usuario; echo " ".$sobrenome; ?>! </span>
        </div>

        <!-- MENU -->
        <div name="menu" class = "menu"> <br>
            <span class = "textomenu"><a href="paginainicial.php" class="link"> Home<a></span>
            <hr class = "divisao"> 
            <span class = "textomenu"><a href="addentradas.php" class="link"> Adicionar entrada<a></span>
            <hr class = "divisao"> 
            <span class = "textomenu"><a href="addsaidas.php" class="link">Adicionar saída</a></span>
            <hr class = "divisao"> 
            <span class = "textomenu"><a href="extrato.php" class="link">Extrato</a></span>
            <hr class = "divisao"> 
            <span class = "textomenu"><a href="logoff.php" class="link">Sair</a></span>
        </div>

        <div class="centro">
            <span class="titulo">COMO INSERIR CORRETAMENTE OS VALORES</span> <br> <br> <br> <hr> <br>
            <span class="topico">- Para números com milhares (Exemplo: 1.000,00) <br> <br>
            Use sem o ponto: 1000,00</span> <br> <br> <hr>
            <span class="topico"> <br>- Para números com casas decimais tanto faz usar ponto ou vírgula!</span> <br> <br> <hr>
        </div>
    </body>
</html>