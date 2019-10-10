<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ListRailAction extends RailAction
{

    protected function action(): Response
    {
        /*$jwt = $this->auth();
        if(isset($jwt)){

        }*/
        //$contents = $this->getFormData();
        $containers = $this->railRepository->getAllRails(1);
        return $this->respondWithData($containers);
    }
}