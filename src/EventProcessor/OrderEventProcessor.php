<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\EventProcessor;


use Emico\RobinHqLib\Client\RobinClient;
use Emico\RobinHqLib\Event\EventInterface;

class OrderEventProcessor implements EventProcessorInterface
{
    /**
     * OrderEventProcessor constructor.
     * @param RobinClient $robinClient
     */
    public function __construct(private RobinClient $robinClient)
    {
    }

    /**
     * @param EventInterface $event
     * @return bool
     */
    public function processEvent(EventInterface $event): bool
    {
        $this->robinClient->postDynamicOrder($event->getOrder());
        return true;
    }
}
