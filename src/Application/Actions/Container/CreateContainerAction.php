<?php


namespace App\Application\Actions\Container;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateContainerAction extends ContainerAction
{

    /**
     * @return Response
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $id = $this->resolveArg("id");
        $params = $this->getFormData();
        if($this->inValidParams($params)){
            throw new HttpBadRequestException($this->request);
        }
        $row = $this->containerRepository->createContainer($id,$params);
        return $this->respondWithData($row);
    }
    private function inValidParams(array $params):bool {
        if($params["name"]=== null and $params["volume"]===null){
            return false;
        }
        return true;
    }
}