<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/csscadastro.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css/img/icone.png">
    <title>Cadastre-se</title>

</head>

<body>
    <div class = "cabecalho">
            <h1 class = "titulo1">CADASTRO </h1>
            <img src= "css/img/logo.png" class = "posicao">
        </div>  
    <div class = "login">
        <h1 class="logint">PREENCHA OS CAMPOS NECESSÁRIOS</h1> <br> <br>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            
            <input type="text" name="nome" class ="input" placeholder = "Seu primeiro nome" maxlength = "40" required > <br> <br>
           
            <input type="text" name="sobrenome" class ="input" placeholder = "Seu último nome" maxlength = "40" required > <br> <br>
            
            <input type="text" name="username" class ="input" placeholder = "Login" minlength="5" maxlength="12" required> <br> <br>
           
            <input type="password" name="senha" class ="input" placeholder = "Senha" minlength="8" maxlength="12" required> <br>  <br>
            
            <input type="submit" name ="botaocadastro" value="Cadastrar!" class = "submit">
        </form>

    </div>  
    <!-- Processamento PHP -->
    <?php
    if(isset($_POST['botaocadastro'])){
        if(empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['username']) || empty($_POST['senha'])){

            echo "<div class = 'erros'> Talvez algum campo ainda esteja vazio por favor tente novamente <br><br>";
            
        }else{

            include_once "conexao.php";
            if(isset($_POST['botaocadastro'])){
            
            $caractereserrados = array ('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è',
            'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù',
            'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë',
            'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

            $caracterescorretos = array('a', 'a', 'a', 'a', 'a', 'a', 
            'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o',
            'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 
            'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U',
            'U', 'U');

            $velhonome = mysqli_escape_string($con, $_POST['nome']);
            $velhosobrenome = mysqli_escape_string($con, $_POST['sobrenome']);
            $senha = mysqli_escape_string($con, $_POST['senha']);
            $velhousername = mysqli_escape_string($con, $_POST['username']);
            session_start();
            // SUBSTITUIR ACENTOS
            $nome = str_replace($caractereserrados, $caracterescorretos, $velhonome);
            $sobrenome = str_replace($caractereserrados, $caracterescorretos, $velhosobrenome);
            // $senha = str_replace($caractereserrados, $caracterescorretos, $velhasenha);
            $username = str_replace($caractereserrados, $caracterescorretos, $velhousername);

            $num = rand(1,100);
            $newname = $nome."_".$num;
            // INSERIR VALORES NO CADASTRO
            $insere = "INSERT INTO cadastros VALUES (NULL, '$nome', '$sobrenome', '$username', '$senha', '$newname')";
            $query = mysqli_query($con, $insere);
            // CRIAR BANCO DE DADOS DA PESSOA
            $criardb = "CREATE DATABASE $newname";
            $query = mysqli_query($con, $criardb);
            // CRIAR TABELA DE ENTRADAS
            $usardb = "USE $newname;";
            $tabela = "CREATE TABLE entradas(id int, motivo varchar(255), valor real);";
            $query = mysqli_query($con, $usardb);
            $query = mysqli_query($con, $tabela);
            // ADICIONAR PRIMARY_KEY
            $use= "USE $newname;";
            $mod = "ALTER TABLE entradas ADD PRIMARY KEY(id);";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod);
            // AUTOINCREMENTO
            $use= "USE $newname;";
            $mod2 = "ALTER TABLE entradas CHANGE id id int NOT NULL AUTO_INCREMENT;";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod2);
            // CRIAR TABELA DE CATEGORIAS (ENTRADAS)
            $usardb = "USE $newname;";
            $tabela = "CREATE TABLE ctg_entradas(id int,categoria varchar(255));";
            $query = mysqli_query($con, $usardb);
            $query = mysqli_query($con, $tabela);
            // ADICIONAR PRIMARY_KEY (CTG_ENTRADAS)
            $use= "USE $newname;";
            $mod = "ALTER TABLE ctg_entradas ADD PRIMARY KEY(id);";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod);
            // AUTOINCREMENTO (CTG_ENTRADAS)
            $use= "USE $newname;";
            $mod2 = "ALTER TABLE ctg_entradas CHANGE id id int NOT NULL AUTO_INCREMENT;";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod2);


            // CRIAR TABELA DE SAIDAS
            $usardb = "USE $newname;";
            $tabela = "CREATE TABLE saidas(id int, motivo varchar(255), valor real);";
            $query = mysqli_query($con, $usardb);
            $query = mysqli_query($con, $tabela);
            // ADICIONAR PRIMARY_KEY
            $usardb = "USE $newname;";
            $mod = "ALTER TABLE saidas ADD PRIMARY KEY(id);";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod);
            // AUTOINCREMENTO
            $usardb = "USE $newname;";
            $mod2 = "ALTER TABLE saidas CHANGE id id int NOT NULL AUTO_INCREMENT;";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod2);
            // CRIAR TABELA DE CATEGORIAS (SAIDAS)
            $usardb = "USE $newname;";
            $tabela = "CREATE TABLE ctg_saidas(id int,categoria varchar(255));";
            $query = mysqli_query($con, $usardb);
            $query = mysqli_query($con, $tabela);
            // ADICIONAR PRIMARY_KEY (CTG_SAIDAS)
            $use= "USE $newname;";
            $mod = "ALTER TABLE ctg_saidas ADD PRIMARY KEY(id);";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod);
            // AUTOINCREMENTO (CTG_SAIDAS)
            $use= "USE $newname;";
            $mod2 = "ALTER TABLE ctg_saidas CHANGE id id int NOT NULL AUTO_INCREMENT;";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $mod2);

            
            
            $_SESSION['cadastrou'] = 1;
            header('Location: fimcadastro.php');
        }else{
            echo "nao ta dando";
        }
        }
    }
?>
<!-- Fecha Processamento -->
</body>
</html>