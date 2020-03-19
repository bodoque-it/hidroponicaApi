<?php


namespace App\Application\Actions\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateMicroclimateAction extends MicroclimateAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam('id_user');
        $params = $this->getFormData();
        $microclimate = $this->microclimateRepository->createMicroclimate($id_user,$params);
        return $this->respondWithData($microclimate);
    }
}