<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class AvailableResourcesUserAction extends UserAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $user = $this->userRepository->findUserOfId($id);
        $resources=[
            'container_available' => $user->getAvailableContainers(),
            'microclimates_available' => $user->getAvailableMicroclimates()
        ];
        return $this->respondWithData($resources);
    }
}