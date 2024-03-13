<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;

use Emico\RobinHqLib\EventProcessor\CustomerEventProcessor;
use Emico\RobinHqLib\EventProcessor\OrderEventProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class EventProcessingServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $eventProcessingService = new EventProcessingService(
            $container->get(LoggerInterface::class)
        );

        $eventProcessingService->registerEventProcessor('customer', $container->get(CustomerEventProcessor::class));
        $eventProcessingService->registerEventProcessor('order', $container->get(OrderEventProcessor::class));

        return $eventProcessingService;
    }
}