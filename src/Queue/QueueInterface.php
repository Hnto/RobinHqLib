<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Queue;


interface QueueInterface
{
    /**
     * @param string $serializedEvent
     * @return bool
     */
    public function pushEvent(string $serializedEvent): bool;
}
