<?php
session_start();

require_once("./funcoes.php");

if (isset($_POST['txt_usuario']) && 
    isset($_POST['txt_senha']) && 
    isset($_POST['txt_confirmacao_senha'])) {

        $user = $_POST['txt_usuario'];
        $password = $_POST['txt_senha'];
        $passwordConfirmation = $_POST['txt_confirmacao_senha'];

        if ($password ===  $passwordConfirmation) {
            $newUser = array(
                'usuario' => $user,
                'senha' => $password
            );

            createUser($newUser, lerArquivo("./data/log.json"), './data/log.json');
        } else {
            header('location: cadastro.php');
        }

} else {
    finalizarLogin();
}
?>