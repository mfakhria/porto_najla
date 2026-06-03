<?php

declare(strict_types=1);

/**
 * Export Laravel Blade pages to static HTML for Vercel (static hosting).
 */

$root = dirname(__DIR__);

if (! is_file($root.'/.env')) {
    copy($root.'/.env.example', $root.'/.env');
}

require $root.'/vendor/autoload.php';

$app = require_once $root.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

Illuminate\Support\Facades\URL::forceRootUrl('');
config(['app.url' => '']);

if (empty(config('app.key'))) {
    Illuminate\Support\Facades\Artisan::call('key:generate', ['--force' => true]);
}

$dist = $root.'/dist';

if (is_dir($dist)) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dist, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($iterator as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }
    rmdir($dist);
}

mkdir($dist, 0755, true);

$pages = [
    'index.html' => fn () => view('welcome')->render(),
    'projects/vms/index.html' => fn () => view('projects.vms')->render(),
    'projects/connect/index.html' => fn () => view('projects.connect')->render(),
    'projects/fleet/index.html' => fn () => view('projects.fleet')->render(),
    'projects/re-actions/index.html' => fn () => view('projects.reactions')->render(),
];

foreach ($pages as $relativePath => $renderer) {
    $target = $dist.'/'.$relativePath;
    $dir = dirname($target);
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    file_put_contents($target, normalizeStaticHtml($renderer()));
    echo "Built {$relativePath}\n";
}

copyPublicAssets($root.'/public/images', $dist.'/images');

echo "Static export complete → dist/\n";

function normalizeStaticHtml(string $html): string
{
    return preg_replace('#https?://localhost#', '', $html) ?? $html;
}

function copyPublicAssets(string $source, string $destination): void
{
    if (! is_dir($source)) {
        return;
    }

    if (! is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if (! $file->isFile()) {
            continue;
        }

        $relative = substr($file->getPathname(), strlen($source) + 1);
        $target = $destination.'/'.$relative;
        $targetDir = dirname($target);

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        copy($file->getPathname(), $target);
    }

    echo "Copied public/images\n";
}
