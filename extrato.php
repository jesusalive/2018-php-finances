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

    <!-- PROCESSAMENTO PHP -->
    <?php
        include_once "conexao.php";
        $id = $_SESSION['id'];
        // PEGAR NOME DO DB
        $selectdb = "SELECT Nome_DB FROM cadastros WHERE id = '$id'";
        $query = mysqli_query($con, $selectdb);
        $res = mysqli_fetch_assoc($query);
        $nomedobanco = $res['Nome_DB'];
        
        // SOMA DAS ENTRADAS
        $sqluse = "USE $nomedobanco;";
        $sql = "SELECT * FROM entradas;";
        $query = mysqli_query($con, $sqluse);
        $query = mysqli_query($con, $sql);
        $linhas = mysqli_affected_rows($con);
        

        for($i=1; $i <= $linhas; $i++){
            $sqluse = "USE $nomedobanco;";
            $sqlselect = "SELECT valor FROM entradas WHERE id = $i;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sqlselect);
            $res = mysqli_fetch_assoc($query);
            $valor = $res['valor'];
            $soma = $valor + $soma;
        }
        // SOMA DAS SAIDAS
        $sqluse = "USE $nomedobanco;";
        $sql = "SELECT * FROM saidas;";
        $query = mysqli_query($con, $sqluse);
        $query = mysqli_query($con, $sql);
        $linhas = mysqli_affected_rows($con);
        

        for($i=1; $i <= $linhas; $i++){
            $sqluse = "USE $nomedobanco;";
            $sqlselect = "SELECT valor FROM saidas WHERE id = $i;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sqlselect);
            $res = mysqli_fetch_assoc($query);
            $valor = $res['valor'];
            $somasai = $valor + $somasai;            
        }

        $saldo = $soma - $somasai;
        if(empty($soma)){
            $soma = '0.00';
        }

        if(empty($somasai)){
            $somasai = '0.00';
        }

        if($saldo == 0){
            $saldo = '0.00';
        }
    ?>

    <div name = "parte central" class = "centro">
        <div class="entradas"> 
            <span class="titulo_">ENTRADAS</span> <br> <br> <br>
            <span class="totent">R$ <?php $soma = number_format($soma, '2', ',', '.');
            // $soma = str_replace(".", ",", $soma);
            echo $soma;?></span>
            <!-- <button>Vizualizar todas as entradas</button> <br> <br>
            <button>Resetar entradas</button> -->
        </div>

        <div class="saidas">
            <span class="titulo_">SAIDAS</span> <br> <br> <br>
            <span class="totsai">R$ <?php $somasai = number_format($somasai, '2', ',', '.');
            // $somasai = str_replace(".", ",", $somasai);
            echo $somasai;?></span>
        </div>

        <div class="saldof">
            <span class="titulo_">SALDO</span> <br> <br> <br>
            <?php
            if($saldo < 0){
                $saldo = number_format($saldo, '2', ',', '.');
                // $saldo =str_replace(".", ",", $saldo);
               echo "<span class='saldovermelho'>R$ $saldo </span> ";
            }else{
                $saldo = number_format($saldo, '2', ',', '.');
                // $saldo =str_replace(".", ",", $saldo);
                echo "<span class='saldoverde'>R$ $saldo </span>";
            }
            ?>
        </div> 

        <div class="ope">
            <fieldset class="fildset">
                <legend><span class="tit2">OPERAÇÕES</span></legend>
                <a href="extrato/vizuentradas.php" ><button class="opebtne">Visualizar entradas</button></a>
                <a href="extrato/vizusaidas.php" ><button class="opebtns">Vizualizar saídas</button></a> <br> <br>

                <A href="apagarreg.php">
                    <button class="opebtn" name="reset">Resetar registros</button>
                </A>
            </fieldset>
        </div>
    </div>
    
</body>
</html>