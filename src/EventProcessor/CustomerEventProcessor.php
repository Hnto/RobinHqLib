<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\EventProcessor;


use Emico\RobinHqLib\Client\RobinClient;
use Emico\RobinHqLib\Event\CustomerEvent;
use Emico\RobinHqLib\Event\EventInterface;
use Exception;
use Psr\Log\LoggerInterface;

class CustomerEventProcessor implements EventProcessorInterface
{
    /**
     * CustomerEventProcessor constructor.
     * @param RobinClient $robinClient
     */
    public function __construct(protected RobinClient $robinClient)
    {
    }

    /**
     * @param EventInterface|CustomerEvent $event
     * @return bool
     */
    public function processEvent(EventInterface $event): bool
    {
        $this->robinClient->postDynamicCustomer($event->getCustomer());
        return true;
    }
}