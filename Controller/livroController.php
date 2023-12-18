<?php

require_once('../Model/livroModel.php');

class livroController
{
    private $livroModel;
    
    public function __construct()
    {
        $this->livroModel = new LivroModel();
    }

    function getLivroController($titulo, $data_publicacao, $genero, $autor)
    {
        try
        {
            $livroModel = $this->livroModel->getLivroModel($titulo, $data_publicacao, $genero, $autor);
            return $livroModel;
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

?>