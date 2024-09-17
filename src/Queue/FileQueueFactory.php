<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Queue;

use Emico\RobinHqLib\Service\EventProcessingService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class FileQueueFactory
{
    /**
     * @param ContainerInterface $container
     * @return FileQueue
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): FileQueue
    {
        return new FileQueue(
            __DIR__ . '/../../var/queue',
            $container->get(EventProcessingService::class),
            $container->get(LoggerInterface::class)
        );
    }
}
