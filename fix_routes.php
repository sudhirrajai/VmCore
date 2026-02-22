<?php
$dir = __DIR__ . '/resources/views/admin';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
foreach ($iterator as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $content = file_get_contents($file->getRealPath());
        $changed = false;

        if (str_contains($content, "route('pages.")) {
            $content = str_replace("route('pages.", "route('admin.pages.", $content);
            $changed = true;
        }
        if (str_contains($content, "route('menus.")) {
            $content = str_replace("route('menus.", "route('admin.menus.", $content);
            $changed = true;
        }
        if (str_contains($content, "route('settings.")) {
            $content = str_replace("route('settings.", "route('admin.settings.", $content);
            $changed = true;
        }

        if ($changed) {
            file_put_contents($file->getRealPath(), $content);
            echo "Updated " . $file->getFilename() . "\n";
        }
    }
}
echo "Done.\n";
