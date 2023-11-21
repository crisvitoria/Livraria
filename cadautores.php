<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Autores</title>
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>


    <div class="w3-container w3-teal">
        <h2>Cadastro de Autores</h2>
    </div>

    <form action="cadautoresscript.php" method="post" class="w3-container">
        <label class="w3-text-teal"><b>Nome</b></label>
        <input class="w3-input w3-border w3-light-grey" type="text" name="nome" required>

        <label class="w3-text-teal"><b>E-mail</b></label>
        <input class="w3-input w3-border w3-light-grey" type="email" name="email" required>

        <label class="w3-text-teal"><b>Data de Nascimento</b></label>
        <input class="w3-input w3-border w3-light-grey" type="date" name="data_nascimento" required>

        <br>
        <button class="w3-btn w3-blue-grey" name="cadastrar">Cadastrar</button>
        <button class="w3-btn w3-blue-grey" type = "reset">Limpar</button>

    </form>

</body>
</html>