<?php
/**
 * @author Bram Gerritsen <bgerritsen@emico.nl>
 * @copyright (c) Emico B.V. 2017
 */

namespace Emico\RobinHqLib\Service;


use Emico\RobinHqLib\Client\RobinClient;
use Emico\RobinHqLib\Event\EventInterface;
use Emico\RobinHqLib\EventProcessor\EventProcessorInterface;
use Emico\RobinHqLib\Queue\Serializer\EventSerializer;
use Exception;
use Psr\Log\LoggerInterface;

class EventProcessingService
{
    private ?EventSerializer $eventSerializer = null;

    /**
     * @param LoggerInterface $logger
     * @param EventProcessorInterface[] $eventProcessors
     */
    public function __construct(private LoggerInterface $logger, private array $eventProcessors = [])
    {
    }

    /**
     * @param string $event
     */
    public function processEvent(string $event): void
    {
        $event = $this->getEventSerializer()->unserializeEvent($event);

        $this->logger->info('Processing ' . $event->getAction() . ' event ' . $event);

        try {
            $this->getEventProcessor($event)->processEvent($event);
        } catch (Exception $ex) {
            $this->logger->error($ex->getMessage());
        }
    }

    /**
     * @param EventInterface $event
     * @return EventProcessorInterface
     * @throws Exception
     */
    protected function getEventProcessor(EventInterface $event): EventProcessorInterface
    {
        $action = $event->getAction();
        if (!isset($this->eventProcessors[$action])) {
            throw new Exception('No event processor registered for action ' . $action);
        }
        return $this->eventProcessors[$action];
    }

    /**
     * @param string $action
     * @param EventProcessorInterface $eventProcessor
     */
    public function registerEventProcessor(string $action, EventProcessorInterface $eventProcessor): void
    {
        $this->eventProcessors[$action] = $eventProcessor;
    }

    /**
     * @return EventSerializer
     */
    public function getEventSerializer(): EventSerializer
    {
        if (!isset($this->eventSerializer)) {
            $this->eventSerializer = new EventSerializer();
        }
        return $this->eventSerializer;
    }
}