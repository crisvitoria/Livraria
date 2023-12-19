<?php
    include_once('../Connection/conexaobanco.php');


    class GeneroModel
    {
        private $conex;

        public function __construct()
        {
            $this->conex = new Conexao();
        }

        //Essa função irá buscar todos os gêneros, ordenado alfabéticamente pelo nome
        function getAllModel ()
        {
            try
            {
                //Query para trazer os generos
                $query = "SELECT * FROM genero ORDER BY nome_genero";

                //Preparacao da query
                $conexao = $this->conex->conexaoDB();

                $result = $conexao->prepare($query);

                $success = $result->execute();
                
                if ($success) {
                    $genero = $result->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obter todos os resultados
                    return $genero;
                } else {
                    return ['success' => false, 'message' => 'Falha ao carregar os livros'];
                }

            }
            catch (Exception $ex) 
            {
                throw new Exception('Erro ao carregar o produto: ' . $ex->getMessage());
            }
        }
    }
?>