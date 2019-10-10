<?php
declare(strict_types=1);

use App\Application\Actions\Rail\ListRailAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\EditUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\LoginUserAction;
use App\Application\Actions\User\LogoutUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\Container\ListContainersAction;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });
    $app->get('/login', LoginUserAction::class);
    $app->get('/logout', LogoutUserAction::class);

    $app->group('/api/users', function (Group $group) use ($container) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', CreateUserAction::class);
        $group->get('/{id}/edit',EditUserAction::class);
        $group->put('/{id}',UpdateUserAction::class);
        $group->delete('/{id}',DeleteUserAction::class);

    });
    $app->group('/api/containers', function (Group $group) use ($container) {
        $group->get('', ListContainersAction::class);
    });

    $app->group('/api/rails',function (Group $group) use($container){
       $group->get('',ListRailAction::class);
    });
};
