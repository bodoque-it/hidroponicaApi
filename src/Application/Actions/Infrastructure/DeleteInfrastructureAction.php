<?php


namespace App\Application\Actions\Infrastructure;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteInfrastructureAction extends InfrastructureAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_infrastructure = $this->resolveArg('id_infrastructure');
        $res = $this->infrastructureRepository->deleteInfrastructure($id_infrastructure);
        $this->respondWithData($res);
    }
}