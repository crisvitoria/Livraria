<?php

require_once('../Model/livroModel.php');

class livroController
{
    private $livroModel;
    
    public function __construct()
    {
        $this->livroModel = new LivroModel();
    }

    function getLivroController($titulo, $data_publicacao, $genero, $autor, $pagina, $resultados_por_pagina)
    {
        try
        {
            $livroModel = $this->livroModel->getLivroModel($titulo, $data_publicacao, $genero, $autor, $pagina, $resultados_por_pagina);
            return $livroModel;
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
    

?>