<?php
declare(strict_types=1);

namespace App\Application\Actions\Cycle;

use App\Application\Actions\Action;
use App\Domain\Cycle\CycleRepository;
use Psr\Log\LoggerInterface;

abstract class CycleAction extends Action
{
    /**
     * @var CycleRepository
     */
    protected $cycleRepository;

    /**
     * @param LoggerInterface $logger
     * @param CycleRepository  $cycleRepository
     */
    public function __construct(LoggerInterface $logger, CycleRepository $cycleRepository)
    {
        parent::__construct($logger);
        $this->cycleRepository = $cycleRepository;
    }
}