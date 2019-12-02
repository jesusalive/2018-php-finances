<?php
        // error_reporting(0);
        session_start();
        if($_SESSION['logou']!=1){      
            header("Location: index.php");             
        }
    ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/vizuentradas1.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="css\img\icone1.png"> 
    <title>Pagina Inicial - Administre suas finanças</title>
</head>
<body>
<?php $usuario = $_SESSION['nome']; $sobrenome = $_SESSION['sobrenome'];?>
        
    <div name="cabeçalho" class = "cabecalho">
        <img src="css\img\logo.png" alt="logo" class = "beleza">
        <span class = "titcima"> <br> Olá, <?php echo $usuario; echo " ".$sobrenome; ?>! </span>
    </div>
    
    <div name="menu" class = "menu"> <br>
        <span class = "textomenu"><a href="../paginainicial.php" class="link"> Home<a></span>
        <hr class = "divisao"> 
        <span class = "textomenu"><a href="../addentradas.php" class="link"> Adicionar entrada<a></span>
        <hr class = "divisao"> 
        <span class = "textomenu"><a href="../addsaidas.php" class="link">Adicionar saída</a></span>
        <hr class = "divisao"> 
        <span class = "textomenu"><a href="../extrato.php" class="link">Extrato</a></span>
        <hr class = "divisao"> 
        <span class = "textomenu"><a href="../logoff.php" class="link">Sair</a></span>
    </div>

    <!-- PEGAR NOME DO BANCO -->
    <?php
        include_once "../conexao.php";
        $id = $_SESSION['id'];
        // PEGAR NOME DO DB
        $use = "USE adm_financeira;";
        $selectdb = "SELECT Nome_DB FROM cadastros WHERE id = '$id'";
        $query = mysqli_query($con, $use);
        $query2 = mysqli_query($con, $selectdb);
        $res = mysqli_fetch_assoc($query2);
        $nomedobanco = $res['Nome_DB'];
    ?>

    <div name = "parte central" class = "centro">
    
        <?php
            $use = "USE $nomedobanco";
            $select = "SELECT * FROM entradas";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $select);
            $res2 = mysqli_fetch_assoc($query);
            $linhas = mysqli_affected_rows($con);
            

            if($linhas > 0){
                $c = 1;
                while($c <= $linhas){
                    $use = "USE $nomedobanco";
                    $select = "SELECT * FROM entradas WHERE id = '$c'";
                    $query = mysqli_query($con, $use);
                    $query = mysqli_query($con, $select);
                    $res2 = mysqli_fetch_assoc($query);
                    $motivo = str_replace("_", " ", $res2['motivo']);
                    $valor = $res2['valor'];
                    $valorb = number_format($valor, '2', ',', ' ');
                    echo "<p class = 'ents'>$motivo <br>";
                    echo " Valor: R$ $valorb <hr></p> ";
                    $c++;
                }
            }
            
           
        ?>
    </div>