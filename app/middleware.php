<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(new Tuupola\Middleware\CorsMiddleware([
        "origin" => ["*"],
        "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE","OPTIONS"],
        "headers.allow" => ["Authorization", "If-Match", "If-Unmodified-Since"],
        "headers.expose" => ["Etag"],
        "credentials" => true,
        "cache" => 86400
    ]));
//    $app->add(new Tuupola\Middleware\JwtAuthentication([
//        "secret" => getenv('SECRET_KEY'),
//        "path" => "/api",
//        "error" => function ($response, $arguments) {
//            $data["status"] = "error";
//            $data["message"] = $arguments["message"];
//            return $response
//                ->withHeader("Content-Type", "application/json")
//                ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
//        }
//    ]));
};
