<?php

namespace App\Models;

class ClienteModel
{
    public function conecta(){            

        $server = "localhost";
        $base = "apiversao3";
        $usuario = "root";
        $senha = "";
       
        global $conexao;
          
        try{
       
            $conexao = new \PDO("mysql:dbname=".$base."; host=".$server, $usuario, $senha);
           
       
            //ativar o modo de erros
            $conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
       
        }catch(PDOException $e){
            //erro na conexão
            $error = $e->getMessage();
           echo "erro: $error";  
        }
        return $conexao;
    }
    public function pesquisarCliente($id_clientes,$conexao){

        $clientes = [];

     $sql = $conexao->prepare("SELECT * FROM clientes WHERE id_clientes = :id_clientes");
     $sql->bindValue(':id_clientes',$id_clientes);
     $sql->execute();

         if($sql->rowCount() > 0){
              $clientes = $sql->fetch(\PDO::FETCH_ASSOC);
         }else{
             echo "cliente não encontrado";
         exit;
     }

     return $clientes;

 
 }
 public function editarCliente($id,$nome,$idade,$email,$endEntrega,$endCobranca,$id_user,$conexao){
           
  //  $cliente= new clienteModel();
  //  $conexao = $cliente->conecta();

    $sql = $conexao->prepare("UPDATE clientes SET id_clientes = :id, nome_cliente = :nome, idade = :idade, email = :email, end_cobranca = :endCobranca, 
    end_entrega = :endEntrega, id_usuario = :id_user WHERE id_clientes = :id");
    $sql->bindValue(':id',$id);
    $sql->bindValue(':nome',$nome);
    $sql->bindValue(':idade',$idade);
    $sql->bindValue(':email',$email);
    $sql->bindValue(':endCobranca',$endCobranca);
    $sql->bindValue(':endEntrega',$endEntrega);          
    $sql->bindValue(':id_user',$id_user);
    $sql->execute();
        
    $cod = http_response_code();

    if($cod == 200 || 201){
        echo "Status:". http_response_code()."Usuário editado";
    }else{
        echo "Falha ao editar Cliente!";
    }

}

        public function deletar($id,$conexao){

            //$cliente= new clienteModel();
           //$conexao= $cliente->conecta();

            $sql= $conexao->prepare("DELETE FROM clientes WHERE id_clientes = :id");
            $sql->bindValue(':id',$id);
            $sql->execute();

            $cod = http_response_code();

            if($cod == 200 || 201){
                echo "Status:". http_response_code()."Usuário Excluido";
            }else{
                echo "Falha ao excluir Cliente!";
            }

            //var_dump(http_response_code());
        }

public function cadastrarCliente($nome,$idade,$email,$endCobranca, $endEntrega,$id_usuario,$conexao){

    //$cliente= new clienteModel();
    //$conexao = $cliente->conecta();

    $sql= $conexao->prepare("INSERT INTO clientes (nome_cliente, idade, email, end_cobranca,end_entrega, id_usuario) VALUES (:nome, :idade, :email,:endCobranca,:endEntrega,:id_usuario)");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':idade', $idade);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':endCobranca', $endCobranca);
    $sql->bindValue(':endEntrega', $endEntrega);
    $sql->bindValue(':id_usuario',$id_usuario);

    $sql->execute();

    $cod = http_response_code();

    if($cod == 200 || 201){
        echo "Status: ". http_response_code()." Usuário Cadastrado";
    }else{
        echo "Falha ao cadastrar Cliente!";
    }
}

}
?>