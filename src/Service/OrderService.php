<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;


use Emico\RobinHqLib\Event\OrderEvent;
use Emico\RobinHqLib\Model\Order;
use Emico\RobinHqLib\Queue\QueueInterface;
use Emico\RobinHqLib\Queue\Serializer\EventSerializer;

class OrderService
{
    private EventSerializer $eventSerializer;

    /**
     * CustomerService constructor.
     * @param QueueInterface $queue
     */
    public function __construct(private QueueInterface $queue)
    {
        $this->queue = $queue;
        $this->eventSerializer = new EventSerializer();
    }

    /**
     * @param Order $order
     */
    public function postOrder(Order $order): void
    {
        $event = new OrderEvent($order);
        $this->queue->pushEvent($this->eventSerializer->serializeEvent($event));
    }
}