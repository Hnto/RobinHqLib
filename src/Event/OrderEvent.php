<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Event;


use Emico\RobinHqLib\Model\Order;

class OrderEvent implements EventInterface
{
    /**
     * @param Order $order
     */
    public function __construct(protected Order $order)
    {
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return 'order';
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->order->getOrderNumber();
    }
}