<?php


namespace App\Application\Actions\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class ListRailAction extends RailAction
{

    protected function action(): Response
    {
        /*$jwt = $this->auth();
        if(isset($jwt)){

        }*/
        $id = $this->getUrlParam('id');
        $allRails = $this->railRepository->getAllRails((int) $id);
//        foreach ($allRails as $rail) {
//            $containers = $rail->getContainers()->getValues();
//            foreach ($containers as $container){
//                $this->logger->info("container ". $container->getName());
//            }
//        }
//        $res = array(
//            $allRails,
//            $containers = $rail->getContainers()->getValues()
//        );
        return $this->respondWithData($allRails);
    }
}