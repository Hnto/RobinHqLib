<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;


use Emico\RobinHqLib\Client\RobinClient;
use Emico\RobinHqLib\EventProcessor\CustomerEventProcessor;
use Emico\RobinHqLib\EventProcessor\OrderEventProcessor;
use Emico\RobinHqLib\Queue\QueueInterface;
use Emico\RobinHqLib\Queue\Serializer\EventSerializer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class CustomerServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return CustomerService
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): CustomerService
    {
        return new CustomerService($container->get(QueueInterface::class));
    }
}