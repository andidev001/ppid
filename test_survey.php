<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Force JSON Accept Header to mimic `fetch`
$request = Illuminate\Http\Request::create('/admin/survey', 'POST', [
    'question' => 'Testing validation',
    'type' => 'rating',
    'order_num' => 1,
    'is_active' => true,
]);
$request->headers->set('Accept', 'application/json');

$response = $kernel->handle($request);

echo "STATUS: " . $response->getStatusCode() . "\n";
echo "CONTENT: " . $response->getContent() . "\n";
