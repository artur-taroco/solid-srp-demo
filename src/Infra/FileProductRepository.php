<?php

namespace App\Infra;

use App\Contracts\ProductRepository;
use App\Domain\Product;

class FileProductRepository implements ProductRepository
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, "");
        }
    }

    public function save(Product $product): void
    {
        $line = json_encode([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price
        ]);
        file_put_contents($this->filePath, $line . PHP_EOL, FILE_APPEND);
    }

    public function findAll(): array
    {
        $products = [];
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line) {
            $data = json_decode($line, true);
            if ($data) {
                $products[] = new Product($data['id'], $data['name'], (float)$data['price']);
            }
        }

        return $products;
    }

    public function getNextId(): int
    {
        $products = $this->findAll();
        if (empty($products)) {
            return 1;
        }
        $last = end($products);
        return $last->id + 1;
    }
}
