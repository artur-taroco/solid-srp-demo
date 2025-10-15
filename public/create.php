<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;

$repo = new FileProductRepository(filePath: __DIR__ . '/../storage/products.txt');
$validator = new SimpleProductValidator();
$service = new ProductService(repository: $repo, validator: $validator);

$result = $service->create($_POST);

if ($result['success']) {
    header("Location: products.php");
    exit;
} else {
    http_response_code(response_code: 422);
    echo "<h1>Erro ao cadastrar produto</h1>";
    foreach ($result['errors'] as $error) {
        echo "<p>$error</p>";
    }
    echo '<br><a href="index.php">Voltar</a>';
}
