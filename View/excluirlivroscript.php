<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Livros</title>
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <h1>Exclusão de Livros</h1>
    <?php
        include 'conexaobanco.php';
        $id = $_GET['id'];

        $query = "DELETE FROM livros WHERE id_livro = '$id'";
        $result = mysqli_query($conexao,$query);
        
        if ($result)
        {
            echo '<div class="w3-panel w3-pale-green w3-border">
                    <h3>Sucesso!</h3>
                    <p>Livro excluído com sucesso.</p>
                </div>';
        }
        else
        {
            echo '<div class="w3-panel w3-pale-red w3-border">
                    <h3>Erro!</h3>
                    <p>Erro ao excluir o livro.</p>
                </div>';
        }

    
        
    ?>
    <a class="w3-btn w3-blue-grey" href="excluirlivros.php" target="_self" rel="prev">Nova Pesquisa</a>
    <a class="w3-btn w3-blue-grey" href="index.php" target="_self" rel="prev">Página Inicial</a>
</body>
</html>