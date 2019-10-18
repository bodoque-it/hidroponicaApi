<?php
declare(strict_types=1);

use App\Application\Actions\Rail\ListRailAction;
use App\Application\Actions\Rail\MakeRailAction;
use App\Application\Actions\Rail\EditRailAction;
use App\Application\Actions\Rail\ViewRailAction;
use App\Application\Actions\Rail\DeleteRailAction;
use App\Application\Actions\Rail\UpdateRailAction;
use App\Application\Actions\Rail\CreateRailAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\EditUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\LoginUserAction;
use App\Application\Actions\User\LogoutUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Container\ListContainersAction;
use App\Application\Actions\Container\CreateContainerAction;
use App\Application\Actions\Container\MakeContainerAction;
use App\Application\Actions\Container\ViewContainerAction;
use App\Application\Actions\Container\UpdateContainerAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


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
        $group->get('/new',MakeContainerAction::class);
        $group->get('/{id}', ListContainersAction::class);
        $group->post('/{id}',CreateContainerAction::class);
        $group->get('/{id}/{id_cont}',ViewContainerAction::class);
        $group->put('/{id}',UpdateContainerAction::class);
    });

    $app->group('/api/rails',function (Group $group) use($container){
        $group->get('/edit',EditRailAction::class);
        $group->get('/new',MakeRailAction::class);
        $group->get('/{id}',ListRailAction::class);
        $group->post('/{id}',CreateRailAction::class);
        $group->get('/{id}/{id_rail}',ViewRailAction::class);
        $group->put('/{id}/{id_rail}',UpdateRailAction::class);
        $group->delete('/{id}/{id_rail}',DeleteRailAction::class);
    });
};
