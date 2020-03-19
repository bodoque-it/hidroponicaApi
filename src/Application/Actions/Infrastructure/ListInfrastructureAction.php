<?php


namespace App\Application\Actions\Infrastructure;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ListInfrastructureAction extends InfrastructureAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->resolveArg('id_user');
        $infrastructures = $this->infrastructureRepository->findAll($id_user);
        return $this->respondWithData($infrastructures);
    }
}