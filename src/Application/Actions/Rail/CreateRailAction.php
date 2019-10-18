<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateRailAction extends RailAction
{

    protected function action(): Response
    {
        $id = $this->getUrlParam('id');
        $params = $this->getFormData();
        try {
            $this->railRepository->createRail($id, $params);
        }catch (\PDOException $e){
            return $this->respondWithError(401,"Error at insert rails");
        }
        return $this->respondWithData();
    }
}