<?php


namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class MetricUserAction extends UserAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->resolveArg('id');
        $user = $this->userRepository->findUserOfId($id_user);
        $metrics = [
            'active_container' => $user->getCountActiveContainers(),
            'inactivate_container' =>$user->getCountInactiveContainers(),
            'rails_quantity'=>$user->getCountRails(),
            'microclimate_quantity'=>$user->getCountMicroclimates()
        ];
        return $this->respondWithData($metrics);
    }
}