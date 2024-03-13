<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;

use Emico\RobinHqLib\EventProcessor\CustomerEventProcessor;
use Emico\RobinHqLib\EventProcessor\OrderEventProcessor;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class EventProcessingServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return EventProcessingService
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): EventProcessingService
    {
        $eventProcessingService = new EventProcessingService(
            $container->get(LoggerInterface::class)
        );

        $eventProcessingService->registerEventProcessor('customer', $container->get(CustomerEventProcessor::class));
        $eventProcessingService->registerEventProcessor('order', $container->get(OrderEventProcessor::class));

        return $eventProcessingService;
    }
}