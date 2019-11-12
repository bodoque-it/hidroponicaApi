<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Tuupola\Middleware\CorsMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add( new CorsMiddleware([
        "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => ["Authorization", "If-Match", "If-Unmodified-Since"],
    "headers.expose" => ["Etag"],
    "credentials" => true,
    "cache" => 86400
    ]));
};
