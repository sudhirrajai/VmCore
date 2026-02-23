<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// We need to bypass auth for this script
$app->make('router')->aliasMiddleware('auth', function ($request, $next) {
    return $next($request);
});

\App\Models\ContactSubmission::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'subject' => 'Test Subject',
    'message' => 'Test Message'
]);
$inquiry = \App\Models\ContactSubmission::latest()->first();
echo "Created test inquiry ID: " . $inquiry->id . "\n";

$request = Illuminate\Http\Request::create(
    '/admin/inquiries/' . $inquiry->id,
    'DELETE'
);

$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
if ($response->isRedirect()) {
    echo "Redirect to: " . $response->headers->get('Location') . "\n";
} else {
    echo "Response Content: " . $response->getContent() . "\n";
}

$check = \App\Models\ContactSubmission::find($inquiry->id);
if ($check) {
    echo "Error: Inquiry was NOT deleted (still exists).\n";
} else {
    echo "Success: Inquiry was successfully deleted.\n";
}

$kernel->terminate($request, $response);
