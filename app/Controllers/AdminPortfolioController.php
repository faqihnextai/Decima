<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate; // Panggil library translate

class AdminPortfolioController extends Controller
{
    private string $dataFile = WRITEPATH . 'data/portfolios.json';
    private string $uploadPath = FCPATH . 'uploads/portfolio/';

    private function getPortfolios(): array
    {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }

    private function savePortfolios(array $data): void
    {
        if (!is_dir(WRITEPATH . 'data/')) {
            mkdir(WRITEPATH . 'data/', 0777, true);
        }
        file_put_contents($this->dataFile, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    public function index()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/login');
        }

        $data['portfolios'] = $this->getPortfolios();
        return view('admin/Input-Portofolio', $data);
    }

    public function save()
    {
        if (!session()->get('is_admin')) return redirect()->to('/login');

        $id = $this->request->getPost('id');
        $title = $this->request->getPost('title');
        $date = $this->request->getPost('date') ?: date('Y-m-d');
        $description = $this->request->getPost('description');
        
        // --- TRANSLATE OTOMATIS ID -> EN ---
        $titleEn = $title;
        $descEn  = $description;
        try {
            $tr = new GoogleTranslate('en'); // Set target bahasa Inggris
            $tr->setSource('id');            // Set sumber bahasa Indonesia
            
            $titleEn = $tr->translate($title);
            $descEn  = $tr->translate($description);
        } catch (\Exception $e) {
            // Fallback jika API timeout/gagal: gunakan teks aslinya
            log_message('error', 'Translate Error: ' . $e->getMessage());
        }

        // Handle Upload Gambar
        $imageFile = $this->request->getFile('image');
        $imageName = $this->request->getPost('existing_image') ?: '';

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            if (!is_dir($this->uploadPath)) {
                mkdir($this->uploadPath, 0777, true);
            }
            $imageName = $imageFile->getRandomName();
            $imageFile->move($this->uploadPath, $imageName);
        }

        $portfolios = $this->getPortfolios();

        if ($id) {
            // Mode Edit
            foreach ($portfolios as &$item) {
                if ($item['id'] == $id) {
                    $item['title']          = $title;
                    $item['title_en']       = $titleEn;
                    $item['date']           = $date;
                    $item['description']    = $description;
                    $item['description_en'] = $descEn;
                    if ($imageName) {
                        $item['image'] = $imageName;
                    }
                    break;
                }
            }
        } else {
            // Mode Tambah Baru
            $newId = empty($portfolios) ? 1 : max(array_column($portfolios, 'id')) + 1;
            $portfolios[] = [
                'id'             => $newId,
                'title'          => $title,
                'title_en'       => $titleEn,
                'date'           => $date,
                'description'    => $description,
                'description_en' => $descEn,
                'image'          => $imageName,
                'created_at'     => date('Y-m-d H:i:s')
            ];
        }

        $this->savePortfolios($portfolios);
        return redirect()->to('/admin/portfolio')->with('success', 'Data berita portofolio berhasil disimpan & diterjemahkan!');
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('/login');

        $portfolios = $this->getPortfolios();
        
        foreach ($portfolios as $item) {
            if ($item['id'] == $id && !empty($item['image']) && file_exists($this->uploadPath . $item['image'])) {
                @unlink($this->uploadPath . $item['image']);
                break;
            }
        }

        $filtered = array_filter($portfolios, fn($item) => $item['id'] != $id);
        $this->savePortfolios($filtered);

        return redirect()->to('/admin/portfolio')->with('success', 'Data berhasil dihapus!');
    }
}