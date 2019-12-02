<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> Administração de Finanças - Prepara Cursos </title>
    <link rel="stylesheet" href="css/cssindex3.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css/img/icone.png">
</head>

<body>
    <header>    
        
        <div class = "cabecalho">
            <h1 class = "titulo1">CONTROLE DE FINANÇAS </h1>
            <img src= "css/img/logo.png" class = "posicao">
        </div>
    </header>
    
    <div class = "login">
        <h1 class="logint">LOGIN</h1>
        <br>
        <br>
        <hr>
        <br>
        <br>
        <form method = "POST" action="proclogin.php">
            <span class = "textoinput"> Login:</span> 
            <input type="text" name="username" class ="input" required> <br> <br>
            <span class = "textoinput"> Senha:</span> 
            <input type="password" name="senha" class ="input" required> <br> <br> <br>
            
            <input type="submit" value="Logar" name = "btnlogar" class = "submit">
        </form>
    </div>
    <footer class = "cadastre">
    <span class = "textorod"> Ainda não se cadastrou?? </span> <br> <br>
    <a href="cadastre_se.php"> <button class = "submitrod"> CADASTRE-SE </button> </a>
    </footer>
    
</body>

</html>
