<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController
{

    public function novoCliente($json)
    {
        $dadosCliente = json_decode($json);

            $nome= $dadosCliente->nome_cliente;
            $idade = $dadosCliente->idade;
            $email = $dadosCliente->email;
            $endCobranca = $dadosCliente->endCobranca;
            $endEntrega = $dadosCliente->endEntrega;
            $id_usuario = $dadosCliente->id_usuario;

        $clienteModel = new ClienteModel();

        $conexao = $clienteModel-> conecta();

        $cliente = $clienteModel->cadastrarCliente($nome,$idade,$email,$endCobranca,$endEntrega,$id_usuario,$conexao);
    }
    
    public function pesquisarCliente($id)
    {
        $clienteModel = new ClienteModel();

        $conexao = $clienteModel-> conecta();

        $dados = [];

        $dados = $clienteModel -> pesquisarCliente($id,$conexao);

        return $dados;
    }

    public function editaCliente($json)
    {

        $dadosCliente = json_decode($json);

            $id = $dadosCliente->id_clientes;
            $nome = $dadosCliente->nome_cliente;    
            $idade = $dadosCliente->idade;
            $email = $dadosCliente->email;
            $endCobranca = $dadosCliente->endCobranca;
            $endEntrega = $dadosCliente->endEntrega;
            $id_user = $dadosCliente->id_usuario;

        $clienteModel = new ClienteModel();

        $conexao = $clienteModel -> conecta();

        $confirmacao = $clienteModel ->editarCliente($id,$nome,$idade,$email,$endCobranca,$endEntrega,$id_user,$conexao);
    }
    public function excluirCliente($id)
    {
        $clienteModel = new ClienteModel();

        $conexao = $clienteModel-> conecta();

        $confirmacao = $clienteModel -> deletar($id,$conexao);
    }


}

?>