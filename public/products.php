<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;

$repo = new FileProductRepository(__DIR__ . '/../storage/products.txt');
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->list();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
</head>
<body>
    <h1>Produtos Cadastrados</h1>
    <?php if (empty($products)): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
            </tr>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->id) ?></td>
                    <td><?= htmlspecialchars($p->name) ?></td>
                    <td>R$ <?= number_format($p->price, 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <br>
    <a href="index.php">Cadastrar novo produto</a>
</body>
</html>
