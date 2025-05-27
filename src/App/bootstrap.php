<?php #this file is so we can config everything from 1  file

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\Controllers\homeController;
$app = new App();
#calling our information + instantiation
$app->get('/', [homeController::class, 'home']);

return $app;
