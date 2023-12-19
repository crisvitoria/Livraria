<?php 

class Conexao {

    function conexaoDB() {

        $host = 'localhost';
        $dbName = 'livraria';
        $user = 'root';
        $password  = '';

        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
        } catch(PDOException $error) {
            throw new Exception('Erro de conexao :' . $error->getMessage());
        }
        
        return $pdo;
    }
}
?>
