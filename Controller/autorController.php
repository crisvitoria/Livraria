<?php

require_once('../Model/autorModel.php');

class autorController
{
    private $autorModel;
    
    public function __construct()
    {
        $this->autorModel = new AutorModel();
    }

    function getAllController()
    {
        try
        {
            $autorModel = $this->autorModel->getAllModel();
            return $autorModel;
        }
        catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

?>