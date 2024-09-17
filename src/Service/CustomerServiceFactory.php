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
