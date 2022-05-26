<?php

require __DIR__ . "/../utils/dbPostgres.php";

class UsersControllers {
   function getUsers($request_data){  
        $sql = "SELECT * FROM users ";
        
        if($request_data):
            $sql = ($request_data) ?  $sql.'WHERE ' : false;

            foreach ($request_data as $key => $value):
                $v = (count($request_data) > 1) ? ',' : '';
                $param = ($request_data[$key]) ? $key.'='.$request_data[$key].$v : '';
            endforeach;
        endif;
      
        $cmd = connectDB()->prepare($sql.$param);
        $cmd->execute();
        $data = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $data;
   }

   function getUsersById($id){
        $cmd = connectDB()->prepare("SELECT * FROM users WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $data = $cmd->fetch(PDO::FETCH_ASSOC);
        return $data;
   }

   function postUsers($nome, $sexo, $datanascimento, $idade){    
        $sql = "INSERT INTO users (nome,sexo,datanascimento,idade) VALUES (:nome,:sexo,:datanascimento,:idade)";
        $cmd = connectDB()->prepare($sql);
        $cmd->bindValue(":nome", $nome);
        $cmd->bindValue(":sexo", $sexo);
        $cmd->bindValue(":datanascimento", $datanascimento);
        $cmd->bindValue(":idade", $idade);
        $cmd->execute();
   }

   function putUsers($id, $nome, $sexo, $datanascimento, $idade){
        $sql = "UPDATE users SET nome=:nome, sexo=:sexo, datanascimento=:datanascimento, idade=:idade WHERE id=:id";
        $cmd = connectDB()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->bindValue(":nome", $nome);
        $cmd->bindValue(":sexo", $sexo);
        $cmd->bindValue(":datanascimento", $datanascimento);
        $cmd->bindValue(":idade", $idade);
        $cmd->execute();
   }

   function deleteUsers($id){
        $sql = "DELETE FROM users WHERE id=:id";
        $cmd = connectDB()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
   }
}

