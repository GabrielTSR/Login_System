<?php

function lerArquivo($nomeArquivo) {

    //lê o arquivo como string
    $arquivo = file_get_contents($nomeArquivo);
    
    //transforma a string em array
    $jasonArray = json_decode($arquivo);
    
    //devolve o array
    return $jasonArray;
    
    }

    /*
    Parâmetros da função:
    1- usuario vindo de fora
    2- senha vindo de fora
    3- dados de arquivo json
    */

    function realizarLogin($usuario, $senha, $dados){

        foreach ($dados as $dado) {
            
            if (strtolower($dado->usuario) == strtolower($usuario) && $dado->senha == $senha) {
                
                //VARIÁVEIS DA SESSÃO
                $_SESSION['usuario'] = $dado->usuario;
                $_SESSION['id'] = session_id();
                $_SESSION['data_hora'] = date('d/m/Y - h:i:s');
                header("location: ./area_restrita/staffTable.php");
                exit;

            }
        }
        header("location: index.php");

    }

    //FUNÇÃO DE VERIFIÇÃO DE LOGIN:
    //VERIFICA SE O USUÁRIO PASSOU PELO PROCESSO DE LOGIN
 
    function verificarLogin(){
        if( $_SESSION['id'] != session_id() || empty($_SESSION['id']) ) {

            header('location: ../index.php');

        }
    }

    function finalizarLogin(){
        session_unset(); //Limpa todas as variáveis de sessão.
        session_destroy();

        header('location: index.php');
    }

    function createUser($newUser, $users, $pathData){
        foreach ($users as $user) {
            strtolower($user->usuario) === strtolower($newUser['usuario'])&&$isThereRepeatUser = true;
        }

        if(!$isThereRepeatUser){
            $users[] = $newUser;
            $jasonNewUserList = json_encode($users);
            file_put_contents($pathData, $jasonNewUserList);
            realizarLogin($newUser['usuario'], $newUser['senha'], lerArquivo("./data/log.json"));
        } else {
            echo 'lala';
            header('location: cadastro.php');
        }
    }

?>