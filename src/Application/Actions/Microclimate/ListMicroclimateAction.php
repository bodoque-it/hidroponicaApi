<?php


namespace App\Application\Actions\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ListMicroclimateAction extends MicroclimateAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->resolveArg('id_user');
        $microclimate = $this->microclimateRepository->findAll($id_user);
        return $this->respondWithData($microclimate);
    }
}