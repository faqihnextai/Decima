<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProductController extends Controller
{
    private string $dataFile = WRITEPATH . 'data/products.json';

    private function getProducts(): array
    {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }

    public function detail(string $slug)
    {
        $products = $this->getProducts();
        $productItem = null;

        foreach ($products as $item) {
            $itemSlug = $item['slug'] ?? mb_url_title($item['title'], '-', true);
            if ($itemSlug === $slug || ($item['id'] ?? '') === $slug) {
                $productItem = $item;
                break;
            }
        }

        if (!$productItem) {
            throw PageNotFoundException::forPageNotFound('Halaman produk tidak ditemukan.');
        }

        $data['product'] = $productItem;
        return view('page/Detailsproduct-static-page', $data);
    }
}