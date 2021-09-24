<?php
session_start();

require_once("./funcoes.php");

//RECEBENDO DADOS DO FORMULÁRIO

if( isset($_POST['txt_usuario']) &&  isset($_POST['txt_senha'])) {

    
    $usuario = $_POST['txt_usuario'];
    $senha = $_POST['txt_senha'];
    
    realizarLogin($usuario, $senha, lerArquivo("./data/log.json"));
} else if($_GET['logout']){
    finalizarLogin();
}
?>