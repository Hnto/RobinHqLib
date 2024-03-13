<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;


use Emico\RobinHqLib\Queue\QueueInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return OrderService
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): OrderService
    {
        return new OrderService($container->get(QueueInterface::class));
    }
}