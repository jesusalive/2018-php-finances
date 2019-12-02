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
        <link rel="stylesheet" href="css/cssentradas1.css">
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
            $sql = "SELECT categoria FROM ctg_entradas;";
            $query = mysqli_query($con, $sqluse);
            $query = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($con);
        ?>

        <!-- CENTRO -->
        <div class="centro">
            <h1 class="textotit">ADICIONAR ENTRADA</h1> <br> <br>
            <form action="addentradas.php" method="POST" id = "entradas"> 
                <span class = "txinput"> Motivo </span>  
                <select form="entradas" name = "motivoent" class="input">
                   
                    <?php
                       for($i=1; $i <= $linhas; $i++){
                        $sqluse = "USE $dbname;";
                        $sqlselect = "SELECT * FROM ctg_entradas WHERE id = $i ";
                        $query = mysqli_query($con, $sqluse);
                        $query = mysqli_query($con, $sqlselect);
                        $res = mysqli_fetch_assoc($query);
                        $acategoria = $res['categoria'];
                        $categoria = str_replace("_", " ", $acategoria);


                        echo "<option value = $acategoria> $categoria </option>"; 
                        }
                    ?>
                  
                 </select> 
                 <button class="btnmod" action = "addcatent.php"> 
                <a href="addcatent.php" class="btnmod"> Adicionar nova categoria </a> 
                </button>  <br> <br> <br> 
                <span class = "txinput"> Valor </span> 
                <input type="number" name="valorent" class="inputv" step = "0.01" placeholder="R$"> 
                <input type="submit" name="enviarent" value="Registrar!" class="btn"><br> <br> <br> <br> <br>
                <a href="manual.php" class="aviso">
                    Manual de como inserir os valores! 
                </a> 
                
               
            </form>
        </div>
        <?php
            if(isset($_POST['enviarent'])){
                if(!empty($_POST['valorent']) && !empty($_POST['motivoent'])){
                    $velhovalor = mysqli_escape_string($con, $_POST['valorent']);
                    $novovalor = str_replace(',', '.', $velhovalor);
                    $motivo = mysqli_escape_string($con, $_POST['motivoent']);

                    $use = "USE $dbname;";
                    $insert = "INSERT INTO entradas VALUES (NULL, '$motivo', '$novovalor');";
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