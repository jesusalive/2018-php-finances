<?php
        error_reporting(0);
        session_start();
        if($_SESSION['logou']!=1){      
            header("Location: index.php");             
        }
    ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/csspaginainicial.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css/img/icone.png"> 
    <title>Pagina Inicial - Administre suas finanças</title>
</head>
<body>
<?php $usuario = $_SESSION['nome']; $sobrenome = $_SESSION['sobrenome'];?>
        
    <div name="cabeçalho" class = "cabecalho">
        <img src="css\img\logo.png" alt="logo" class = "beleza">
        <span class = "titcima"> <br> Olá, <?php echo $usuario; echo " ".$sobrenome; ?>! </span>
    </div>
    
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

    <div name = "parte central" class = "centro">
    <div class="entradas"> 
            <span class="titulo_"> ULTIMAS ENTRADAS</span> <br> <br> <br>
            <!-- PROCESSAMENTO PHP -->
            <?php
                include_once "conexao.php";
                $id = $_SESSION['id'];
                // PEGAR NOME DO DB
                $selectdb = "SELECT Nome_DB FROM cadastros WHERE id = '$id'";
                $query = mysqli_query($con, $selectdb);
                $res = mysqli_fetch_assoc($query);
                $nomedobanco = $res['Nome_DB'];

                $use = "USE $nomedobanco;";
                $select = "SELECT * FROM entradas";
                $query = mysqli_query($con, $use);
                $query = mysqli_query($con, $select);
                $linhas = mysqli_affected_rows($con);
                $quant = $linhas;

                for($c = 1; $c < 3; $c++){
                    $use = "USE $nomedobanco;";
                    $select = "SELECT * FROM entradas WHERE id = $quant;";
                    $query = mysqli_query($con, $use);
                    $query = mysqli_query($con, $select);
                    $res = mysqli_fetch_assoc($query);
                    $motivo = $res['motivo'];
                    $valor = $res['valor'];
                    $valor = number_format($valor, '2', ",", ".");
                    $quant = $quant - 1;
                    
                    echo "<span class='totent'> Motivo: $motivo <br> Valor: R$ $valor</span> <hr class = 'divisao'> <br> <br>";               }
            ?>
       
    </div>
    
    <div class="saidas"> 
            <span class="titulo_"> ULTIMAS SAÍDAS</span> <br> <br> <br>
            <!-- PROCESSAMENTO PHP -->
            <?php
                include_once "conexao.php";
                $id = $_SESSION['id'];
                
                $use = "USE $nomedobanco;";
                $select = "SELECT * FROM saidas";
                $query = mysqli_query($con, $use);
                $query = mysqli_query($con, $select);
                $linhas = mysqli_affected_rows($con);
                $quant = $linhas;

                for($c = 1; $c < 3; $c++){
                    $use = "USE $nomedobanco;";
                    $select = "SELECT * FROM saidas WHERE id = $quant;";
                    $query = mysqli_query($con, $use);
                    $query = mysqli_query($con, $select);
                    $res = mysqli_fetch_assoc($query);
                    $motivo = $res['motivo'];
                    $valor = $res['valor'];
                    $valor = number_format($valor, '2', ",", ".");
                    $quant = $quant - 1;
                    
                    echo "<span class='totsai'> Motivo: $motivo <br> Valor: R$ $valor</span> <hr class='divisao'> <br> <br>";               }
            ?>
        </div>
        
    </div>
</body>
</html>