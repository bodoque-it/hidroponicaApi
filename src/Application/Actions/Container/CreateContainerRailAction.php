<?php


namespace App\Application\Actions\Container;


use Psr\Http\Message\ResponseInterface as Response;

class CreateContainerRailAction extends  ContainerAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $id_user = $this->getUrlParam("id");
        $id_rail = $this->getUrlParam("id_rail");
        $params = $this->getFormData();
        $container = $this->containerRepository->createContainerInRail((int)$id_user,(int)$id_rail,$params);
        return $this->respondWithData($container);
    }
}