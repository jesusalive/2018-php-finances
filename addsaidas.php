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
        <link rel="stylesheet" href="css/csssaidas.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link rel="icon" href="css/img/icone.png"> 
        <title>Adicionar saída</title>
    </head>
    <body>
        <!-- CABEÇALHO -->
        <?php $usuario = $_SESSION['nome']; $sobrenome = $_SESSION['sobrenome'];?>    
        <div name="cabeçalho" class = "cabecalho">
            <img src="css\img\logo.png" alt="logo" class = "beleza">
            <span class = "titcima"> <br> Olá, <?php echo $usuario; echo " ".$sobrenome; ?>! </span>
        </div>

        <!-- PHP -->
        <?php
            $nome = $usuario;
            $id = $_SESSION['id'];

            $use= "USE adm_financeira";
            $select = "SELECT * FROM cadastros WHERE id = $id";
            $query = mysqli_query($con, $use);
            $query6 = mysqli_query($con, $select);
            $linhas = mysqli_fetch_assoc($query6);
            $dbname = $linhas['Nome_DB'];
        
    
            $sqluse = "USE $dbname;";
            $sql = "SELECT categoria FROM ctg_saidas;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($con);
        ?>


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

        <!-- CENTRO -->
        <div class="centro">
            <h1 class="textotit">ADICIONAR SAÍDA</h1> <br> <br>
            <form action="addsaidas.php" method="POST">
                <span class = "txinput"> Motivo </span>
                <select name="motivo" id="motivo" class="input">
                    <?php
                        for($i=1; $i <= $linhas; $i++){
                            $sqluse = "USE $dbname;";
                            $sqlselect = "SELECT * FROM ctg_saidas WHERE id = $i ";
                            $query = mysqli_query($con, $sqluse);
                            $query = mysqli_query($con, $sqlselect);
                            $res = mysqli_fetch_assoc($query);
                            $acategoria = $res['categoria'];
                            $categoria = str_replace("_", " ", $acategoria);


                            echo "<option value = $acategoria> $categoria </option>"; 
                            }
                    ?>
                 </select> 
                 <button class="btnmod"> 
                    <a href="addcatsai.php" class="btnmod"> Adicionar nova categoria </a> 
                </button>  <br> <br> <br> 
                <span class = "txinput"> Valor </span> 
                <input type="number" name="valor" class="inputv" placeholder="R$" step = "0.01" required>
                <input type="submit" name="enviar" value="Registrar!" class="btn"><br> <br> <br> <br> <br>
                <a href="manual.php" class="aviso">
                    Manual de como inserir os valores! 
                </a>
            </form>
        </div>
        <?php
            if(isset($_POST['enviar'])){
                if(!empty($_POST['valor']) && !empty($_POST['motivo'])){
                    $velhovalor = mysqli_escape_string($con, $_POST['valor']);
                    $novovalor = str_replace(',', '.', $velhovalor);
                    $motivo = mysqli_escape_string($con, $_POST['motivo']);

                    $use = "USE $dbname;";
                    $insert = "INSERT INTO saidas VALUES (NULL, '$motivo', '$novovalor');";
                    $query = mysqli_query($con, $use);
                    $query = mysqli_query($con, $insert);
                    echo "<br> <br> <div class = 'sucesso'>Valor registrado com sucesso! </div> <br> <br>";
                }else{
                    echo "<div class= 'error'> Por favor, preencha todos os campos! </div>";
                }
            }
        ?>
    </body>
</html>