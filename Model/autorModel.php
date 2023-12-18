<?php
include_once('../Connection/conexaobanco.php');


class AutorModel
{
    private $conex;

    public function __construct()
    {
        $this->conex = new Conexao();
    }

    function getAllModel ()
    {
        try
        {
            $query = "SELECT id_autor, nome FROM autores ORDER BY nome";

            //preparacao da query
            $conexao = $this->conex->conexaoDB();

            $result = $conexao->prepare($query);

            $success = $result->execute();

            
            if ($success) {
                $autores = $result->fetchAll(PDO::FETCH_ASSOC);
                return $autores;
            } else {
                return ['success' => false, 'message' => 'Falha ao carregar os autores'];
            }
        }
        catch (Exception $ex) 
        {
            throw new Exception('Erro ao carregar o produto: ' . $ex->getMessage());
        }
        
        
    }

}
?>