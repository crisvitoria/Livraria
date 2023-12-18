<?php
include_once('../Connection/conexaobanco.php');


class LivroModel
{
    private $conex;

    public function __construct()
    {
        $this->conex = new Conexao();
    }

    function getLivroModel($titulo, $data_publicacao, $genero, $autor)
    {
        try {
            $filtro = [];
            //Verifica os critérios de busca
            if(!empty($titulo))
            {
                $filtro[] = "titulo LIKE '%".$titulo."%'";
            }
            if(!empty($data_publicacao))
            {
                $filtro[] = "data_publicacao = '".$data_publicacao."'";
            }
            if(!empty($genero))
            {
                $filtro[] = "id_genero = '".$genero."'";
            }
            if(!empty($autor))
            {
                $filtro[] = "fk_autor = ".$autor;
            }

            $query = "SELECT *
            FROM livros
            INNER JOIN genero ON livros.fk_genero = genero.id_genero
            INNER JOIN autores ON livros.fk_autor = autores.id_autor";

            if (!empty($filtro)) {
                $query .= " WHERE " . implode(" AND ", $filtro);
            }
            

            //preparacao da query
            $conexao = $this->conex->conexaoDB();

            $result = $conexao->prepare($query);

            $success = $result->execute();

            if ($success) {
                $row_count = $result->rowCount();
                $livros = $result->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obter todos os resultados
                return [$livros, $row_count];
            } else {
                return ['success' => false, 'message' => 'Falha ao carregar os livros'];
            }
        } 
        catch (Exception $ex) 
        {
            throw new Exception('Erro ao carregar o livro: ' . $ex->getMessage());
        }

    }




}



?>