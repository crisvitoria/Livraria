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
    
    include "conexaobanco.php";
    
    if(isset($_POST['consultar']))
    {

        //Construição da query com base nos filtros
        if(!empty($_POST['titulo']))
        {
            $filtro[] = "titulo LIKE '%".$_POST['titulo']."%'";
        }
        if(!empty($_POST['data_publicacao']))
        {
            $filtro[] = "data_publicacao = '".$_POST['data_publicacao']."'";
        }
        if(!empty($_POST['genero']))
        {
            $filtro[] = "id_genero LIKE '".$_POST['genero']."'";
        }
        if(!empty($_POST['autor']))
        {
            $filtro[] = "id_autor = ".$_POST['autor'];
        }

        $query = "SELECT *
                FROM livros,
                    genero,
                    autores
                WHERE id_genero = fk_genero
                AND id_autor = fk_autor";
        
        if(!empty($filtro))
        {
            $query .= " AND ".implode(" AND ", $filtro);
        }

        $result = mysqli_query($conexao, $query);

        if ($result && mysqli_num_rows($result) > 0)
        {
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
        
            while ($row = mysqli_fetch_assoc($result))
            {
                $titulo = $row['titulo'];
                $data_publicacao = new DateTimeImmutable($row['data_publicacao']);
                $autor = $row['nome'];
                $genero = $row['nome_genero'];

                echo "<tr>
                        <td>$titulo</td>
                        <td>".$data_publicacao->format('d-m-Y')."</td>
                        <td>$autor</td>
                        <td>$genero</td>
                    </tr>";
            }

            echo "</table></div>";
            echo "</div>";
            echo '<br><br>
                <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>
                <a class="w3-btn w3-blue-grey" href="consultalivros.php" target="_self" rel="prev">Nova Pesquisa</a>';

        }
        else
        {
            echo "<div class='w3-panel w3-blue-grey'>
                    <h3>Não há resultados!</h3>
                    <p>Não há resultados a ser exibidos para os termos informados.</p>
                </div>";
            echo '<br><br>
                <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>
                <a class="w3-btn w3-blue-grey" href="consultalivros.php" target="_self" rel="prev">Nova Pesquisa</a>';
        }
    }
    ?>
</body>
</html>