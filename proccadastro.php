<?php
    include_once "conexao.php";

    if(isset($_POST['botaocadastro'])){
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $username = $_POST['username'];

        // INSERIR VALORES NO CADASTRO
        $insere = "INSERT INTO cadastros VALUES (NULL, '$nome', '$username', '$senha')";
        $query = mysqli_query($con, $insere);
        // CRIAR BANCO DE DADOS DA PESSOA
        $criardb = "CREATE DATABASE $nome";
        $query = mysqli_query($con, $criardb);
        // CRIAR TABELA DE ENTRADAS
        $criartb = "USE $nome; CREATE TABLE entradas(id int, motivo varchar(255), valor real);";
        $query = mysqli_query($con, $criartb);
        // ADICIONAR PRIMARY_KEY
        $mod = "USE $nome; ALTER TABLE entradas ADD PRIMARY KEY(id);";
        $query = mysqli_query($con, $mod);
        // AUTOINCREMENTO
        $mod2 = "ALTER TABLE entradas CHANGE id id int NOT NULL AUTO_INCREMENT;";
        $query = mysqli_query($con, $mod2);
        // ADICIONAR TABELA DE CATEGORIAS DE ENTRADAS
        $criartb = "USE $nome; CREATE TABLE ctg_entradas(categoria varchar(255));";
        $query = mysqli_query($con, $criartb);
        // CRIAR TABELA DE SAIDAS
        $tabsaidas = "USE $nome; CREATE TABLE saidas(id int, motivo varchar(255), valor real);";
        $query = mysqli_query($con, $tabsaidas);
        // ADICIONAR PRIMARY_KEY
        $mod = "USE $nome; ALTER TABLE entradas ADD PRIMARY KEY(id);";
        $query = mysqli_query($con, $mod);
        // AUTOINCREMENTO
        $mod2 = "ALTER TABLE entradas CHANGE id id int NOT NULL AUTO_INCREMENT;";
        $query = mysqli_query($con, $mod2);
        // ADICIONAR TABELA DE CATEGORIAS DE SAÍDAS
        $criartb = "USE $nome; CREATE TABLE ctg_saidas(categoria varchar(255));";
        $query = mysqli_query($con, $criartb);
        session_start();
        $_SESSION['cadastrou']=true;

        header("Location:fimcadastro.php");
    }else{
        header("Location:cadastre_se.php");
    }


?>