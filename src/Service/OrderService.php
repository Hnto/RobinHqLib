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
    /**
     * CustomerService constructor.
     */
    public function __construct(
        private QueueInterface $queue,
        private EventSerializer $eventSerializer,
    ) {}

    /**
     * @param Order $order
     */
    public function postOrder(Order $order): void
    {
        $event = new OrderEvent($order);
        $this->queue->pushEvent($this->eventSerializer->serializeEvent($event));
    }
}
