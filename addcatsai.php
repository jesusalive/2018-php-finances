<?php
    session_start();
    if($_SESSION['logou'] != 1){
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/css_add.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link rel="icon" href="css/img/icone.png"> 
        <title>Adicionar categoria</title>
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

        <DIV class="centro">
        <h1 class="textotit">ADICIONE UMA CATEGORIA DE SAÍDA DE DINHEIRO</h1> <br> <br> <br>
        <form action="addcatsai.php" method="POST">
            <span class = "txinput"> Nome da Categoria </span> <br> <br>
            <input type="text" name = "cat" class="input" placeholder="Ex: Balada / Ex: Lanche"> <br> <br> <br> <br> <br>
            <input type="submit" value="Cadastrar categoria" name = "btn" class="btn">
        </form>
        </DIV>
    </body>

</html>

<?php
    
   if(!empty($_POST['cat']) && isset($_POST['btn'])){
        include_once "conexao.php";
        $cat = mysqli_escape_string($con, $_POST['cat']);
        $novacat = str_replace(" ", "_", $cat);
        $id = $_SESSION['id'];

        // PEGOU NOME DO DB
        $selectdb = "SELECT Nome_DB FROM cadastros WHERE id = '$id'";
        $query = mysqli_query($con, $selectdb);
        $res = mysqli_fetch_assoc($query);
        $nomedobanco = $res['Nome_DB'];
        
        // INSERIR NA TABELA DE CATEGORIAS
        $sqluse = "USE $nomedobanco";
        $sqlselec= "SELECT * FROM ctg_saidas WHERE categoria = '$novacat'";
        $query1 = mysqli_query($con, $sqluse);
        $query = mysqli_query($con, $sqlselec);
        $linhas = mysqli_affected_rows($con);
        if($linhas > 0){
            echo "<div class= 'error'> Categoria já cadastrada </div>";
            
        }else{
            $sqlinsert = "INSERT INTO ctg_saidas VALUES (NULL,'$novacat');";
            $query1 = mysqli_query($con, $sqluse);
            $query2 = mysqli_query($con, $sqlinsert);

            //escrever o sucesso na tela
            $linhas = mysqli_affected_rows($con);
        if ($linhas > 0){
            echo "<br> <br> <div class = 'sucesso'>Categoria cadastrada com sucesso! </div> <br> <br>";
        }
    }
}

?>