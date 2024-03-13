<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;


use Emico\RobinHqLib\Event\CustomerEvent;
use Emico\RobinHqLib\Model\Customer;
use Emico\RobinHqLib\Queue\QueueInterface;
use Emico\RobinHqLib\Queue\Serializer\EventSerializer;

class CustomerService
{
    private EventSerializer $eventSerializer;

    /**
     * CustomerService constructor.
     * @param QueueInterface $queue
     */
    public function __construct(private QueueInterface $queue)
    {
        $this->eventSerializer = new EventSerializer();
    }

    /**
     * @param Customer $customer
     */
    public function postCustomer(Customer $customer): void
    {
        $event = new CustomerEvent($customer);
        $this->queue->pushEvent($this->eventSerializer->serializeEvent($event));
    }
}