<?php require __DIR__ . '/../vendor/autoload.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form action="create.php" method="POST">
        <label>Nome: <input type="text" name="name" required></label><br><br>
        <label>Preço: <input type="number" step="0.01" name="price" required></label><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="products.php">Ver produtos cadastrados</a>
</body>
</html>
