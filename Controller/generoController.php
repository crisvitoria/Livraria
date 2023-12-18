<?php

require_once('../Model/generoModel.php');

class generoController
{
    private $generoModel;
    
    public function __construct()
    {
        $this->generoModel = new GeneroModel();
    }

    function getAllController()
    {
        try
        {
            $generoModel = $this->generoModel->getAllModel();
            return $generoModel;
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

?>