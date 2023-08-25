<?php

require_once "../vendor/autoload.php";

$clienteController = new \App\Controllers\ClienteController();

//$usuario = $_GET['Username'];


//if ($usuario == "null") {
   // echo "ACESSO NEGADO TOKEN INVALIDO";

   // exit;
//}

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
        $clientes = [];
        $clientes = $clienteController->pesquisarCliente($id); 
        echo json_encode($clientes);   
        
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json = file_get_contents('php://input');
        echo $clienteController->novoCliente($json);
    }

    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $json = file_get_contents('php://input');
        echo $clienteController->editaCliente($json);
    }

    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $id = $_GET['id'];
        $json = file_get_contents('php://input');
        echo $clienteController->excluirCliente($id);
    }
?>