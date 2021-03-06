<?php
declare(strict_types=1);

use App\Application\Actions\Container\CreateContainerRailAction;
use App\Application\Actions\Cycle\AvailableContainerMicroclimateAction;
use App\Application\Actions\Cycle\CreateCycleAction;
use App\Application\Actions\Cycle\CreateCycleComplete;
use App\Application\Actions\Cycle\DeleteCycleAction;
use App\Application\Actions\Cycle\ListCycleAction;
use App\Application\Actions\Cycle\UpdateCycleAction;
use App\Application\Actions\Cycle\ViewCycleAction;
use App\Application\Actions\Infrastructure\CreateInfrastructureAction;
use App\Application\Actions\Infrastructure\DeleteInfrastructureAction;
use App\Application\Actions\Infrastructure\ListInfrastructureAction;
use App\Application\Actions\Measurement\CreateMeasurementAction;
use App\Application\Actions\Measurement\ListMeasurementAction;
use App\Application\Actions\Measurement\ViewMeasurementAction;
use App\Application\Actions\Microclimate\CreateMicroclimateAction;
use App\Application\Actions\Microclimate\DeleteMicroclimateAction;
use App\Application\Actions\Microclimate\ListMicroclimateAction;
use App\Application\Actions\Microclimate\UpdateMicroclimateAction;
use App\Application\Actions\Microclimate\ViewMicroclimateAction;
use App\Application\Actions\Rail\ListRailAction;
use App\Application\Actions\Rail\MakeRailAction;
use App\Application\Actions\Rail\EditRailAction;
use App\Application\Actions\Rail\ViewRailAction;
use App\Application\Actions\Rail\DeleteRailAction;
use App\Application\Actions\Rail\UpdateRailAction;
use App\Application\Actions\Rail\CreateRailAction;
use App\Application\Actions\User\AvailableResourcesUserAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\EditUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\LoginUserAction;
use App\Application\Actions\User\LogoutUserAction;
use App\Application\Actions\User\MetricUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Container\ListContainersAction;
use App\Application\Actions\Container\CreateContainerAction;
use App\Application\Actions\Container\MakeContainerAction;
use App\Application\Actions\Container\ViewContainerAction;
use App\Application\Actions\Container\UpdateContainerAction;
use App\Application\Actions\Container\DeleteContainerAction;
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
    $app->post('/login', LoginUserAction::class);
    $app->get('/logout', LogoutUserAction::class);

    $app->group('/api/users', function (Group $group) use ($container) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', CreateUserAction::class);
        $group->get('/{id}/edit',EditUserAction::class);
        $group->put('/{id}',UpdateUserAction::class);
        $group->delete('/{id}',DeleteUserAction::class);
        $group->get('/metrics/{id}',MetricUserAction::class);
        $group->get('/available/{id}',AvailableResourcesUserAction::class);
    });
    $app->group('/api/containers', function (Group $group) use ($container) {
        $group->get('/new',MakeContainerAction::class);
        $group->get('/{id}', ListContainersAction::class);
        //$group->post('/{id}',CreateContainerAction::class);
        $group->get('/{id}/{id_cont}',ViewContainerAction::class);
        $group->put('/{id}',UpdateContainerAction::class);
        $group->delete('/{id}',DeleteContainerAction::class);
        $group->post('/{id}/{id_rail}',CreateContainerRailAction::class);
    });

    $app->group('/api/cycles',function(Group $group) use ($container){
        $group->get('/{id_user}',ListCycleAction::class);
        $group->get('/{id_user}/{id_cycle}',ViewCycleAction::class);
        //$group->post('/{id_user}',CreateCycleAction::class);
        $group->put('/{id_cycle}',UpdateCycleAction::class);
        $group->delete('/{id_cycle}',DeleteCycleAction::class);
        $group->post('/{id_user}/{id_container}/{id_microclimate}',CreateCycleComplete::class);
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

    $app->group('/api/measurements',function(Group $group) use ($container){
        $group->get('/{id_cycle}',ListMeasurementAction::class);
        $group->post('/{id_cycle}',CreateMeasurementAction::class);
        $group->get('/{id_user}/{id_cycle}',ViewMeasurementAction::class);
    });

    $app->group('/api/microclimates',function(Group $group) use ($container){
       $group->get('/{id_user}',ListMicroclimateAction::class);
       $group->get('/{id_user}/{id_microclimate}',ViewMicroclimateAction::class);
       $group->post('/{id_user}',CreateMicroclimateAction::class);
       $group->delete('/{id_user}/{id_microclimate}',DeleteMicroclimateAction::class);
       $group->put('/{id_user}/{id_microclimate}',UpdateMicroclimateAction::class);
    });

    $app->group('/api/infrastructures',function(Group $group) use($container){
       $group->get('/{id_user}',ListInfrastructureAction::class);
       $group->post('/{id_user}',CreateInfrastructureAction::class);
       $group->delete('/{id_infrastructure}',DeleteInfrastructureAction::class);
    });
};
