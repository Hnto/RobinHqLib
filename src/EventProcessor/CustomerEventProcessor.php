<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\EventProcessor;


use Emico\RobinHqLib\Client\RobinClient;
use Emico\RobinHqLib\Event\EventInterface;

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
     * @param EventInterface $event
     * @return bool
     */
    public function processEvent(EventInterface $event): bool
    {
        $this->robinClient->postDynamicCustomer($event->getCustomer());
        return true;
    }
}
