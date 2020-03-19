<?php


namespace App\Application\Actions\Infrastructure;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateInfrastructureAction extends InfrastructureAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam('id_user');
        $params = $this->getFormData();
        if(!isset($params["address"])){
            throw new HttpBadRequestException($this->request);
        }
        $infrastructure = $this->infrastructureRepository->createInfrastructure($id_user,$params);
        return $this->respondWithData($infrastructure);
    }
}