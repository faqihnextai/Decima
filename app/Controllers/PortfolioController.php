<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class PortfolioController extends Controller
{
    private string $dataFile = WRITEPATH . 'data/portfolios.json';

    private function getPortfolios(): array
    {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }

    public function detail(string $slug)
    {
        $portfolios = $this->getPortfolios();
        $portfolioItem = null;

        // Cari item berdasarkan slug judul (Indonesia maupun English) atau ID
        foreach ($portfolios as $item) {
            $itemSlugId = mb_url_title($item['title'] ?? '', '-', true);
            $itemSlugEn = mb_url_title($item['title_en'] ?? '', '-', true);

            if ($itemSlugId === $slug || $itemSlugEn === $slug || (string)($item['id'] ?? '') === $slug) {
                $portfolioItem = $item;
                break;
            }
        }

        if (!$portfolioItem) {
            throw PageNotFoundException::forPageNotFound('Halaman portofolio tidak ditemukan.');
        }

        $data['portfolio'] = $portfolioItem;
        
        // Memanggil file view yang berada di app/Views/page/Portfolio-static-page.php
        return view('page/Portfolio-static-page', $data);
    }
}