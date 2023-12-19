<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Livros</title>
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

    <?php

        require_once('../Controller/livroController.php');
        require_once('../Controller/autorController.php');
        require_once('../Controller/generoController.php');

        $livroController = new livroController();
        $autorController = new autorController();
        $generoController = new generoController();

        $dataAutor = $autorController->getAllController();
        $dataGenero = $generoController->getAllController();
        

        if(isset($_POST['consultar']) || isset($_GET['pagina']) != null){
            
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
            $data_publicacao = isset($_POST['data_publicacao']) ? $_POST['data_publicacao'] : '';
            $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
            $autor = isset($_POST['autor']) ? $_POST['autor'] : '';
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : '1';

            $resultados = $livroController->getLivroController($titulo, $data_publicacao, $genero, $autor, $pagina, $resultados_por_pagina = 10);

            $dataLivro = $resultados['livros'];
            $countRows = $resultados['total'];
            
        } 
        
    ?>
    <!-- Exibição so formulário de pesquisa -->
    <div class="w3-container w3-teal">
        <h2>Consulta de Livros</h2>
    </div>

    <form method="post" class="w3-container">
        <br>
        <label class="w3-text-teal"><b>Titulo</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="titulo">

        
        <br>

        <label class="w3-text-teal"><b>Data de Publicação</b></label>
        <input class="w3-input w3-border w3-light-grey" type="date" name="data_publicacao">
        <br>
        <label class="w3-text-teal"><b>Gênero</b></label>
        <select class="w3-select" name="genero">
            <option value="" disabled selected>Selecione</option>
            <?php
                foreach ($dataGenero as $row) 
                {
                    $id_genero = $row['id_genero'];
                    $nome_genero = $row['nome_genero'];
                    
                    echo '<option value="'.$id_genero.'">'.$nome_genero.'</option>';

                }
            ?>
        </select>
        <br><br>
        <label class="w3-text-teal"><b>Autor</b></label>
        <select class="w3-select" name="autor">
            <option value="" disabled selected>Selecione</option>
            <?php
                foreach ($dataAutor as $row) 
                {
                    $id_autor = $row['id_autor'];
                    $nome_autor = $row['nome'];
                    
                    echo '<option value="'.$id_autor.'">'.$nome_autor.'</option>';

                }
            ?>
        </select>

        <br><br>
        <button class="w3-btn w3-blue-grey" name="consultar">Consultar</button>
        <button class="w3-btn w3-blue-grey" type = "reset">Limpar</button>
        <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>

    </form>

    <!--Resultado da pesquisa-->
    <?php
    
    if(isset($_POST['consultar']) || isset($_GET['pagina']) != null){
        if ($countRows > 0) {
            echo "<div class='w3-container'>";
            echo "<h2>Livros Cadastrados</h2>";
            echo "<table class='w3-table-all w3-hoverable'>
                    <thead>
                    <tr class='w3-light-grey'>
                        <th>Título</th>
                        <th>Data da Publicação</th>
                        <th>Autor</th>
                        <th>Gênero</th>
                    </tr>
                    </thead>";

            foreach ($dataLivro as $row)
            {
                $titulo = $row['titulo'];
                $data_publicacao = $row['data_publicacao'];
                $autor = $row['nome'];
                $genero = $row['nome_genero'];

                echo "<tr>
                        <td>$titulo</td>
                        <td>$data_publicacao</td>
                        <td>$autor</td>
                        <td>$genero</td>
                    </tr>";
            }

            echo "</table></div>";
            echo "</div><br>";

            // Lógica para a paginação
            $total_pages = ceil($countRows / $resultados_por_pagina);
            echo "<div class='w3-bar'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?pagina=$i' class='w3-bar-item w3-button'>$i</a>";
            }
            echo "</div>";
        }    
        else
        {
            echo "<br><div class='w3-panel w3-blue-grey'>
                    <h3>Não há resultados!</h3>
                    <p>Não há resultados a ser exibidos para os termos informados.</p>
                </div>";

        }

    }

    ?>
</body>
</html>