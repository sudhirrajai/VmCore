<?php

$viewsDir = __DIR__ . '/resources/views/admin';

$perPageHtml = <<<'HTML'
<div class="col-auto">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Per Page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Per Page</option>
                        </select>
                    </div>
HTML;

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));
foreach ($it as $file) {
    if ($file->isFile() && $file->getFilename() === 'index.blade.php') {
        $content = file_get_contents($file->getPathname());
        
        // Only process if per_page select is not already there
        if (strpos($content, 'name="per_page"') === false) {
            // Check if there is a GET form
            if (preg_match('/<form[^>]*method=["\']GET["\'][^>]*>/i', $content)) {
                // Try to find the submit button inside the form
                $pattern = '/(<div[^>]*>\s*<button[^>]*type=["\']submit["\'][^>]*>.*?<\/button>\s*<\/div>\s*)<\/form>/is';
                if (preg_match($pattern, $content)) {
                    $newContent = preg_replace($pattern, $perPageHtml . "\n                    $1</form>", $content, 1);
                } else {
                    // fallback to append before </form>
                    $newContent = preg_replace('/<\/form>/i', $perPageHtml . "\n                </form>", $content, 1);
                }
            } else {
                // Create a GET form right after <div class="card-body">
                $formHtml = "<form method=\"GET\" class=\"row g-3 mb-3\">\n                    " . $perPageHtml . "\n                </form>";
                $newContent = preg_replace('/(<div\s+class=["\']card-body["\'][^>]*>)/i', "$1\n                " . $formHtml, $content, 1);
            }
            
            if ($newContent !== $content) {
                file_put_contents($file->getPathname(), $newContent);
                echo "Updated View: " . str_replace(__DIR__, '', $file->getPathname()) . "\n";
            }
        }
    }
}
