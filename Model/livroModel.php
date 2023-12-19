<?php
include_once('../Connection/conexaobanco.php');


class LivroModel
{
    private $conex;

    public function __construct()
    {
        $this->conex = new Conexao();
    }


    //Essa função irá buscar todos os livros, construindo a query de acordo com os campos preenchidos.
    function getLivroModel($titulo, $data_publicacao, $genero, $autor, $pagina, $resultados_por_pagina)
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


            var_dump($pagina);

            $query = "SELECT COUNT(*) as total FROM livros 
                  INNER JOIN genero ON livros.fk_genero = genero.id_genero 
                  INNER JOIN autores ON livros.fk_autor = autores.id_autor";

            if (!empty($filtro)) {
                $query .= " WHERE " . implode(" AND ", $filtro);
            }

            $conexao = $this->conex->conexaoDB();
            $total_resultados = $conexao->query($query)->fetch(PDO::FETCH_ASSOC)['total'];
           
            $limit = '';
            if ($total_resultados > 0) {
                $offset = ($pagina - 1) * $resultados_por_pagina;
                $limit = " LIMIT $offset, $resultados_por_pagina";
            }

            $query = "SELECT *
                    FROM livros 
                    INNER JOIN genero ON livros.fk_genero = genero.id_genero 
                    INNER JOIN autores ON livros.fk_autor = autores.id_autor";

            if (!empty($filtro)) {
                $query .= " WHERE " . implode(" AND ", $filtro);
            }
            $query .= $limit;


            $result = $conexao->prepare($query);
            $success = $result->execute();


            if ($success) {
                $livros = $result->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obter todos os resultados
                return ['livros' => $livros, 'total' => $total_resultados];
                
            } else {
                return ['success' => false, 'message' => 'Falha ao carregar os livros'];
            }
        } catch (Exception $ex) {
            throw new Exception('Erro ao carregar o livro: ' . $ex->getMessage());
        }

    }




}



?>