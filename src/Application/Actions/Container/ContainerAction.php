<?php


namespace App\Application\Actions\Container;


use App\Domain\Container\ContainerRepository;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;

abstract  class ContainerAction extends Action
{
    /**
     * @var UserRepository
     */
    protected $containerRepository;

    /**
     * @param LoggerInterface $logger
     * @param ContainerRepository $containerRepository
     */
    public function __construct(LoggerInterface $logger, ContainerRepository $containerRepository)
    {
        parent::__construct($logger);
        $this->containerRepository = $containerRepository;
    }
}