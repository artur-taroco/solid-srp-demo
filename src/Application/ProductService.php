<?php

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;
use App\Domain\Product;

class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $input): array
    {
        [$valid, $errors] = $this->validator->validate($input);

        if (!$valid) {
            return ['success' => false, 'errors' => $errors];
        }

        $id = method_exists($this->repository, 'getNextId')
            ? $this->repository->getNextId()
            : 1;

        $product = new Product($id, trim($input['name']), (float)$input['price']);
        $this->repository->save($product);

        return ['success' => true, 'product' => $product];
    }

    public function list(): array
    {
        return $this->repository->findAll();
    }
}
