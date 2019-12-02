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
    <link rel="stylesheet" href="css/extrato.css">
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

    <div name = "parte central" class = "centroerase">
        <span class="tit2"><h1>DESEJA APAGAR TODOS OS REGISTROS?</h1></span> <br> <br>
        <form method="POST" action="apagarreg.php">
            <input type="submit" class="opebtne" value="Sim" name="btnsim">
            <input type="submit" class="opebtn" value="Não" name="btnnao">
        </form>
    </div>

    <?php
        if(isset($_POST['btnsim'])){
            include_once "conexao.php";
            $id = $_SESSION['id'];
            // PEGAR NOME DO DB
            $use="USE adm_financeira;";
            $selectdb = "SELECT Nome_DB FROM cadastros WHERE id = '$id'";
            $query = mysqli_query($con, $use);
            $query = mysqli_query($con, $selectdb);
            $res = mysqli_fetch_assoc($query);
            $nomedobanco = $res['Nome_DB'];

            $sqluse = "USE $nomedobanco;";
            $sql = "SELECT * FROM entradas;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($con);
            
            if($linhas > 0){
                for($i=1; $i <= $linhas; $i++){
                    $sqluse = "USE $nomedobanco;";
                    $sqlselect = "DELETE FROM entradas WHERE id = $i;";
                    $query = mysqli_query($con, $sqluse);
                    $query = mysqli_query($con, $sqlselect);
                }
                $sqluse = "USE $nomedobanco;";
                $sql = "ALTER TABLE entradas AUTO_INCREMENT = 1;";
                $query = mysqli_query($con, $sqluse);
                $query = mysqli_query($con, $sql);
            }

            $sqluse = "USE $nomedobanco;";
            $sql = "SELECT * FROM saidas;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($con);
            
            if($linhas > 0){
                for($i=1; $i <= $linhas; $i++){
                    $sqluse = "USE $nomedobanco;";
                    $sqlselect = "DELETE FROM saidas WHERE id = $i;";
                    $query = mysqli_query($con, $sqluse);
                    $query = mysqli_query($con, $sqlselect);
                }
                $sqluse = "USE $nomedobanco;";
                $sql = "ALTER TABLE saidas AUTO_INCREMENT = 1;";
                $query = mysqli_query($con, $sqluse);
                $query = mysqli_query($con, $sql);
            }
            unset($_POST['btnsim']);
            header("Location:extrato.php");
        }
    ?>

</body>
</html>