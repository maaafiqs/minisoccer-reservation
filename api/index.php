<?php

// Pastikan folder storage ephemeral di /tmp tersedia untuk Vercel Serverless
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Teruskan request ke entrypoint Laravel public/index.php
require __DIR__ . '/../public/index.php';
