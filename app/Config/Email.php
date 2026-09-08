<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * Alamat email pengirim (Default fallback jika .env tidak ada)
     */
    public string $fromEmail = 'info@domainanda.com';
    public string $fromName  = 'Website Notification';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

    /**
     * Protocol pengiriman: smtp (bisa dioverride lewat .env: email.protocol)
     */
    public string $protocol = 'smtp';

    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * Konfigurasi SMTP Rumahweb / Hosting
     * Cukup override di file .env menggunakan prefix: email.SMTPHost, email.SMTPUser, dst.
     */
    public string $SMTPHost = 'mail.domainanda.com'; // Contoh: mail.namadomain.com / server hostname cPanel
    public string $SMTPUser = 'info@domainanda.com'; // Akun email hosting Rumahweb
    public string $SMTPPass = 'qkivSx(aK_9zwF#Q'; 
    public int $SMTPPort    = 465;                   // 465 (SSL) atau 587 (TLS)
    public string $SMTPCrypto = 'ssl';               // 'ssl' untuk port 465, 'tls' untuk port 587
    public string $SMTPAuthMethod = 'login';
    public int $SMTPTimeout = 60;                    // Diberi waktu lebih lama agar tidak timeout dari lokal
    public bool $SMTPKeepAlive = false;

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    /**
     * Format email: html agar rapi
     */
    public string $mailType = 'html';
    public string $charset  = 'UTF-8';
    public bool $validate   = false;
    public int $priority    = 3;

    public string $CRLF    = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int $BCCBatchSize  = 200;
    public bool $DSN          = false;

    /**
     * Konfigurasi SSL Stream Context (Penting untuk Localhost)
     * Menghindari SSL handshake error saat PHP lokal menghubungi server Rumahweb
     */
    public array $SMTPOptions = [
        'ssl' => [
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true,
        ],
    ];
}