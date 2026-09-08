<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactController extends BaseController
{
    public function send()
    {
        // 1. Validasi input
        $rules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'message' => 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Silakan periksa kembali formulir Anda.');
        }

        $name    = $this->request->getPost('name');
        $email   = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        // 2. Inisialisasi Service Email (Otomatis mengambil data dari .env)
        $mail = \Config\Services::email();

        // 3. Susun Email
        $fromEmail = getenv('email.SMTPUser');
        $mail->setFrom($fromEmail, $name . ' via Website Form');
        $mail->setReplyTo($email, $name); // Agar saat Anda klik "Reply", langsung ke email pengirim
        $mail->setTo($fromEmail);         // Mengirim ke inbox email hosting Anda sendiri
        $mail->setSubject('Pesan Kontak Baru dari: ' . $name);

        $body = "
            <h3>Pesan Baru dari Formulir Kontak Website</h3>
            <p><strong>Nama:</strong> {$name}</p>
            <p><strong>Email Pengirim:</strong> {$email}</p>
            <p><strong>Pesan:</strong><br>" . nl2br(esc($message)) . "</p>
        ";

        $mail->setMessage($body);

        // 4. Eksekusi Pengiriman
        if ($mail->send()) {
            return redirect()->to(base_url('/#contact'))->with('success', 'Pesan Anda berhasil dikirim!');
        } else {
            // Uncomment baris berikut jika ingin melihat detail error SMTP saat testing di localhost:
            // log_message('error', $mail->printDebugger(['headers', 'subject', 'body']));
            return redirect()->to(base_url('/#contact'))->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }
}