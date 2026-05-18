<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';
$kernel = app(Illuminate\Contracts\Http\Kernel::class);
$ref = new ReflectionClass($kernel);
while ($ref && $ref->getName() !== 'Illuminate\\Foundation\\Http\\Kernel') {
    $ref = $ref->getParentClass();
}
if ($ref) {
    $prop = $ref->getProperty('routeMiddleware');
    $prop->setAccessible(true);
    echo json_encode($prop->getValue($kernel));
}
