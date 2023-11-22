<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Autores</title>
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <?php
    
    include "conexaobanco.php";
    
    if(isset($_POST['consultar']))
    {

        //Construição da query com base nos filtros
        if(!empty($_POST['nome']))
        {
            $filtro[] = "nome LIKE '%".$_POST['nome']."%'";
        }
        if(!empty($_POST['e-mail']))
        {
            $filtro[] = "e-mail = '%".$_POST['e-mail']."%'";
        }
        if(!empty($_POST['data_nascimento']))
        {
            $filtro[] = "data_nascimento LIKE '".$_POST['data_nascimento']."'";
        }

        $query = "SELECT *
                FROM autores";
        
        if(!empty($filtro))
        {
            $query .= " WHERE ".implode(" AND ", $filtro);
        }

        $result = mysqli_query($conexao, $query);

        if ($result && mysqli_num_rows($result) > 0)
        {
            echo "<div class='w3-container'>";
            echo "<h2>Livros Cadastrados</h2>";
            echo "<table class='w3-table-all w3-hoverable'>
                    <thead>
                    <tr class='w3-light-grey'>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                    </tr>
                    </thead>";
        
            while ($row = mysqli_fetch_assoc($result))
            {
                $nome = $row['nome'];
                $email = $row['email'];
                $data_nascimento = new DateTimeImmutable($row['data_nascimento']);

                echo "<tr>
                        <td>$nome</td>
                        <td>$email</td>
                        <td>".$data_nascimento->format('d-m-Y')."</td>
                    </tr>";
            }

            echo "</table></div>";
            echo "</div>";
            echo '<br><br>
                <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>
                <a class="w3-btn w3-blue-grey" href="consultaautores.php" target="_self" rel="prev">Nova Pesquisa</a>';

        }
        else
        {
            echo "<div class='w3-panel w3-blue-grey'>
                    <h3>Não há resultados!</h3>
                    <p>Não há resultados a ser exibidos para os termos informados.</p>
                </div>";
            echo '<br><br>
                <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>
                <a class="w3-btn w3-blue-grey" href="consultaautores.php" target="_self" rel="prev">Nova Pesquisa</a>';
        }
    }
    ?>
</body>
</html>