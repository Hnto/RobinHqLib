<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Server;

use Emico\RobinHqLib\Config\Config;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class RestApiServerFactory
{
    /**
     * @param ContainerInterface $container
     * @return RestApiServer
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RestApiServer
    {
        /** @var Config $config */
        $config = $container->get(Config::class);
        return new RestApiServer($config);
    }
}